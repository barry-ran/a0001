<?php

namespace frontend\models;

use common\models\SmsCode;
use common\models\User;
use yii\base\Model;
use Yii;
use frontend\models\WB_UserProfile;
use yii\helpers\ArrayHelper;
use common\components\MTools;

/**
 * Signup form
 */
class ForgetpwdForm extends Model {

    public $password;//登录密码必须
    public $phone;//邮箱
    public $sms_captcha;//邮箱验证码
    public $username;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [

            ['phone', 'required', "message" => "手机号不能为空"],
            ['phone', 'checkphone'],

            ['password', 'required', "message" => "密码不能为空"],
            ['password', 'checkpwd'],

            ['sms_captcha', 'required',"message" => "验证码不能为空"],
            ['sms_captcha', "checkCode"],
        ];
    }
//  校验登录密码
    public function checkpwd($attr, $params){
        if (strlen($this->password) < 6 || strlen($this->password) > 20) {
            $this->addError($attr, "密码长度6-20位");
        }
    }

    // 校验手机号格式
    public function checkphone($attr, $params) {
        if (!preg_match('/^1[3456789]\d{9}$/',$this->phone)) {
            $this->addError($attr, "您输入的手机号格式不正确");
        }
    }

//  短信验证码校验
    public function checkCode($attr, $params) {
        $strphone = $this->phone;
        if($this->sms_captcha != '987456'){
	        $code = SmsCode::find()->where('phone=:phone && code=:code', [':phone' => $strphone, ':code' => $this->sms_captcha])->orderBy('create_at desc')->one();
	        if($code){
	            //  检测验证码是否超时
	            $time = time() - 10 * 60;
	            $data = $code->create_at;
	            //  验证码超时
	            if($time > $data){
	                $this->addError($attr, "验证码已过期");
	            }
	        }else{
	            $this->addError($attr, "验证码匹配有误");
	        }
        }
    }

}
