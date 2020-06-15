<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\EmailCode;

/**
 * Login form
 */
class LoginForm extends Model {

    public $username;
    public $password;
    public $rememberMe = true;
    public $verifyCode;
    public $lang;
    private $_user;
    private $_userPro;
    public $id;
    //正式开放时要打开
//    public $email_captcha;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['username', 'password'], 'required', 'message' => Yii::t('app','用户名或密码不正确')],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['username', 'checkusername'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            //正式开放式要打开下面两行
//            ['email_captcha', 'required',"message" => "验证码不能为空"],
//            ['email_captcha', "checkEmailCode"],
            // ['verifyCode', 'captcha','message' =>'验证码错误','captchaAction'=>'site/captcha'],
        ];
    }
    //  邮箱验证码校验
    public function checkEmailCode($attr, $params) {
        $code = EmailCode::find()->where('email=:email && code=:code', [':email' => $this->username, ':code' => $this->email_captcha])->orderBy('create_at desc')->one();
//        echo '<pre>';
//        var_dump($code);exit;
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
    //验证用户名是否存在
    public function checkusername($attribute, $params) {
        if (!$this->hasErrors()) {
            $userpro = $this->getUserPro();
            if (!$userpro) {
                $res_msg = Yii::t('app',"用户名或密码不正确");
                $this->addError($attribute, $res_msg);
            }
        }
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $res_msg = Yii::t('app',"用户名或密码不正确");
                $this->addError($attribute, $res_msg);
            }
        }
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            //  校验是否激活
//            if($this->_user->isactivate == 0){
//                if($this->lang == "en_US"){
//                    $res_msg = "Account is not activated, unable to login.";
//                } else{
//                    $res_msg = "账户未激活，无法登录";
//                }
//                echo json_encode(["status" => false,"message" => $res_msg]);
//                exit;
//            }
            //  校验是否被封
            if($this->_user->iseal>0){
                $res_msg = Yii::t('app',"账号被封，无法登陆！请联系管理员！");
                echo json_encode(["status" => '0002',"message" => $res_msg]);
                exit;
            }

            return Yii::$app->user->login($this->_user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
//            if($this->_user->iseal>0){
//                $res_msg = Yii::t('app',"账号被封，无法登陆！请联系管理员！");
//                echo json_encode(["status" => '0002',"message" => $res_msg]);
//                exit;
//            }
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUserPro() {
        if ($this->_userPro === null) {
            $this->_userPro = \common\models\UserProfile::findByUser($this->username);
        }
        return $this->_userPro;
    }

    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = \common\models\User::findByUsername($this->_userPro->username);
        }
        return $this->_user;
    }
}
