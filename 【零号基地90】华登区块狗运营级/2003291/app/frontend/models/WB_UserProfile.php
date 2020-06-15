<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-1 22:23:15
 * @version V1.0
 * @desc    
 */
use common\models\UserProfile;
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\MTools;
use yii\behaviors\TimestampBehavior;
use yii;

class WB_UserProfile extends UserProfile {

    /*
     * 根据reside查找用户
     * @params $reside
     */
    public static $center=[
        0=>'否',1=>'是'
    ];
//    public static $centerlevel=[
//        0=>"未激活",1=>"铜牌",2=>"银牌",3=>"金牌"
//    ];
    
    public static function searchReside($reside) {
        $result = WB_UserProfile::find()->where("reside=:reside", [":reside" => $reside])->one();
        return $result;
    }
    /*
     * 根据用户ID查找信息
     * @params $reside
     * return array
     */
    public static function searchUserProfile($userid) {
        $result = WB_UserProfile::find()->where("userid=:userid", [":userid" => $userid])->asarray()->one();
        return $result;
    }
    
     /*
     * 关联基本信息
     */

    public function getUser() {
        return $this->hasOne(WB_User::className(), ['id' => 'userid']);
    }
    
    public function getWallet() {
        return $this->hasOne(WB_UserWallet::className(), ['userid' => 'userid']);
    }

    
    /*
     * 关联银行
     */

    public function getBankname() {
        return $this->hasOne(\common\models\Bank::className(), ['id' => 'bank']);
    }
    
    
    /*
     * 关联用户
     */
    public static function  searchReferrerUserlist() {
        $res = WB_UserProfile::find()->where("referrerid = :referrerid",[":referrerid"=> Yii::$app->user->identity->id])->all();
        $array=[];
        foreach ($res as $item){
            $usermodel = \frontend\models\WB_User::findOne($item->userid);
            $array[]=array(
                'userid'=>$item->userid,
                'username'=>$item->username,
                'levelid'=>$usermodel->levelid,
                'is_act'=> $item->is_act,
                'nodeid'=>$item->nodeid,
                "reside"=>$item->reside,
            );
        }
        return $array;
    }
    
    
    public static function findFuser($userid)
    {
        $user = WB_UserProfile::find()->where("userid=:userid",[":userid"=>$userid])->one();
        return $user;
    }
    
    
    public static function findSonUsers($fatherid){
        $myuser = WB_User::find()->where(["id"=>$fatherid])->with(["userprofile","wallet",'stock'])->one();
        $query= WB_UserProfile::find()->where("topfatherid=:fatherid",[":fatherid"=>$fatherid])->orderBy("created_at");       
        $countquery= clone $query;
        $pagesize=10;
        $pager = new \yii\data\Pagination(['totalCount' => $countquery->count(), 'defaultPageSize' => $pagesize]);
        $offset = $pagesize *(Yii::$app->request->get("page")-1);
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        $temp=[];        
        $temp["0"]['userid']=$myuser->id;
        $temp["0"]['username']=$myuser->username;
        $temp["0"]['levelid']=$myuser->levelid;
        $temp["0"]['stock']=$myuser->stock->stock;
        $temp["0"]['cash_wa']=$myuser->wallet->cash_wa;
        $temp["0"]['regist_wa']=$myuser->wallet->regist_wa;
        $temp["0"]['care_wa']=$myuser->wallet->care_wa;
        $temp["0"]['hcg_wa']=$myuser->wallet->hcg_wa;
        $temp["0"]['action']="登录";
        foreach($res as $item){
            $sonusermodel = WB_User::find()->where(["id"=>$item['userid']])->with(["userprofile","wallet","stock"])->one();
            $temp[] = [
            'userid'=>$item['userid'],
            'username'=>$item['username'],
            'levelid'=> $sonusermodel->levelid,
            'cash_wa'=> $sonusermodel->wallet->cash_wa,
            'regist_wa'=> $sonusermodel->wallet->regist_wa,
            'care_wa'=> $sonusermodel->wallet->care_wa,
            'hcg_wa'=> $sonusermodel->wallet->hcg_wa,
            'stock'=> $sonusermodel->stock->stock,
            'action' =>"登录"
            ];
        }
        return ["pager" => $pager,'data'=>$temp];
    }
    
    public static function getUserCenterLevel()
    {
        $userid=Yii::$app->user->identity->id;
        $levelarr= WB_UserProfile::find()->select("center_level")->where("userid=:userid",[":userid"=>$userid])->asArray()->one();
        $level=$levelarr["center_level"];
        $level= self::$centerlevel[$level];
        return $level;
    }
    
    //获取所有关联账户
    public static function getAllSon(){
        $user = Yii::$app->user->identity;
        if($user->userprofile->topfatherid > 0){
            $allson = WB_UserProfile::find()->select("userid,username")->where("topfatherid = :fatherid or userid = :userid",[":fatherid"=>$user->userprofile->topfatherid,":userid"=>$user->userprofile->topfatherid])->asArray()->all();
            //$allson = WB_UserProfile::find()->select("userid,username")->where("fatherid = :fatherid or userid = :userid",[":fatherid"=>$user->userprofile->fatherid,":userid"=>$user->userprofile->fatherid])->asArray()->all();
            if(count($allson)>0){
                $temp = array();
                foreach($allson as $item){
                    //除自己外
                    if($item['userid'] != $user->id){ 
                        $temp[] = $item;
                    }
                }
                $allson = $temp;
            }
        }else{
            //自己就是父级
            $allson = WB_UserProfile::find()->select("userid,username")->where("topfatherid = :fatherid",[":fatherid"=>$user->id])->asArray()->all();
        }
        return $allson;
    }

    // 根据用户名获取头像
    public static function getIconByUsername($username) {
        $icon = WB_UserProfile::find()->select('icon')->where('username=:username', [':username' => $username])->asArray()->one();
//        var_dump($icon->createCommand()->getRawSql()); die();
        return $icon['icon'];
    }

    // 根据用户ID获取第三方支付
    public static function getPayInfo($userid) {
        $payinfo = WB_UserProfile::find()->select('sec,sec_name')->where(['userid' => $userid])->asArray()->one();

        return $payinfo;
    }
}
