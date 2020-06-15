<?php

namespace common\models;

use common\components\MTools;
use common\models\UserWallet;
use common\models\UserWalletRecord;
use common\models\GradeRecord;
use common\models\DtAward;//奖励类
use Yii;

/**
 * This is the model class for table "me_grade".
 *
 * @property integer $id
 * @property string $name
 * @property string $transaction_sum
 * @property integer $recommend_sum
 * @property integer $fans_sum
 * @property string $performance_sum
 * @property string $frees_sum
 * @property string $promote_sum
 * @property string $static_sum
 * @property string $dynamic_sum
 * @property integer $updated_at
 */
class Grade extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'me_grade';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['transaction_sum', 'performance_sum', 'frees_sum', 'promote_sum', 'static_sum', 'dynamic_sum'], 'number'],
            [['recommend_sum', 'fans_sum', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => '名称',
            'updated_at' => '更新时间',
            //小余2019-03-26-start
            'transaction_sum' => 'C2C累计购买数量',
            'recommend_sum' => '推荐正式会员人数',
            'fans_sum' => '正式会员团队粉丝',
            'performance_sum' => '业绩（团队总BBA）',
            'frees_sum' => '累计定存自由区数量',
            'promote_sum' => '晋级奖励',
            'static_sum' => '无现代静态收益',
            'dynamic_sum' => '平级动态收益',
            //小余2019-03-26-end
        ];
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {

        $query = Grade::find();

        //$query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
//        echo '<pre>';
//        var_dump($res);exit;
        foreach ($res as $key => $val) {
            $res[$key]['static_sum'] = Yii::$app->formatter->asPercent($val["static_sum"],4);
            $res[$key]['dynamic_sum'] = Yii::$app->formatter->asPercent($val["dynamic_sum"],4);
            $res[$key]['updated_at'] = Yii::$app->formatter->asDatetime($val["updated_at"]);
            $res[$key]['action'] = MTools::getStringActions([
                                        "updategrade" => [
                                            "params" => ["id" => $val["id"]],
                                            "title" => "编辑"
                                        ]
                                    ]);
        }
        return ["total" => $totalCount, "rows" => $res];
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? Grade::findOne($id) : new Grade();
        try {
            $model->load(Yii::$app->request->post());
            $model->static_sum = $model->static_sum / 100;
            $model->dynamic_sum = $model->dynamic_sum / 100;
            $model->updated_at = time();
            \common\models\Actionlog::setLog('修改id为：' . $model->id . '的会员级别配置');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    //卢呗变动引发会员等级变化
    public static function gradeChangeByHcg($user){
        //设置升级白名单（白名单中用户等级不变）
        $white_arr = [21641,21669];
        
        $grades = Grade::find()->asArray()->all();
        $j = 0;

        while (true){
            $j++;
            if(!$user || empty($user)){//用户不存在
                break;
            }
            if(in_array($user->id, $white_arr)){
                $invite_code = $user->invite_code;
                $user = \frontend\models\WB_User::find()->with(['wallet'])->where("mycode=:mycode",[':mycode'=>$invite_code])->one();
                continue;
            }
            //获取会员直推会员信息
            $my_recom_user = \frontend\models\WB_User::find()->with('wallet')->where("invite_code=:invite_code",[':invite_code'=>$user->mycode])->all();

            $v1_num = 0;
            $v2_num = 0;
            $v3_num = 0;
            $id_str = '';
            foreach($my_recom_user as $key=>$val){
                if($val->grade_id >= 3){//等级Lv1
                    $v1_num = $v1_num + 1;
                }
                if($val->grade_id >= 4){//等级Lv2
                    $v2_num = $v2_num + 1;
                }
                if($val->grade_id > 1){//非免费人数
                    $v3_num = $v3_num + 1;
                }
                if($id_str == ''){
                    $id_str = $val->id;
                }else{
                    $id_str = $id_str.','.$val->id;
                }
            }

            $new_gradeid = 1;
            for($i = 4; $i >= 0; $i--){
                if($user->wallet->hcg_wa >= $grades[$i]['reg_score_min'] && $v1_num >= $grades[$i]['recom_v2'] && $v2_num >= $grades[$i]['recom_v3'] && $v3_num >= $grades[$i]['recom_v1']){//推荐的v1,v2以及正式会员人数
                    //判断满足卢呗要求
                    if($id_str){
                        $hcg_num1 = \frontend\models\WB_UserWallet::find()->where("userid in ($id_str) && hcg_wa >= :hcg_wa",[':hcg_wa'=>$grades[$i]['recom_integral']])->count();
                        $hcg_num = $hcg_num1?$hcg_num1:0;
                    }else{
                        $hcg_num = 0;
                    }
                    if($hcg_num >= $grades[$i]['recom_integral_num']){
                        $new_gradeid = $grades[$i]['id'];
                        $new_grade_name = $grades[$i]['name'];
                        break;
                    }
                }
            }
            if($new_gradeid == $user->grade_id){
                break;
            }else{
                $old_grade_id = $user->grade_id;
                $old_grade_name = $grades[$old_grade_id-1]['name'];
                $user->grade_id = $new_gradeid;
                if($user->save()){//生成升级记录
                    $up_grade = new GradeRecord();
                    $up_grade->userid = $user->id;
                    $up_grade->username = $user->username;
                    $up_grade->old_grade_id = $old_grade_id;
                    $up_grade->old_grade_name = $old_grade_name;
                    $up_grade->new_grade_id = $user->grade_id;
                    $up_grade->new_grade_name = $new_grade_name;
                    if($j == 1){
                        $note = $user->username .'等级，从原来的'.$old_grade_name.'('.$old_grade_id.')，变为'.$new_grade_name.'('.$new_gradeid.')导致等级发生变化';
                    }
                    $up_grade->note = $note;
                    $up_grade->created_at = time();
                    $up_grade->save();
                }
                if(!$user->invite_code){
                    break;
                }
                $invite_code = $user->invite_code;
                $user = \frontend\models\WB_User::find()->with(['wallet'])->where("mycode=:mycode",[':mycode'=>$invite_code])->one();
            }
        }
        return true;
    }

    // 用户升级
    public static function upgrade($userdata){
        $userid = $userdata->id;

        // 累计购买数量
        $wallet = UserWallet::find()->where('userid = :userid',[':userid' => $userid])->one();
        $buy = $wallet->total_buy;

        // 直推正式会员人数
        $user = 0;
        $profile = UserProfile::find()->select('userid')->where('referrerid = :referrerid',[':referrerid' => $userid])->all();
        if($profile){
            foreach ($profile as $item){
                $ids_ary[] = $item->userid;
            }
            $userids = implode(',',$ids_ary);
            $user = User::find()->where("id in ($userids) and grade_id > 1")->count();
        }

        $amount = 0;
        $team_count = 0;
        $team = UserProfile::find()->select('down_team_id')->where('userid = :userid',[':userid' => $userid])->one();
        if($team->down_team_id){
            // 正式会员团队粉丝
            $user_str = implode(',',explode('-',$team->down_team_id));
            $team_count = User::find()->where("id in ($user_str) and grade_id > 1")->count();

            // 业绩（团队总BBA）
            $user_ary = explode('-',$team->down_team_id);
            foreach ($user_ary as $val){
                $wallet = UserWallet::find()->where('userid = :userid',[':userid' => $val])->one();
                $amount += $wallet->total_buy;
            }
        }

        // 累计定存自由区数量
        $freeze = UserFreeze::find()->where('userid = :userid and expire = 1',[':userid' => $userid])->all();
        $deposit = 0;
        if($freeze){
            foreach ($freeze as $v){
                $deposit += $v->amount;
            }
        }

        // 获取等级表
        $grade = Grade::find()->where('transaction_sum <= :transaction_sum and recommend_sum <= :recommend_sum and fans_sum <= :fans_sum and performance_sum <= :performance_sum and frees_sum <= :frees_sum',[':transaction_sum' => $buy,':recommend_sum' => $user,':fans_sum' => $team_count,':performance_sum' => $amount,':frees_sum' => $deposit])->orderBy('id desc')->one();

        // 若等级比当前用户等级高 则升级
        if($grade) {

            if ($grade->id > $userdata->grade_id) {

                // 用户钱包
                $user_wallet = UserWallet::find()->where('userid = :userid', [':userid' => $userid])->one();
                // 升级
                $userdata->grade_id = $grade->id;
                //正式会员签到每天赠送币
                $formally_sign_give = MTools::getYiiParams('formally_sign_give')?MTools::getYiiParams('formally_sign_give'):10;
                //正式会员签到赠送奖励天数
                $formally_sign_day = MTools::getYiiParams('formally_sign_day')?MTools::getYiiParams('formally_sign_day'):10;
                $amount_num = $formally_sign_give*$formally_sign_day;
                if($grade->id == 2){
                    self::awardvip($userdata);
                    // 增加 dt_award 记录
                    $award = new DtAward();
                    $award->userid = $userid;
                    $award->username = $userdata->username;
                    $award->amount = $amount_num;
                    $award->event_type = 1;
                    $award->note = '成为正式会员送的签到奖励';
                    $award->created_at = time();
                    $award->save();
                }
                if($grade->promote_sum != 0){
                    // 发放晋级奖励
                    $user_wallet->cash_wa += $grade->promote_sum;
                    // 记录 bba增加
                    UserWalletRecord::insertrecord($userid, $grade->promote_sum, 28, 1, 2, $user_wallet->cash_wa, '晋级奖励');
                }

                if ($userdata->save() && $user_wallet->save()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return true;
    }


    //用户成为正式会员后，推荐人获得推荐奖励的操作
    public static function awardvip($userdata){

//        if($userdata->grade_id>1){
//            return true;
//        }

        $up_referrer_id = $userdata->userprofile->up_referrer_id;
        $up_referrer_array = array_reverse(explode('-',$up_referrer_id));

        //如果有推荐人
        if(!empty($up_referrer_array)){
            // 开启事务
            $trans = Yii::$app->db->beginTransaction();
            try {
                $referid = $up_referrer_array[0];//直推上级推荐人id
                //获取已经推荐的人数
                $count = DtAward::find()->where('userid = :userid and event_type = 2',['userid'=>$referid])->count();
                $count = intval($count);
                //获取推荐人信息
                $referdata = User::findOne($referid);
                //获取推荐人钱包信息
                $refer_wallet = UserWallet::find()->where('userid = :userid',['userid'=>$referid])->one();
                //获取正式推正式奖励
                $formalrecommendgive = MTools::getYiiParams('formalrecommendgive');
                //正式推正式人数限制
                $formalrecommendgivelimit = MTools::getYiiParams('formalrecommendgivelimit');
                //正式推正式超过推荐人数获取的奖励
                $formalrecommendgivenum = MTools::getYiiParams('formalrecommendgivenum');
                //获取奖励数量
                if($count <= $formalrecommendgivelimit){
                    $award = ($count + 1) * $formalrecommendgive;
                }else{
                    $award = $formalrecommendgivenum;
                }

                $refer_wallet->permanent_wa += $award;
                //用户升级
//                $userdata->grade_id = 2;
                //插入会员奖励记录表
                $note = $userdata->id.'成为正式会员,推荐人'.$referid.'获取到的奖励为'.$award;
                $res = DtAward::insertrecord($referid,$referdata->username,$award,2,1,$note);
                //插入会员钱包变动记录表
                $Record = UserWalletRecord::insertrecord($referdata->id, $award, 30, 1, 7, $refer_wallet->permanent_wa,$note);

                if($res && $Record && $refer_wallet->save()){
                    $trans->commit();
                    return true;
                }
            }catch (Exception $e) {
                $trans->rollBack();
                throw $e;
            }
        }else{
            return true;
        }
    }
}
