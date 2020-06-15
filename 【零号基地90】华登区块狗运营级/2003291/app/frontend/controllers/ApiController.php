<?php

namespace frontend\controllers;

use common\models\ZodiacGrade;
use Yii;
use yii\db\Exception;
use common\models\Zodiac;
use common\models\Coins;
use common\models\Grade;
use common\models\StockPriceRecord;
use common\models\User;
use common\models\DtAward;//奖励类
use frontend\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\ForgetpwdForm;
use frontend\models\WB_ZodiacIssue;
use frontend\models\WB_Zodiac;
use common\models\UserWalletRecord;
use common\models\UserProfile;
use common\components\MTools;
use common\components\MController;
use common\models\SmsCode;
use common\models\EmailCode;//邮箱验证码model表类
use yii\helpers\HtmlPurifier;
use common\models\UserSign;
use yii\web\Controller;

/**
 * Api controller
 */
class ApiController extends Controller
{

    public $message = "";
    public $flag = false;

    /**
     * 语言切换
     */
    private function switchLanguage($language)
    {
        if ($language) {
            Yii::$app->session['language'] = $language;
        } else {
            Yii::$app->session['language'] = 'en_US';
        }
    }

    /**
     *  国际验证码发送
     */
    public function actionIntsendmsg()
    {
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $quhao = '86';
            $phone = HtmlPurifier::process($post["phone"]);
            $reg = '/^0?1[3|4|5|6|7|8|9][0-9]\d{8}$/';
            if(!preg_match($reg,$phone)){
                $res = [
                    "status" => '0002',
                    "message" => Yii::t('app', "手机格式不对")
                ];
                return json_encode($res);
            }
            $strphone = $quhao . "" . $phone;

            //  发送短信次数的判断
            //  三分钟之内只能发送三次
            $time = time() - 3 * 60;
            $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at', [':phone' => $strphone, 'create_at' => $time])->orderBy('create_at desc')->count();
            if ($sendnum >= 3) {
                $res = [
                    "status" => '0002',
                    "message" => Yii::t('app', "发送太过频繁")
                ];
                return json_encode($res);
            }

            // 一天只能发送五次
            // php获取今日开始时间戳
            $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at', [':phone' => $strphone, 'create_at' => $beginToday])->orderBy('create_at desc')->count();
            if ($sendnum >= 5) {
                $res = [
                    "status" => '0002',
                    "message" => Yii::t('app', "今日短信发送次数达到上限")
                ];
                return json_encode($res);
            }

            //  一个IP地址一天只能发送十次
            $ip = Yii::$app->getRequest()->getUserIP();
            $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at && ip = :ip', [':phone' => $strphone, 'create_at' => $beginToday, 'ip' => $ip])->orderBy('create_at desc')->count();
            if ($sendnum >= 10) {
                $res = [
                    "status" => '0002',
                    "message" => Yii::t('app', "今日短信发送次数达到上限")
                ];
                return json_encode($res);
            }

            Yii::$app->session->set("mobile", $phone);
            setcookie('mobile', $phone, time() + 3600);

/*            $flag = \common\components\MTools::SendMsg($quhao, $strphone);

            $flag = json_decode(json_encode($flag), true);
            if ($flag > 0) {
                $res = [
                    "status" => '0001',
                    "message" => Yii::t('app', "发送成功")
                ];
                return json_encode($res);
            } else {
                $res = [
                    "status" => '0002',
                    "message" => Yii::t('app', "发送失败")
                ];
                return json_encode($res);
            }*/
            $checkStatus = \common\components\MTools::smsg($phone,'1');
            if ($checkStatus==true){
              $res = [
                  "status" => '0001',
                  "message" => Yii::t('app', "发送成功")
              ];
              return json_encode($res);
            }else{
              $res = [
                  "status" => '0002',
                  "message" => Yii::t('app', "发送失败")
              ];
              return json_encode($res);
            }
        }
    }

    /**
     * 首页轮播图
     * @return array
     */
    private function banner()
    {
        //获取所有轮播图地址
        $img_src = \common\models\Advertisement::find()->all();
        $banner = [];
        foreach ($img_src as $key => $val) {
            $banner[$key]['img'] = $val->img;
        }
        return $banner;
    }

    /**
     *  注册
     */
    public function actionRegisterapi()
    {
        $this->layout = false;//不是用模板
        $model = new SignupForm();//实例化SignupForm对象
        //判断是否是post请求
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            //验证验签是否正确
            $sign = MTools::validsign($post);
            if (!$sign) {
                MTools::retjson('0002',Yii::t('app','验签错误'));exit;
            }
            $model->quhao = '86';
            //用户名
            $model->username = trim(HtmlPurifier::process(isset($post["username"])?$post['username']:''));
            //手机号
            $model->phone = trim(HtmlPurifier::process(isset($post["phone"])?$post['phone']:''));
            //密码
            $model->password = HtmlPurifier::process(isset($post["password"])?$post['password']:'');
            //二级密码
            $model->traspass = HtmlPurifier::process(isset($post["traspass"])?$post['traspass']:'');
            //获取推荐人信息
            $invite_code = HtmlPurifier::process(isset($post["invite_code"])?$post['invite_code']:'');//邀请码
            $invite_user = User::find()->where('mycode = :mycode', [':mycode' => $invite_code])->one();
            if ($invite_user) {
                //保存推荐人邀请码
                $model->invite_code = $invite_user->mycode;
            } else {
                MTools::retjson('0002',Yii::t('app','您输入的不是有效的邀请码'));exit();
            }
            $model->sms_captcha = HtmlPurifier::process($post["code"]);
            //注册的IP地址
            $model->register_ip = Yii::$app->api->realIp();
            //检验输入的数据是否合法
            if (!$model->validate()) {
                foreach ($model->errors as $errors) {
                    $message = $errors[0];
                    break;
                }
                echo json_encode(["status" => '0002', "message" => Yii::t('app', $message)]);
                exit();
            }
            //绑定注册事件
            $event = new \common\components\RegistEvent();
            $this->on("add_register", [$event, "addRegisterEvent"], [
                "model" => $model
            ]);
            $this->trigger("add_register", $event);
            $this->off("add_register");
            $res = [
                "status" => $this->flag,
                "message" => $this->message,
            ];
            echo json_encode($res);
            exit();
        }
    }

    /**
     *  登录
     */
    public function actionLoginapi()
    {
    	//跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        
        $model = new LoginForm();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $sign = MTools::validsign($post);
            if (!$sign) {
                MTools::retjson('0002',Yii::t('app','验签错误'));exit;
            }

            $model->username = HtmlPurifier::process($post["username"]);
            $model->password = HtmlPurifier::process($post["password"]);
            $lang = HtmlPurifier::process(isset($post["lang"])?$post["lang"]:'zh_CN');
            if ($model->login()) {
                $userdata = Yii::$app->user->identity;
                $this->switchLanguage($lang);
                /* ----设置token cache到用户信息-------- */
                $token = md5(time() . 'login' . $model->username);
                Yii::$app->session['token'] = $token;
                // Yii::$app->redis->set('token_'.$userdata->id, $token);
                $userdata->app_token = $token;
                $userdata->save();
                // if($userdata->username == "cdl00001"){
                	
                // 	$res_msg = Yii::t('app', Yii::$app->session['token']);
                // }else{
                	$res_msg = Yii::t('app', "登录成功");
                // }

                $res = [
                    "status" => '0001',
                    "message" => $res_msg,
                    "data" => [
                        "token" => $token,
                        'url' => 'http://lf1.221bk.cn/index.html?token='.$token
                    ]
                ];
                return json_encode($res);
            } else {
                foreach ($model->errors as $errors) {
                    $message = $errors[0];
                    break;
                }
                return json_encode(["status" => '0002', "message" => $message]);
            }
        }
    }

    /**
     * 首页数据(刷新)
     */
    public function actionUsermsg()
    {
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        if (Yii::$app->request->isPost) {
            $req = Yii::$app->request;
            $token = trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
            // $token = $_GET["token"]
            $page = trim(HtmlPurifier::process($req->post('page')));
            if($token == '') {
                MTools::retjson('0002',Yii::t('app','无效参数'));
            }
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
			
            // if($userdata->username == "cdl00001"){
                	
            // 	MTools::retjson('0001',Yii::t('app', json_encode($_GET)));
            // }
            if(!$userdata) {
                MTools::retjson('0003',Yii::t('app', '已登出'));
            }

            //  轮播图
            $banner = $this->banner();
            //中间商品
            $zorelease = WB_Zodiac::zodiaclist($userdata,$page);
            $res_msg = Yii::t('app', "刷新成功");
            $data = [
                "token" => $token,
                "banner" => $banner, // 轮播图
                "list" => $zorelease
            ];
            MTools::retjson('0001',Yii::t('app',$res_msg),$data);
        }
    }

    /**
     *  忘记登录密码
     */
    public function actionForgetpasswordapi()
    {
    	
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $this->layout = FALSE;
        $model = new ForgetpwdForm();//实例化ForgetpwdForm对象
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            //验签判断
            $sign = MTools::validsign($post);
            if (!$sign) {
                MTools::retjson('0002',Yii::t('app','验签错误'));exit;
            }

            $model->username = HtmlPurifier::process(isset($post["username"])?$post['username']:'');
            $model->phone = HtmlPurifier::process(isset($post["phone"])?$post['phone']:'');
            //$model->sms_captcha = HtmlPurifier::process(isset($post["code"])?$post['code']:'');
            $model->sms_captcha = HtmlPurifier::process($post["code"]);
            $model->password = HtmlPurifier::process(isset($post["password"])?$post['password']:'');
            if (!$model->validate()) {
                foreach ($model->errors as $errors) {
                    $message = $errors[0];
                    break;
                }
                  echo json_encode(["status" => '0002', "message" => Yii::t('app', $message)]);
                  exit();
               // MTools::retjson('0002',Yii::t('app',$message));exit;
            }

            $userprofile = \common\models\UserProfile::find()->where("username=:username", [":username" => $model->username])->one();
            if (!$userprofile) {
                MTools::retjson('0002',Yii::t('app','账号不存在'));exit;
            }

            $user = \common\models\User::findOne($userprofile->userid);
            $user->setPassword($model->password);
            if ($user->save()) {
                MTools::retjson('0001',Yii::t('app','重置成功'));exit;
            } else {
                MTools::retjson('0002',Yii::t('app','重置失败'));exit;
            }
        }
    }

    //修改支付密码
    public function actionAlterpaypwd(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req =Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));

        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            $model = new ForgetpwdForm();//实例化ForgetpwdForm对象
            $model->phone = $userdata->userprofile->phone;
            $model->sms_captcha = HtmlPurifier::process($req->post('code'));
            $model->password = HtmlPurifier::process(Yii::$app->request->post('traspass'));

            if (!$model->validate()) {
                foreach ($model->errors as $errors) {
                    $message = $errors[0];
                    break;
                }
                echo json_encode(["status" => '0002', "message" => Yii::t('app', $message)]);
                exit();
            }
            $userdata->setPassword2($model->password);
            if ($userdata->save()) {
                MTools::retjson('0001',Yii::t('app','重置成功'));exit;
            } else {
                MTools::retjson('0002',Yii::t('app','重置失败'));exit;
            }
        }

    }


    /**
     * 版本更新
     */
    public function actionVersionupdate()
    {
        $type = HtmlPurifier::process(Yii::$app->request->post("type"));  //  1：Android，2：IOS

        if ($type == 1) {
            $version = '1.0.2';
            $url = 'http://baidu.com';
            $data = array(
                'status' => '0001',
                'message' => Yii::t('app', '获取成功'),
                'data' => array(
                    'switch' => 1,
                    'version' => $version,
                    'url' => $url,
                    'time' => time(),
                    'type' => $type,
                ),
            );
        } elseif ($type == 2) {
            $version = '1.1.1';
            $url = 'https://baidu.com';
            $data = array(
                'status' => '0001',
                'message' => Yii::t('app', '获取成功'),
                'data' => array(
                    'switch' => 1,
                    'version' => $version,
                    'url' => $url,
                    'time' => time(),
                    'type' => $type,
                ),
            );
        } else {
            $data = array(
                'status' => '0002',
                'message' => '类型错误',
                'data' => ''
            );
        }
        echo json_encode($data);
    }
}
