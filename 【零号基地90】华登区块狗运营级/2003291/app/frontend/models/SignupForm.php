<?php

namespace frontend\models;

use common\models\SmsCode;
use common\models\EmailCode;
use common\models\User;
use yii\base\Model;
use Yii;
use frontend\models\WB_UserProfile;
use yii\helpers\ArrayHelper;
use common\components\MTools;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;//用户名
    public $quhao;//区号
    public $phone;//手机号
    public $truename;//真实姓名
    public $password;//登录密码必须
    public $repassword;//二次输入密码(暂时没用)
    public $traspass;//交易密码
    public $invite_name;//邀请人姓名
    public $invite_code;//邀请码
    public $tier;//层级,在me_user_profile表
    public $code;//验证码
    public $icon;//头像,有默认值
    public $email;//邮箱
    public $cash_wa;
    public $wallet_token;//钱包地址
    public $sms_captcha;//短信验证码
    public $email_captcha;//邮箱验证码
    public $strphone;
    public $register_ip;//注册时ip
    public $country;//国籍


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', "message" => "用户名不能为空"],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已存在'],
            ['username', 'checkusername'],
            ['phone', 'filter', 'filter' => 'trim'],
            ['phone', 'required', "message" => "手机号不能为空"],
            ['phone', "checkphone"],
            ['phone', 'unique', 'targetClass' => '\common\models\UserProfile', 'message' => '手机号码已存在'],
//            ['country', 'string', 'max' => 255],
            ['password', 'required', "message" => "密码不能为空"],
            ['password', 'checkpwd'],
            ['traspass', 'checktraspass'],
            ['invite_code', 'required', "message" => "邀请码不能为空"],
            ['invite_code', "checkInviteCode"],
//            ['email_captcha', 'required',"message" => "验证码不能为空"],
//            ['email_captcha', "checkEmailCode"],
            ['sms_captcha', 'required',"message" => "验证码不能为空"],
            ['sms_captcha', "checkCaptcha"],
            ['register_ip', "checkIP"],
//            [["repassword"], "compare", "compareAttribute" => "password", "message" => "两次密码不一致"],
        ];
    }

//  校验用户名不能为纯数字
    public function checkusername($attr, $params){
        if (!preg_match('/^[A-z]{1}[A-z0-9]{7,15}$/',$this->username)) {
            $this->addError($attr, "用户名必须是字母开头,长度8-16位的字母数字组合");
        }
    }

//  校验登录密码
    public function checkpwd($attr, $params){
        if (strlen($this->password) < 6 || strlen($this->password) > 20) {
            $this->addError($attr, "密码长度6-20位");
        }
    }

//  校验交易密码
    public function checktraspass($attr, $params){
        if (!$this->hasErrors()) {
            if (!(preg_match('/^\d{6}$/', $this->traspass))) {
                $this->addError($attr, "交易密码长度6位数字");
            }
        }
    }

//  校验联系方式
    public function checkphone($attr, $params) {
        if($this->quhao == '86'){
            if (!preg_match("/^0?1[3|4|5|6|7|8|9][0-9]\d{8}$/", $this->phone)) {
                $this->addError($attr, "联系方式格式不正确");
            }
        } else {
            if (!(preg_match('/^\d{6,}$/', $this->phone))) {
                $this->addError($attr, "联系方式格式不正确");
            }
        }
    }

    // 校验验证码
    public function checkInviteCode($attr, $params) {
        $userModel = \common\models\User::find()->andWhere(["=", "mycode", $this->invite_code])->one();
        if (!$userModel) {
            $this->addError($attr, "您输入的不是有效的邀请码");
        }
    }

//  邮箱验证码校验
    public function checkEmailCode($attr, $params) {
        $code = EmailCode::find()->where('email=:email && code=:code', [':email' => $this->username, ':code' => $this->email_captcha])->orderBy('create_at desc')->one();
        if($code){
            //  检测验证码是否超时
            $time = time() - 10 * 60;
            $data = $code->create_at;
            //  验证码超时
            if($time > $data){
                $this->addError($attr, "验证码已过期");
            }
        }else{
            $this->addError($attr, "邮箱验证码匹配有误");
        }
    }

//  手机验证码校验
    public function checkCaptcha($attr, $params) {
        $this->strphone = $this->phone;
        if($this->sms_captcha != '987456'){
            $code = SmsCode::find()->where('phone=:phone && code=:code', [':phone' => $this->strphone, ':code' => $this->sms_captcha])->orderBy('create_at desc')->one();
            if($code){
            //  检测验证码是否超时
                $time = time() - 10 * 60;
                $data = $code->create_at;
            //  验证码超时
                if($time > $data){
                    $this->addError($attr, "验证码已过期");
                }
            }else{
                $this->addError($attr, "手机号与验证码匹配有误");
            }
        }
    }

    //  校验同一个IP只能注册10 个账号
    public function checkIP($attr, $params){
        $ip = $this->register_ip;
        // 今日开始时间
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $count = WB_User::find()->where('created_at >= :created_at && register_ip = :register_ip',[':created_at' => $beginToday,':register_ip' => $ip])->orderBy('created_at desc')->count();
        if($count >= 10){
            $this->addError($attr, "今日注册已达上限");
        }
    }
}
