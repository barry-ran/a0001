<?php

namespace frontend\models;

use common\components\MTools;
use common\models\Grade;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\User;

/**
 * This is the model class for table "me_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $phone
 * @property integer $status
 * @property string $idcard
 * @property string $mycode
 * @property integer $iseal
 * @property integer $last_login_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $register_ip
 * @property string $branch_id
 */
class WB_User extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'me_user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'auth_key', 'password_hash', 'password_hash2'], 'required'],
            [['level_id', 'status', 'isactivate', 'issend', 'issell', 'isout', 'iseal', 'last_login_at', 'created_at', 'updated_at','branch_id'], 'integer'],
            [['out_limit'], 'number'],
            [['username'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_hash2', 'password_reset_token'], 'string', 'max' => 255],
            [['login_ip','register_ip'], 'string', 'max' => 100],
            [['invite_code', 'mycode'], 'string', 'max' => 10],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_hash2' =>Yii::t('app', 'Password Hash2'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'login_ip' => Yii::t('app', 'Login Ip'), 
            'status' => Yii::t('app', 'Status'),
            'isactivate' => Yii::t('app', '是否激活'),
            'issend' => Yii::t('app', '冻结转让'),
            'issell' => Yii::t('app', 'BBA交易限制'),
            'isout' => Yii::t('app','是否出局'),
            'iseal' => Yii::t('app', '是否被封'),
            'last_login_at' => Yii::t('app', '最后登陆时间'),
            'invite_code' => Yii::t('app', '邀请码'),
            'mycode' => Yii::t('app', '自身邀请码'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'register_ip' => Yii::t('app', '注册时的IP'),
            'branch_id' => Yii::t('app', '分公司ID'),
        ];
    }

    /*
     * 关联基本信息
     */

    public function getUserprofile() {
        return $this->hasOne(WB_UserProfile::className(), ['userid' => 'id']);
    }

    /*
     * 关联账户
     */

    public function getWallet() {
        return $this->hasOne(WB_UserWallet::className(), ['userid' => 'id']);
    }

    public function getLevel() {
        return $this->hasOne(\common\models\Level::className(), ['id' => 'level_id']);
    }
    
    public function getGrade() {
        return $this->hasOne(\common\models\Grade::className(), ['id' => 'grade_id']);
    }
    /*
     * 查询levelList
     * @params $reside
     * return array
     */

    public static function getLevelList($reside) {
        $query = new \yii\db\Query();
        $query->from(WB_UserProfile::tableName() . " as a");
        $query->leftJoin(WB_User::tableName() . " as b", "a.userid=b.id");
        $query->leftJoin(\frontend\models\WB_Level::tableName() . " as c", "b.levelid=c.id");
        $query->leftJoin(WB_UserRegistBalance::tableName() . " as d", "a.userid=d.userid");
        $query->where("reside=:resideL or reside=:resideR", [":resideL" => $reside . "-1", ":resideR" => $reside . "-2"]);
        $query->select("a.userid,a.username,b.created_at,a.reside,c.name,c.icon,a.center_serial,d.lscore,d.rscore,d.zlscore,d.zrscore");
        $result = $query->all();
        $temp = [];
        foreach ($result as $item) {
            array_push($temp, [
                "areacount" => ["ac" => Yii::$app->formatter->asInteger(ArrayHelper::getValue($item, "lscore")), "bc" => Yii::$app->formatter->asInteger(ArrayHelper::getValue($item, "rscore"))],
                "areasales" => ["ac" => Yii::$app->formatter->asInteger(ArrayHelper::getValue($item, "zlscore")), "bc" => Yii::$app->formatter->asInteger(ArrayHelper::getValue($item, "zrscore"))],
                "istop" => $item["center_serial"] > 0 ? true : false,
                "data" => [
                    "levelicon" => \common\components\MTools::getYiiParams("webimagepath") . ArrayHelper::getValue($item, "icon"),
                    "username" => ArrayHelper::getValue($item, "username"),
                    "levelname" => ArrayHelper::getValue($item, "name"),
                    "userid" => ArrayHelper::getValue($item, "userid"),
                    "reside" => ArrayHelper::getValue($item, "reside"),
                    "created_at" => Yii::$app->formatter->asDate(ArrayHelper::getValue($item, "created_at")),
                    "areacount" => ["ac" => Yii::$app->formatter->asInteger(ArrayHelper::getValue($item, "lscore")), "bc" => Yii::$app->formatter->asInteger(ArrayHelper::getValue($item, "rscore"))],
                    "areasales" => ["ac" => Yii::$app->formatter->asInteger(ArrayHelper::getValue($item, "zlscore")), "bc" => Yii::$app->formatter->asInteger(ArrayHelper::getValue($item, "zrscore"))],
                ],
                "pos" => substr(ArrayHelper::getValue($item, "reside"), -1)
            ]);
        }
        $count = count($temp);
        if ($count == 0) {
            $temp = [ ["pos" => 1], ["pos" => 2]];
        } else if ($count == 1) {
            array_push($temp, ["pos" => 2]);
        }
        return ["record" => $temp, "status" => true];
    }

    public static function getUserLevelTop($userid) {
        $result = WB_User::find()->where("id=:userid", [":userid" => $userid])->with(["userprofile", "wallet", "level", "balan"])->one();
        if ($result) {
            //数据设置
            $temp = [
                "areacount" => ["ac" => $result->balan ? $result->balan->lscore : 0, "bc" => $result->balan ? $result->balan->rscore : 0],
                "areasales" => ["ac" => $result->balan ? $result->balan->zlscore : 0, "bc" => $result->balan ? $result->balan->zrscore : 0],
                "istop" => $result->userprofile->center_serial > 0 ? true : false,
                "data" => [
                    "levelicon" => \common\components\MTools::getYiiParams("webimagepath") . $result->level->icon,
                    "username" => $result->username,
                    "levelname" => $result->level->name,
                    "userid" => $result->userprofile->userid,
                    "reside" => $result->userprofile->reside,
                    "created_at" => Yii::$app->formatter->asDate($result->created_at),
                    "areacount" => ["ac" => $result->balan ? $result->balan->lscore : 0, "bc" => $result->balan ? $result->balan->rscore : 0],
                    "areasales" => ["ac" => $result->balan ? $result->balan->zlscore : 0, "bc" => $result->balan ? $result->balan->zrscore : 0],
                ]
            ];
            return $temp;
        }
    }

    /*
     * 获取会员结构图
     * @params $user
     * @params $len  用于判断展示几层
     */

    public static function getUserStruct($user, $len) {
        if ($user) {
            if($user->userprofile->is_act==1){
                $res = self::getNextLevelList($user->userprofile->reside, $len);
                $str = '<div class="top">';
                $str .= '<div class="jiegou">';
                $str .= "<a style='display:block;margin:0;text-align:center;line-height:0;color: #fe9900;font-weight:700;' href='" . Url::toRoute(["register/userlist", "sid" => $user->id]) . "'>" . $user->level->name . "</a>";
                $str .= "<a style='display:block;margin:0;text-align:center;' href='" . Url::toRoute(["register/userlist", "sid" => $user->id]) . "' title='" . $user->username . "'>" . $user->username . "</a>";
               
                $str .= "<div class='zong' style='line-height:0.9;'>" . ($user->balan ? $user->balan->zlscore / 100 : 0 ) . " | " . ($user->balan ? $user->balan->zrscore / 100 : 0 ) . "</div>";
                if ($user->balan) {
                    if ($user->balan->lscore > $user->balan->rscore) {
                        $str .= "<div class='yu'>" . (($user->balan->zlscore - $user->balan->zrscore) / 100) . "  | 0</div>";
                    } else {
                        $str .= "<div class='yu'>0  | " . (($user->balan->zrscore - $user->balan->zlscore) / 100) . "</div>";
                    }
                } else {
                    $str .= "<div class='yu'>0  | 0</div>";
                }
                $str .= "</div>";
            }else{
                $res = self::getNextLevelList($user->userprofile->reside, $len);
                $str = '<div class="top">';
                $str .= '<div class="jiegou" style="background:#666;color:#000;">';
                $str .= "<a style='display:block;margin:0;text-align:center;line-height:0;color: #fe9900;font-weight:700;' href='" . Url::toRoute(["register/userlist", "sid" => $user->id]) . "'>" . $user->level->name . "</a>";
                $str .= "<a style='display:block;margin:0;text-align:center;'  href='" . Url::toRoute(["register/userlist", "sid" => $user->id]) . "' title='" . $user->username . "'>" . $user->username . "</a>";
             
                $str .= "<div class='zong'style='line-height:0.9;'>" . ($user->balan ? $user->balan->zlscore / 100 : 0 ) . " | " . ($user->balan ? $user->balan->zrscore / 100 : 0 ) . "</div>";
                if ($user->balan) {
                    if ($user->balan->lscore > $user->balan->rscore) {
                        $str .= "<div class='yu'>" . (($user->balan->zlscore - $user->balan->zrscore) / 100) . "  | 0</div>";
                    } else {
                        $str .= "<div class='yu'>0  | " . (($user->balan->zrscore - $user->balan->zlscore) / 100) . "</div>";
                    }
                } else {
                    $str .= "<div class='yu'>0  | 0</div>";
                }
                $str .= "</div>";
            }
            if (strlen($user->userprofile->reside) < $len) {
                $str .='<div class="top-line"></div>';
                if (count($res) > 0) {
                    if (isset($res[1])) {
                        $pos = substr($res[1]["reside"], -1, 1);
                        if ($pos == 1) {
                            $str .= '<div class="left">';
                            $str .= self::getUserStruct(\common\models\User::findOne($res[1]["userid"]), $len);
                            $str .= '<div class="left-line"></div>';
                            $str .= '</div>';
                            $str .='<div class="right">';
                            $str .= self::getUserStruct(\common\models\User::findOne($res[0]["userid"]), $len);
                            $str .= '<div class="right-line"></div>';
                            $str .= '</div>';
                        } else {
                            $str .= '<div class="left">';
                            $str .= self::getUserStruct(\common\models\User::findOne($res[0]["userid"]), $len);
                            $str .= '<div class="left-line"></div>';
                            $str .= '</div>';
                            $str .='<div class="right">';
                            $str .= self::getUserStruct(\common\models\User::findOne($res[1]["userid"]), $len);
                            $str .= '<div class="right-line"></div>';
                            $str .= '</div>';
                        }
                    } else {
                        $pos = substr($res[0]["reside"], -1, 1);
                        if ($pos == 1) {
                            $str .= '<div class="left">';
                            $str .= self::getUserStruct(\common\models\User::findOne($res[0]["userid"]), $len);
                            $str .= '<div class="left-line"></div>';
                            $str .= '</div>';
                            $str .= '<div class="right">';
                            $str .= '<div class="jiegou">';
                            $str .= "<a class='zhuce'style='display:block;margin:15px 0;' href='" . Url::toRoute(["register/signup", "id" => $user->userprofile->reside."-2"]) . "'>注册</a>";
                            $str .= "   </div>";
                            $str .= '<div class="right-line"></div>';
                            $str .= '</div>';
                        } else {
                            $str .= '<div class="left">';
                            $str .= '<div class="jiegou">';
                            $str .= "<a class='zhuce'style='display:block;margin:15px 0;' href='" . Url::toRoute(["register/signup", "id" =>  $user->userprofile->reside."-1"]) . "'>注册</a>";
                            $str .= "   </div>";
                            $str .= '<div class="left-line"></div>';
                            $str .= '</div>';
                            $str .='<div class="right">';
                            $str .= self::getUserStruct(\common\models\User::findOne($res[0]["userid"]), $len);
                            $str .= '<div class="right-line"></div>';
                            $str .= '</div>';
                        }
                    }
                } else {
                    $str .= '<div class="left">';
                    $str .= '<div class="jiegou">';
                    $str .= "<a  class='zhuce'style='display:block;margin:15px 0;' href='" . Url::toRoute(["register/signup", "id" =>  $user->userprofile->reside."-1"]) . "'>注册</a>";
                    $str .= "   </div>";
                    $str .= '<div class="left-line"></div>';
                    $str .= '</div>';
                    $str .= '<div class="right">';
                    $str .= '<div class="jiegou">';
                    $str .= "<a  class='zhuce'style='display:block;margin:15px 0;' href='" . Url::toRoute(["register/signup", "id" =>  $user->userprofile->reside."-2"]) . "'>注册</a>";
                    $str .= "   </div>";
                    $str .= '<div class="right-line"></div>';
                    $str .= '</div>';
                }
            }
            $str .= '</div>';
            return $str;
        } else {
            return;
        }
    }

    /*
     * 查询当前会员的下级
     * @params $reside
     * @params $len
     */

    public static function getNextLevelList($reside, $len) {
        $query = WB_UserProfile::find();
        $query->where("reside=:resideL or reside=:resideR and LENGTH(reside) <= $len", [":resideL" => $reside . "-1", ":resideR" => $reside . "-2"]);
        return $query->asArray()->all();
    }
    public static function getLevelId($id)
    {
        $levelid= WB_User::find()->select("levelid")->where("id=:id",[":id"=>$id])->asArray()->one();
        $level=$levelid['levelid'];
        return $level;
    }

    public static function getMyRecord($userid) {
        $code = WB_User::findOne($userid);
        $query = WB_User::find()->where("invite_code = :invite_code",[":invite_code"=>$code->mycode])->with(['userprofile'])->orderBy("created_at desc");
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page") - 1) * $pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        $temp=[];
        foreach($res as $item){
            $temp[]=[
                "id"=>$item['id'],
                "username"=>$item['username'],
                "phone"=>$item['userprofile']['phone'],
                "icon"=>$item['userprofile']['icon'],
                "created_at"=>date("Y-m-d H:i:s",$item['created_at']),
            ];
        }
        return ["pager" => $pager, "data" => $temp];
    }

    public static function getMyRecordLoad($userid,$page){

        $code = WB_User::findOne($userid);
        $query = WB_User::find()->where("invite_code = :invite_code",[":invite_code"=>$code->mycode])->with(['userprofile'])->orderBy("created_at desc");

        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'created_at';
        $order = isset($_GET['order']) ? $_GET['order'] : 'desc';
        $query->orderBy($sort . " " . $order);

        $pagesize = 10;

        $offset = ($page - 1) * $pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        $temp = [];
        for($i = 0;$i < count($res);$i++){
            $grade = Grade::find()->where('id = :id',[':id' => $res[$i]["grade_id"]])->one();
            $temp[$i]['created_at'] = Yii::$app->formatter->asDatetime($res[$i]["created_at"]);
            $temp[$i]['id'] = $res[$i]["id"];
            $temp[$i]['username'] = $res[$i]["username"];
            $temp[$i]['grade_id'] = $grade->name;
            $temp[$i]['phone'] = $res[$i]["userprofile"]['phone'];
            $temp[$i]['icon'] = $res[$i]["userprofile"]['icon'];
        }
        return $temp;
    }

}
