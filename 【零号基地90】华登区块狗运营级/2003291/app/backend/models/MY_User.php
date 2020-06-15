<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-10-9 7:50:14
 * @version V1.0
 * @desc
 */

use common\models\BankRealname;
use common\models\MeUser;
use common\models\UserProfile;
use common\models\UserWallet;
use common\models\UserZodiac;
use common\models\Zodiac;
use Yii;
use yii\behaviors\TimestampBehavior;

class MY_User extends MeUser {
    /*
     * 设置表操作行为动作
     * return array
     */

    public function behaviors() {
        return[
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    /*
     * 配置列表查询数据
     * @params $username
     * return object
     */

    public static function getList() {

        $query = MY_User::find()->with(["wallet","level",'grade']);//"userprofile",

        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $search = Yii::$app->request->get("search");
        $iseal = Yii::$app->request->get("iseal");
        $level_id = Yii::$app->request->get('level_id');
        $grade_id = Yii::$app->request->get("grade_id");
        if($search != ''){
            $userpro = \common\models\UserProfile::find()->where('phone = :phone', [':phone' => $search])->one();

            if($userpro){
                $search = $userpro->userid;
                $query->andFilterWhere(["=","id",$search]);
            }else{
                if ($search) {
                    $query->andFilterWhere(["=","id",$search]);
                    $query->orFilterWhere(["like","username",$search]);
                }
            }
        }

        if ($begin_at) {
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }
        if ($iseal != '') {
            $query->andFilterWhere(["=","iseal",$iseal]);
        }
        if ($grade_id != '') {
            $query->andFilterWhere(["=","grade_id",$grade_id]);
        }
        if ($level_id != '') {
            $query->andFilterWhere(["=","level_id",$level_id]);
        }
        if(Yii::$app->user->identity->branch_id > 0){
            if(Yii::$app->user->identity->branch_id == '1863'){
                $query->andFilterWhere(["in", "branch_id", ['1863', '1872', '1875', '1889']])->orderBy("created_at desc");
            }else {
                $query->andFilterWhere(["=","branch_id",Yii::$app->user->identity->branch_id])->orderBy("created_at desc");
            }
        }
        $query->orderBy("created_at desc");
        $countQuery = clone $query;

        $offset = Yii::$app->request->get("offset");//0

        $limit = Yii::$app->request->get("limit");//10

        $totalCount = $countQuery->count();

        $res = $query->offset($offset)->limit($limit)->asArray()->all();
//        $resSql = $query->offset($offset)->limit($limit)->createCommand()->getRawSql();

        return ["total" => $totalCount, "data" => $res];
    }
    
    /*
     * 关联账户
     */

    public function getWallet() {
        return $this->hasOne(MY_UserWallet::className(), ['userid' => 'id']);
    }

    /*
     * 关联基本信息
     */

    public function getUserprofile() {
        return $this->hasOne(MY_UserProfile::className(), ['userid' => 'id']);
    }
    
    public function getLevel() {
        return $this->hasOne(\common\models\Level::className(), ['id' => 'level_id']);
    }
//
    public function getGrade() {
        $res = $this->hasOne(\common\models\Grade::className(), ['id' => 'grade_id']);
        return $this->hasOne(\common\models\Grade::className(), ['id' => 'grade_id']);
    }
    

    /*
     * 统计会员，日期注册量
     */

    public static function dateStatuser() {
        $query = new \yii\db\Query();
        $query->from(MY_User::tableName());
        $query->select(["count(id) as num", "DATE_FORMAT(FROM_UNIXTIME(created_at),'%Y-%m-%d') AS date_stat"]);
        $query->groupBy(["DATE_FORMAT(FROM_UNIXTIME(created_at),'%Y-%m-%d')"]);
        return $query->all();
    }

    /*
     * 查看会员详情
     */

    public static function getDetail() {

        $userid = Yii::$app->request->get("id");
        $user = MY_User::findOne($userid);

        if (!$user instanceof MY_User) {
            throw new \yii\web\NotFoundHttpException;
        }

        // 查询会员所有下级
        $userdata = UserProfile::find()->where('userid = :userid', [':userid' => $userid])->one();

        $down_cash_wa = 0;
        $down_free_wa = 0;
//        $down_get_release = 0;
        $down_user = 0;

        if($userdata->down_team_id){
            $down = explode('-',$userdata->down_team_id);
            $down_user = count($down);
            $downid = str_replace('-',',',$userdata->down_team_id);
            $down_cash_wa = UserWallet::find()->where("userid in($downid)")->sum('cash_wa');

        }
        $cash_wa = $down_cash_wa;
        $free_wa = $down_free_wa;
        $d_user = $down_user;

        //获取会员拥有的宠物
        $list = [];
        $userzodiac = UserZodiac::find()->where('userid = :userid',[':userid'=>$userid])->orderBy('created_at asc')->asArray()->all();
        $userbank = BankRealname::find()->where('userid = :userid',[':userid'=>$userid])->one();
        if(!empty($userzodiac)){
            foreach ($userzodiac as $k => $v){
                $zodiac = Zodiac::find()->select('name')->where('id = :id',[':id'=>$v['zodiac_id']])->one();
                $list[$k]['name'] = $zodiac->name;
                $list[$k]['old_hcg'] = floor($v['old_hcg'] * 1000)/1000;
                $list[$k]['hcg'] = floor($v['hcg'] * 1000)/1000;
                $list[$k]['is_overtime'] = $v['is_overtime'] == 0 ? '成长中' : '已过期';
                $list[$k]['due'] = $v['due'];
                $list[$k]['award'] = floor($v['award'] * 100)/100 .'%';
                $list[$k]['earn'] = $v['hcg'] - $v['old_hcg'];
            }
        }

        return ["user" => $user, 'cash_wa' => $cash_wa, 'd_user' => $d_user,'list'=>$list,'userbank'=>$userbank];
    }
    
    /*
     * 查看未冻结会员详情
     */

    public static function getAllUserDetail() {
        $allusermodel = MY_User::find()->where("iseal=0")->with(["userprofile", "wallet", "level"])->all();
        if (!$allusermodel) {
            throw new \yii\web\NotFoundHttpException;
        }
        return $allusermodel;
    }
    
    
    /*
     * fenhongyonghu
     */

    public static function getBonus() {
        $allusermodel = MY_User::find()->where("iseal=0")->with(["wallet", "level"])->all();
        if (!$allusermodel) {
            throw new \yii\web\NotFoundHttpException;
        }
        return $allusermodel;
    }

    // 批量封号解封查询出用户信息
    public static function getBatchuserlist() {
        $query = MY_User::find()->with(["wallet", "userprofile", "grade"]);                     // 关联钱包表 和 用户信息表

        $search = Yii::$app->request->get("search");                            // 用户ID/用户名/手机号
        $type = Yii::$app->request->get("type");                                // 查询伞上会员或伞下会员

        // 通过 用户ID/用户名/手机号 查询出当前用户
        if($search != ''){
            $userpro = \common\models\UserProfile::find()->where('phone = :phone', [':phone' => $search])->one();

            if($userpro){
                // 如果有选择伞上 或 伞下
                if($type != '') {
                    if($type == 1) {
                        $ids = explode('-', $userpro->up_referrer_id);
                        array_push($ids, $userpro->userid);
                        $query->andFilterWhere(["in", "id", $ids]);
                    } else {
                        $ids = explode('-', $userpro->down_team_id);
                        array_push($ids, $userpro->userid);
                        $query->andFilterWhere(["in", "id", $ids]);
                    }
                }
            }else{
                $userpro = \common\models\UserProfile::find()->where('userid = :userid', [':userid' => $search])->one();
                if($userpro && $type != '') {
                    if($type == 1) {
                        $ids = explode('-', $userpro->up_referrer_id);
                        array_push($ids, $userpro->userid);
                        $query->andFilterWhere(["in", "id", $ids]);
                    } else {
                        $ids = explode('-', $userpro->down_team_id);
                        array_push($ids, $userpro->userid);
                        $query->andFilterWhere(["in", "id", $ids]);
                    }
                } else {
                    $userpro = \common\models\UserProfile::find()->where('username = :username', [':username' => $search])->one();
                    if($userpro && $type != '') {
                        if($type == 1) {
                            $ids = explode('-', $userpro->up_referrer_id);
                            array_push($ids, $userpro->userid);
                            $query->andFilterWhere(["in", "id", $ids]);
                        } else {
                            $ids = explode('-', $userpro->down_team_id);
                            array_push($ids, $userpro->userid);
                            $query->andFilterWhere(["in", "id", $ids]);
                        }
                    }
                }
            }
        }

        $query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    // 批量查询7天未登录、卢宝、卢呗为0的账号
    public function getUnloginlist() {
        $sevenDaysAgo = strtotime("-7 day");

        $overtime = time() - 3600 * 168;

        $query = MY_User::find()->innerJoinWith([
            'grade',
            'userprofile',
            'wallet' => function ($query) {
                $query->where('cash_wa = 0');
            }
        ]);
        $query->andFilterWhere(['<=', 'last_login_at', $overtime]);


        $query->orderBy("last_login_at asc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        if($res) {
            return ["total" => $totalCount, "data" => $res];
        } else {
            return ["total" => $totalCount, "data" => null];
        }
    }
}
