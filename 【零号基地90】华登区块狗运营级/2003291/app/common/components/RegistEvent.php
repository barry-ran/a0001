<?php

namespace common\components;

/**
 * @author  shuang
 * @date    2016-12-1 22:02:06
 * @version V1.0
 * @desc    
 */
use common\models\Grade;
use common\models\User;
use common\models\UserProfile;
use common\models\UserWallet;
use common\models\UserWalletRecord;
use yii\base\Event;
use yii\helpers\ArrayHelper;
use Yii;
use frontend\models\WB_User;
use common\models\Compower;

class RegistEvent extends Event {
    private $_userrefer;

    /*
     * 数据模型错误提示
     * @params $array ["errors"=>[]]
     */

    private function errorMessage($errors) {
        foreach ($errors as $item) {
            $this->sender->message = $item[0];
            break;
        }
    }

    /*
     * 是否开启注册功能
     */

    private function openRegist() {
        if (MTools::getYiiParams("registerOff") == 0) {
            $this->sender->message = "系统已经关闭了注册功能，如有疑问请联系管理员";
            return false;
        }
        return true;
    }
    /*
     * 推荐人的所有下级
     */
     public function setDownreferrerid($account,$data,$userprofile,$user){
        //判断推荐人是否有上级多代推荐人
        if($account->up_referrer_id == '' || $account->up_referrer_id == null){
            //推荐人没有上级多代推荐人,当前注册用户的上级多代推荐人就是推荐人的userid
            $userprofile->up_referrer_id = (string)$account->userid;
            //判断是否有多带下级
            if($account->down_team_id == '' || $account->down_team_id == null){
                //没有多代下级,给推荐人的多代下级id就是当前注册用户的userid
                $account->down_team_id = (string)$user->id;
            }else{
                //有多代下级,推荐人的多代下级id就在当前基础上增加当前用户的userid,以'-'隔开
                $account->down_team_id = $account->down_team_id ."-".$user->id;
            }
            $account->save();
        }else{
            //推荐人有上级多代推荐人,当前注册用户的多代上级推荐人就是推荐人的多代上级推荐安人增加推荐人的userid
            $userprofile->up_referrer_id = $account->up_referrer_id.'-'.$account->userid;
            //获取当前注册用户多代推荐人userid数组
            $arr = explode("-", $userprofile->up_referrer_id);
            //遍历多代推荐人,使其的下级id增加当前注册用户的userid,并判断是否获取奖励
            for($i = 0;$i < count($arr);$i++){
                $res = \common\models\UserProfile::find()->where("userid = $arr[$i]")->one();
                if($res->down_team_id == '' || $res->down_team_id == null){
                    $res->down_team_id = (string)$user->id;
                }else{
                    $res->down_team_id = $res->down_team_id ."-".$user->id;
                }
                $res->save();
            }
        }
        return true;
    }

    public function setnode($amount,$userprofile){
         //  $amount 推荐人信息
        $count = \common\models\userprofile::find()->where('referrerid = :referrerid',[':referrerid'=>$amount->userid])->count();
        $count = $count ? $count : 0;
        $nn = $count + 1;
        $userprofile->node = $amount->node."-".$nn;

        $userprofile->save();
        return true;
    }

     /*
     * 检测推荐人是否存在
     */

    protected function checkReferexist() {
        $this->_userrefer = WB_User::find()->where("id=:userid && iseal=0 && isout=0", [":userid" => $this->referrerid])->with(["userprofile", "wallet", "level"])->one();
        if (!$this->_userrefer instanceof WB_User) {
            $this->sender->message = Yii::t('app',"您填写的推荐人并不存在或者已被冻结或者已出局");
            return false;
        }
        return true;
    }
     protected function checkReferexist2($mycode) {
        $this->_userrefer = WB_User::find()->where("mycode=:mycode ", [":mycode" => $mycode])->one();
        if (!$this->_userrefer instanceof WB_User) {
            $this->sender->message = Yii::t('app',"推荐人不存在");
            return false;
        }
        return true;
    }

    //注册事件
    public function addRegisterEvent() {
        $model = ArrayHelper::getValue($this->data, "model");
        //获取推荐人信息
        $data = \common\models\User::find()->with(['wallet','userprofile'])->where('mycode=:mycode',[':mycode'=>$model->invite_code])->one();

        $lastdata = WB_User::find()->orderBy('id desc')->one(); //  查询出User表中最后一条数据

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
            $userid = 1860;
        }

//        $minhcg = MTools::getYiiParams('minhcg'); // 有效会员最低卢呗
        $referstate = true;
        //检测邀请码是否存在
        if($data == '' || $data == NULL){
            MController::retjson('0002',Yii::t('app','推荐人不存在'));
//            $res_msg = Yii::t('app',"推荐人不存在");
//            $this->sender->flag = '0002';
//            $this->sender->message = $res_msg;
        }else {
            //验证表单数据
            if ($referstate) {
                $trans = Yii::$app->db->beginTransaction();
                try {
                    $user = new \common\models\User();
                    $user->id = $userid;
                    $user->username = trim($model->username);//自由账号
                    $user->invite_code = $data->mycode;//邀请码
                    $user->mycode = MTools::makeOnlyNumber();//生成自身邀请码
                    $user->setPassword(trim($model->password));
                    $user->setPassword2($model->traspass);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $user->status = 10;
                    $user->last_login_at = time();
                    $user->login_ip = Yii::$app->api->realIp();
                    $user->created_at = time();
                    $user->updated_at = time();
                    $user->register_ip = Yii::$app->api->realIp();
                    $user->country = '';
//                    $user->branch_id = $data->branch_id;
                    if ($user->save()) {
                        $userprofile = new \common\models\UserProfile();
                        $userprofile->userid = $user->id;
                        $userprofile->icon = 'img/header.png';
                        $userprofile->username = trim($model->username);
                        $userprofile->email = '';
                        $userprofile->quhao = trim($model->quhao);
                        $userprofile->phone = trim($model->phone);
                        $userprofile->wallet_token = \backend\models\UserForm::wallettoken();//生成钱包随机码
                        //查询出userprofile表中上级的信息
                        $userprofile->referrer = $data->username;
                        $userprofile->referrerid = $data->id;
                        $userprofile->created_at = time();
                        //设置推荐人的下级并且颁发奖励
                        $account = UserProfile::find()->where('userid = :userid',['userid'=>$data->id])->one();

                        $this->setDownreferrerid($account,$data, $userprofile, $user);

                        $userprofile->tier = $account->tier + 1; //当前用户的tier字段相对于推荐人的层级加一
                        $this->setnode($account, $userprofile);

//                    && $this->shopLogin($user->username,$userprofile->phone,$model->password)3
                        if ($userprofile->save() && $this->reg_award($user)) {

//                            $grade = new Grade();
//                            $grade->gradeChangeByHcg(Yii::$app->user->identity);

                            $trans->commit();
                            $res_msg = Yii::t('app', "恭喜注册成功！用户名：") . $model->username;

                            $this->sender->flag = '0001';
                            $this->sender->message = $res_msg;
                        } else {
                            $this->errorMessage($userprofile->errors);
                        }
                    } else {
                        $res_msg = Yii::t('app', "注册失败");
                        $this->sender->message = $res_msg;
                    }
                } catch (Exception $ex) {
                    $trans->rollBack();
                    throw new \yii\web\NotFoundHttpException($ex);
                }
            }
        }
        $this->errorMessage($model->errors);
        return false;
    }

    private function shopLogin($user_name, $telephone, $password){
        $user_password = md5($password);
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

    private function token($length = 32) {
        // Create random token
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        $max = strlen($string) - 1;

        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $token .= $string[mt_rand(0, $max)];
        }

        return $token;
    }

    private function reg_award($user){
        //  用户注册，插入userwallet表
        $wallet = new \common\models\UserWallet();

        $wallet->userid = $user->id;

        if($wallet->save()){
            return true;
        } else {
            return false;
        }
//        //  用户注册，获得卢呗
//        $ip = Yii::$app->request->userIP;
//        $wallet = new \common\models\UserWallet();
//        $wallet->userid = $user->id;
//        $hcg_wa = MTools::getYiiParams('givehcg');  // 注册赠送卢呗
//        if($hcg_wa != 0){
//            $wallet->hcg_wa += $hcg_wa;
//            //  钱包记录
//            $note = '注册赠送'.$hcg_wa.'卢呗';
//            UserWalletRecord::insertrecord($user->id,$hcg_wa,22,1,1,$wallet->hcg_wa,$note,$user->branch_id);
//        }
//        if($wallet->save()){
//            return true;
//        } else {
//            return false;
//        }
    }

}
