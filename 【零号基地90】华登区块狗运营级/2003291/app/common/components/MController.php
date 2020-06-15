<?php

namespace common\components;

/**
 * @author  shuang
 * @date    2016-12-10 10:20:02
 * @version V1.0
 * @desc
 */
use Yii;
use yii\web\Controller;
use frontend\models\WB_User;
use common\models\UserRegistTrade;
use frontend\models\WB_UserAwardRecord;
use frontend\models\WB_UserWallet;
use frontend\controllers\Api;
use common\models\SmsCode;

class MController extends Controller{

    public $breadcrumb;
    public static $requestOvertime = 5;

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            if (Yii::$app->user->isGuest) {
                // $this->redirect(["site/login"]);
            }
            else{
            	
                // $userid = Yii::$app->user->id;
                // $userdata = \common\models\User::findOne($userid); //  获取用户的所有信息
                // $token = Yii::$app->session['token'];
                // if($userdata->app_token != $token || $userdata->iseal == 1){
                //     $res = [
                //         'status' => '0003',
                //         'message' => '',
                //     ];
                //     echo json_encode($res);
                //     exit();
                // }
            }
            return true;
        }

        return false;
    }

    // 统一的消息处理方法
    public static function retjson($status, $message, $data = null) {
        $res['status'] = $status;
        $res['message'] = $message;
        if($data != null) {
            $res['data'] = $data;
        }
        echo json_encode($res);
        exit;
    }

    // 统一的多次连续点击或请求的处理方法
    public static function timedelay() {
        $session = Yii::$app->session;
        $times = $session["time"];
        if($times > 0 ){
            if((int)$times + self::$requestOvertime > time()){
                self::retjson('0002', Yii::t("app","服务器繁忙，请返回确认操作是否执行！"));
            }
        }
        $session->set("time", time());
    }


    //  短信验证码校验
    public static function checkPhoneCode($userdata,$code) {
        $strphone = $userdata->userprofile->phone;
        $code = SmsCode::find()->where('phone = :phone && code=:code', [':phone' => $strphone, ':code' => $code])->orderBy('create_at desc')->one();
        if($code){
            //  检测验证码是否超时
            $time = time() - 10 * 60;
            $data = $code->create_at;
            //  验证码超时
            if($time > $data){
                MController::retjson('0002',Yii::t('app','验证码已过期'));exit;
            }
            return true;
        }else{
            MController::retjson('0002',Yii::t('app','验证码匹配有误'));exit;
        }
    }
}
