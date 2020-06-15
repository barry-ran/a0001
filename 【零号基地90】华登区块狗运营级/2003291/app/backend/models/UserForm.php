<?php

namespace backend\models;

use common\models\User;
use common\models\UserWalletRecord;
use yii\base\Model;
use backend\models\MY_UserProfile;
use backend\models\MY_UserWallet;
//use backend\models\MY_UserStock;
use Yii;
use common\components\MTools;

class UserForm extends Model {

    public $username; //用户名
    public $password; //初始密码
    public $traspass; //支付密码
    public $phone;  //手机号
    public $email;  //邮箱
    public $truename;   //真实姓名
    public $idcard;     //身份证号
    public $invite_code;     //邀请码

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['username','phone'], 'required'],
//            [['username', 'truename', 'phone'], 'required'],
            [['username'], 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已存在'],
            [['username'],"match", "pattern" => "/^[A-z]{1}[A-z0-9]{7,15}$/", "message" => "用户名格式不正确"],
            [['phone'], "match", "pattern" => "/^((0\\d{2,3}(-){0,1}\\d{7,8})|(1[35847]\\d{9}))$/", "message" => "联系方式格式不正确"],
            ['phone', "checkphone"],
//            ['email', 'email'],
//            // [['levelid', 'areaid'], 'compare', 'compareValue' => 0, 'operator' => '>'],
//            ['idcard', 'checkidcard'],
            [['invite_code'], 'string', 'max' => 10],
        ];
    }

    public function checkphone($attr, $params) {
        $count = MY_UserProfile::find()->where("phone=:phone", [":phone" => $this->phone])->count();
        if ($count > 0) {//= MTools::getYiiParams("phoneLimit")
            $this->addError($attr, "同一个手机号最多只能注册1主账号");//" . MTools::getYiiParams("phoneLimit") . "
        }
    }

    public function checkidcard($attr, $params) {
        if (!preg_match("  /^([\d]{17}[xX\d]|[\d]{15})$/", $this->idcard)) {
            $id = strtoupper($this->idcard);
            //ミダだ计皚
            $headPoint = array(
                'A' => 1, 'I' => 39, 'O' => 48, 'B' => 10, 'C' => 19, 'D' => 28,
                'E' => 37, 'F' => 46, 'G' => 55, 'H' => 64, 'J' => 73, 'K' => 82,
                'L' => 2, 'M' => 11, 'N' => 20, 'P' => 29, 'Q' => 38, 'R' => 47,
                'S' => 56, 'T' => 65, 'U' => 74, 'V' => 83, 'W' => 21, 'X' => 3,
                'Y' => 12, 'Z' => 30
            );
            //ミ舦膀计皚
            $multiply = array(8, 7, 6, 5, 4, 3, 2, 1);
            //浪琩ōΑ琌タ絋
            if (preg_match("/^[a-zA-Z][1-2][0-9]+$/", $id) && strlen($id) == 10) {
                //ち秨﹃
                $stringArray = str_split($id);
                //眔ダだ计(繷)
                $total = $headPoint[array_shift($stringArray)];
                //眔ゑ癸絏(Ю)
                $point = array_pop($stringArray);
                //眔计场だだ计
                $len = count($stringArray);
                for ($j = 0; $j < $len; $j++) {
                    $total += $stringArray[$j] * $multiply[$j];
                }
                //璸衡緇计絏ゑ癸
                $last = (($total % 10) == 0 ) ? 0 : (10 - ( $total % 10 ));
                if ($last != $point) {
                    $this->addError($attr, "身份证号格式不正确");
                }
            } else {
                $this->addError($attr, "身份证号格式不正确");
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'username' => '用户名',
            "truename" => "真实姓名",
            'phone' => '联系电话',
            'idcard' => '身份证号',
            'email' => "电邮地址",
            'password' => "登录密码",
            'traspass' => "交易密码",
            'invite_code' => "邀请码",
        ];
    }

    public static function createData() {
        $model = new UserForm();
        $model->load(Yii::$app->request->post());
        //验证表单数据
        if (!$model->validate()) {
            return ["errors" => $model->errors, "model" => $model];
        }

        //注册会员从968开始跳，每注册一个会员id在区间内随机增长
        $lastdata = User::find()->orderBy('id desc')->one(); //  查询出User表中最后一条数据
        //设置新用户的userid
        if($lastdata){
            //获取会员id增长最大值
            $idrandmax = MTools::getYiiParams('idrandmax');
            if($idrandmax == 0){
                $add = 1;
            } else {
                $idaddmax = $idrandmax?$idrandmax:5;
                $add = rand(1,$idaddmax);
            }
            $userid = $lastdata->id + $add;

        } else {
            $userid = 1; //十二宠物 id从1开始
        }
        $trans = Yii::$app->db->beginTransaction();
        try {
            $user = new \common\models\User();
            $user->id = $userid;
            $user->username = $model->username;
            if($model->invite_code){
                $user->invite_code = $model->invite_code; // 邀请码
            }
            $user->mycode = MTools::makeOnlyNumber();
            $user->setPassword(111111);
            $user->setPassword2(111111);
            $user->generateAuthKey();
            $user->generatePasswordResetToken();

//            // 国籍选择
//            $country = ['China','UnitedStatesofAmerica','UnitedKiongdom','Korea','Russia','Japan','Venezuela'];
//            $a = '';
//            $length = count($country) - 1;
//            $rand = mt_rand(0,$length);
//            $checkOne = $country[$rand];
            $user->country = '';

            if ($user->save()) {
                //保存基本信息
                $userprofile = new MY_UserProfile();
                $userprofile->userid = $user->id;
                $userprofile->username = $model->username;
                $userprofile->idcard = $model->idcard;
                $userprofile->truename = $model->truename;
                $userprofile->phone = $model->phone;
                $userprofile->quhao = '86';

                $userprofile->email = '';
                $userprofile->wallet_token = "v".self::wallettoken();
                $userprofile->created_at = time();

                if($model->invite_code){
                    $data = \common\models\User::find()->where('mycode=:mycode',[':mycode'=>$model->invite_code])->one();
                    // 查询出userprofile表中上级的信息,也就是推荐人,条件是推荐人id
                    $account = \common\models\UserProfile::find()->where('userid = :userid',[':userid'=>$data->id])->one();
                    // 推荐人姓名
                    $userprofile->referrer = $data->username;
                    $userprofile->referrerid = $data->id;
                    //设置上下多代推荐人id
                    self::setDownreferrerid($account, $userprofile,$user);
                    $userprofile->tier = $account->tier + 1; //当前用户的tier字段是推荐人tier字段值加一
                    self::setnode($account, $userprofile);
                } else {
                    $userprofile->node = (string)$user->id;
                }

                $ac_log = \common\models\Actionlog::setLog('设置初始会员'.$user->username);
                //创建新用户钱包
                $userwallet = new MY_UserWallet();
                $userwallet->userid = (string)$user->id;

                if ($userprofile->save() && $ac_log && $userwallet->save()) {
                    $trans->commit();
                    return true;
                } else {
                    return ["errors" => $userprofile->errors, "model" => $model];
                }
            } else {
                return ["errors" => $user->errors, "model" => $model];
            }
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException($ex);
        }
    }
    
    //生成钱包随机码
    public static function wallettoken(){   
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';  
        $key="";
        for($i=0;$i<32;$i++){   
            $key .= $pattern{mt_rand(0,61)};    //生成php随机数   
        }
        $user = \common\models\UserProfile::find()->where("wallet_token=:key",[":key"=>$key])->one();
        if($user){
           self::wallettoken();
        }
        return $key;   
    }
    
    public static function shopLogin($user_name, $telephone){
        $user_password = md5(111111);
        $ip = Yii::$app->request->userIP;
        $reg_time = time();
        $sql1 = "insert into `sys_user`(instance_id, user_name, user_password, is_member, user_tel, user_tel_bind, current_login_ip, current_login_type, real_name, nick_name, reg_time) VALUES 
(0,'$user_name', '$user_password', 1, '$telephone', 1,'$ip', 1,'$user_name', '$user_name',$reg_time)";
        $res1 = Yii::$app->db2->createCommand($sql1)->execute();
        if($res1){
            $ns_user = Yii::$app->db2->createCommand("select `uid` from `sys_user` where `user_name`='$user_name'")->queryOne();
            $uid = $ns_user['uid'];
            $sql2 = "insert into `ns_member`(uid, member_name, reg_time) VALUES ($uid,'$user_name',$reg_time)";
            Yii::$app->db2->createCommand($sql2)->execute();
            $sql3 = "insert into `ns_member_account`(uid, shop_id) VALUES ($uid,0)";
            Yii::$app->db2->createCommand($sql3)->execute();
            return true;
        }else{
            return false;
        }
    }

    public static function reg_award($user){
        //  用户注册，获得BBA
        $ip = Yii::$app->request->userIP;
        $wallet = new \common\models\UserWallet();
        $wallet->userid = $user->id;
        $hcg_wa = MTools::getYiiParams('givehcg');  // 注册赠送卢呗

        $walletRecord = true;
        if($hcg_wa && $hcg_wa > 0){
            $wallet->hcg_wa += (float)$hcg_wa;
            //  钱包记录
            $note = '注册赠送'.$hcg_wa.'BBA';
            $walletRecord = UserWalletRecord::insertrecord($user->id,$hcg_wa,22,1,1,$wallet->hcg_wa,$note,0);
        }

        if($wallet->save() && $walletRecord){
            return true;
        } else {
            return false;
        }
    }

    /*
    * 推荐人的所有下级
    * $account 推荐人的profile信息
    * $userprofile 注册人的profile信息
    * $user    注册人的user表信息
    */
    public static function setDownreferrerid($account,$userprofile,$user){

        //判断推荐人是否有多代推荐人
        if($account->up_referrer_id == '' || $account->up_referrer_id == null){
            //没有多代推荐人
            $userprofile->up_referrer_id = (string)$account->userid;
            if($account->down_team_id == '' || $account->down_team_id == null){
                $account->down_team_id = (string)$user->id;
            }else{
                $account->down_team_id = $account->down_team_id ."-".$user->id;
            }
            $account->save();
        }else{
            //有多带推荐人
            $userprofile->up_referrer_id = $account->up_referrer_id.'-'.$account->userid;
            $arr = explode("-", $userprofile->up_referrer_id);
            for($i = 0;$i < count($arr);$i++){
                $res = \common\models\UserProfile::find()->where("userid = $arr[$i]")->one();
                $res->down_team_id = $res->down_team_id ."-".$user->id;
                $res->save();
            }
            if($account->down_team_id == '' || $account->down_team_id == null){
                $account->down_team_id = (string)$user->id;
                $account->save();
            }
        }
        return true;
    }

    public static function setnode($amount,$userprofile){
        //  $amount 推荐人信息
        $count = \common\models\userprofile::find()->where('referrerid = :referrerid',[':referrerid'=>$amount->userid])->count();
        $count = $count ? $count : 0;
        $nn = $count + 1;
        $userprofile->node = $amount->node."-".$nn;

        $userprofile->save();
        return true;
    }
}
