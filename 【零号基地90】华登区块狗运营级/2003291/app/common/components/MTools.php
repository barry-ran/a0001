<?php

/*
 * @Filename     : myTools
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-4-10 17:12:51
 * @Description  : 
 */

namespace common\components;

use common\models\EmailConfig;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\SmsCode;
use common\models\EmailCode;

class MTools {
    /*
     * 权限菜单处理
     * return array
     */

    public static function getAuthMenu() {
        $result = \backend\models\MY_StaticFile::getFileContent(Yii::getAlias('@webroot') . '/chart/statics/menu.php');

        if ($result !== false) {
            $menu = ArrayHelper::toArray(Json::decode($result));
        } else {
            $menu = \backend\models\MY_Mgmt::getMenuData();
        }
//        echo '<pre>';
//        var_dump($menu);exit;
        $auth = self::getAdministratorPrivileges();
//        echo '<pre>';
//        var_dump($menu);exit;
        foreach ($menu as $key => $sonmenu) {
            $f = false;
            foreach (ArrayHelper::getValue($sonmenu, "son") as $k=>$item) {
                if (!$auth || in_array(strtolower($sonmenu["controller"]) . "-" . strtolower($item["url"]), $auth)) {
                    $f = true;
                }else{
                    unset($menu[$key]['son'][$k]);
                }
            }
            if ($f === false) {
                unset($menu[$key]);
            }
        }
//        foreach ($menu as $key => $sonmenu) {
//            foreach (ArrayHelper::getValue($sonmenu, "son") as $item) {
//                $flag = false;
//                if (!$auth || in_array(strtolower($sonmenu["controller"]) . "-" . strtolower($item["url"]), $auth)) {
//                    $flag = true;
//                    break;
//                }
//            }
//            if ($flag === false) {
//                unset($menu[$key]);
//            }
//        }

        return ["menu" => $menu, "auth" => $auth];
    }

    /*
     * 邀请码
     */

    public static function makeOnlyNumber() {
        $order_sn = self::token(6);
        return $order_sn;
    }

    public static function token($length = 32) {
        // Create random token
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        $max = strlen($string) - 1;

        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $token .= $string[mt_rand(0, $max)];
        }

        return $token;
    }

    /*
     * 商品编号
     */

    public static function makeProductNumber() {
        $word = 'D';
        $order_sn = $word . strtoupper(dechex(date('m'))) . date('d') . substr(microtime(), 2, 5) . sprintf('d', rand(0, 99));
        return $order_sn;
    }

    /*
     * 进货编号
     */

    public static function makeReceiptNumber() {
        $word = 'JHD';
        $order_sn = $word . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . sprintf('d', rand(0, 99));
        return $order_sn;
    }

    /**
     * @abstract 创建目录
     * @param <type> $dir 目录名
     * @return bool
     */
    public static function createDir($dir) {
        return is_dir($dir) or ( self::createDir(dirname($dir)) and @ mkdir($dir, 0777, true));
    }

    /*
     * @abstract 创建文件
     * @param <type> $file 文件名
     * @return bool
     */

    public static function createFile($file) {
        self::createDir(dirname($file));
        $handle = @fopen($file, "w"); //创建文件
        @fclose($handle);
        return self::isExist($file);
    }

    /*
     * 判断文件是否存在
     * @params {string} $filepath
     * return boolean
     */

    public static function isExist($filepath) {
        return file_exists($filepath);
    }

    /*
     * 读取文件内容
     */

    public static function getFilecontent($path) {
        if (self::isExist($path)) {
            return file_get_contents($path);
        }
        return false;
    }

    /*
     * 设置文件管理根目录
     * @params $string
     * return string
     */

    public static function setfilepath($string = null) {
        $dir = Yii::getAlias('@webroot/') . self::getYiiParams("fileRootDir");
        if (!is_dir($dir)) {
            self::createDir($dir);
        }
        return $dir . $string;
    }

    /*
     * 生成文件全路径名称
     * @params $extension  扩展名
     * @params $flag default false 是否保持原文件名
     * @params $oldfile 原文件名
     * return string
     */

    public static function getfilePath($extension, $flag = false, $oldfile = null) {
        if ($flag === true) {
            return $oldfile . "." . $extension;
        } else {
            $rand = array("a", "b", "c", "d", "e");
            $string = array_rand($rand, 2);
            $dir = "hash/" . $rand[$string[0]] . $rand[$string[1]];
            self::createDir($dir);
            $file = $dir . "/" . time() . '_' . rand(1, 9999) . '.' . $extension;
            return $file;
        }
    }

    /*
     * 删除网站文件
     * @params $filename array 文件名，包含路径
     * return boolen
     */

    public static function deleteFile($filename = array()) {
        if (empty($filename)) {
            return false;
        }
        foreach ($filename as $v) {
            $filepath = self::setfilepath($v);
            if (file_exists($filepath)) {
                $result = unlink($filepath);
                if ($result == false) {
                    return false;
                }
            }
        }
        return true;
    }

    /*
     * 删除网站文件及文件夹
     * @params $dirName  文件夹名
     * @params $auto  可控制是否使用方法生成完整路径
     * return boolen
     */

    public static function deleteDir($dirName = "", $auto = true) {
        if (!$dirName) {
            return false;
        }
        if ($auto == true) {
            $dirName = self::setfilepath($dirName);
        }
        $handle = opendir($dirName);
        while (($file = readdir($handle)) !== false) {
            if ($file != "." && $file != "..") {
                if (is_dir($dirName . "/" . $file)) {
                    deleteDir($dirName . "/" . $file);
                } else {
                    unlink($dirName . "/" . $file);
                }
            }
        }
        closedir($handle);
        if (!rmdir($dirName)) {
            return false;
        }
        return true;
    }

    /*
     * 字典表结构配置
     */

    public static $dictConfigs = [
        "default" => 0,
        "product_cid" => 1,
        "product_unit" => 6,
        "apptype" => 10,
        "picsize" => 13,
        "flinktype" => 15,
        "tooltype" => 20,
        "product_wikid" => 40,
        "static_http" => 26,
        "static_filetype" => 25,
        "static_dir" => 30,
        "product_standard" => 32
    ];

    /*
     * 列表操作按钮
     * @params $url
     * @params icon
     * @params $tip
     * return string
     */

    public static function getListBtnLink($url, $icon, $tip = "", $options = []) {
        if (!$tip === "") {
            $options["title"] = $tip;
        }
        return Html::a(Html::tag("i", "", ["class" => 'btnicon glyphicon-' . $icon]), $url, $options);
    }

    /*
     * 设置字特殊颜色 0 red 1 green
     * @params $serial
     * @params $string
     */

    public static function setFontColor($serial, $string) {
        if ($serial === null) {
            $serial = 0;
        }
        return '<span class="font-color' . $serial . '">' . $string . '</span>';
    }

    /*
     * 保存数据
     * @params $model
     * return boolean or array
     */

    public static function saveModel($model) {
        if ($model->save()) {
            return true;
        } else {
            return array("errors" => $model->getErrors(), "model" => $model);
        }
    }

    /*
     * 获取选择框常用数据结构  array("value"=>"name");
     * @params $value string
     * @params $name  string
     * return array
     */

    public static function getDropDownListData($data, $default = true, $value = "id", $name = "name", $defaultValue = "请选择") {
        $temp = [];
        if ($default) {
            $temp[] = ["id" => -1, "name" => $defaultValue];
        }
        foreach ($data as $var) {
            if (is_object($var)) {
                $temp[] = ["id" => $var->$value, "name" => $var->$name];
            } else if (is_array($var)) {
                $temp[] = ["id" => $var[$value], "name" => $var[$name]];
            }
        }
        return $temp;
    }

    /*
     * 字典表数据dropdown
     * @params $keyword 关键字键值
     * @params $required default true  
     * return array
     */

    public static function dictDropdown($keyword, $required = false) {
        $resdict = self::Dictdataset();
        if (self::$dictConfigs[$keyword] > 0) {
            $resdict = isset($resdict[self::$dictConfigs[$keyword]]["son"]) ? $resdict[self::$dictConfigs[$keyword]]["son"] : [];
        }
        return self::getDropDownListData($resdict, $required);
    }

    /*
     * 获取字典数据集
     */

    public static function Dictdataset() {
        $result = \backend\models\MY_StaticFile::getFileContent(Yii::getAlias('@backend') . "/web/chart/statics/dictdataset.php");
        if ($result !== false) {
            return Json::decode($result);
        } else {
            return \backend\models\MY_Dictionary::getDictAllInfo();
        }
    }

    /*
     * 获取但个字典数据项
     * @params $id
     * return array
     */

    public static function getDictdata($id) {
        $data = self::Dictdataset();
        foreach ($data as $item) {
            if ((int) $item["id"] === (int) $id) {
                return $item;
            } else {
                foreach ($item["son"] as $son) {
                    if ((int) $son["id"] === (int) $id) {
                        return $son;
                    }
                }
            }
        }
        return false;
    }

    /*
     * 列表页显示图片
     * @params $path
     * @params $width
     * @params $height
     * return string  
     */

    public static function getPreviewImage($path, $width = 80, $height = 60) {
        return Html::img(self::getYiiParams("adminimagepath") . "/" . ($path ? $path : self::getYiiParams("admindefaultImage")), ["width" => $width, "height" => $height]);
    }
    /*
    * 列表页显示图片 图片上传到七牛，所以显示的时候不加域名
    * @params $path
    * @params $width
    * @params $height
    * return string
    */

    public static function getPreviewImage2($path, $width = 80, $height = 60) {
        return Html::img(($path ? $path : self::getYiiParams("admindefaultImage")), ["width" => $width, "height" => $height]);
    }

    /*
     * 前台图片显示路径
     * @parmas $path
     * return string
     */

    public static function getWebPath($path) {
        return self::getYiiParams("webimagepath") . "/" . $path;
        //return self::getYiiParams("website") . "/" . $path;
    }

    /*
     * 系统配置值
     * @params $key
     */

    public static function getYiiParams($attribute) {
        return \yii\helpers\ArrayHelper::getValue(Yii::$app->params, $attribute);
    }

    /*
     * 配置查询的数据列表，管理操作
     * @params type{array} $actions
     * @params $options 其他相关属性
     * return string 
     */

    public static function getStringActions($actions, $options = []) {
        $auth = self::getAdministratorPrivileges();
        if (!empty($actions)) {
            if (is_array($actions)) {
                $string = "";
                foreach ($actions as $function => $item) {
                    if (ArrayHelper::getValue($options, $function . ".show") !== false) {
                        $firstUrl = ArrayHelper::getValue($options, $function . ".url");
                        if ($firstUrl) {
                            $function = $firstUrl;
                        }
                        if ($function === "javascript:;") {
                            $url = $function;
                        } else {
                            if (ArrayHelper::getValue($item, "params")) {
                                array_unshift($item["params"], $function);
                            } else {
                                $item["params"] = [];
                                array_unshift($item["params"], $function);
                            }
                            $url = Url::toRoute($item["params"]);
                        }
                        //判断是否有权限
                        if (!$auth || in_array(strtolower(str_replace("/", "-", substr($url, 1, strpos($url, ".") - 1))), $auth)) {
                            if (ArrayHelper::getValue($item, "options")) {
                                $itemoptions = ArrayHelper::merge($item["options"], ["title" => ArrayHelper::getValue($item, "title")]);
                            } else {
                                $itemoptions = ["title" => ArrayHelper::getValue($item, "title")];
                            }
                            if (ArrayHelper::getValue($item, "icon")) {
                                $string .= Html::a(Html::tag("i", "", ["class" => 'btnicon glyphicon-' . $item["icon"]]), $url, $itemoptions);
                            } else {
                                $string .= Html::a(ArrayHelper::getValue($item, "title"), $url, $itemoptions);
                            }
                        }
                    }
                }
                return $string;
            }
        }
        return $actions;
    }

    /*
     * 获取会员权限
     */

    public static function getAdministratorPrivileges() {
        if (self::getYiiParams("auth") === true) {
            return \backend\models\MY_Permission::getAdministratorPrivileges(Yii::$app->user->id);
        }
        return false;
    }

    /*
     * 配置头部菜单 
     * return array
     */

    public static $setHeaderMenu = [
        ["title" => "常用工具", "url" => "mgmt/commonlist", "shorttype" => 1, "icon" => "/images/icon04.png"],
        ["title" => "系统设置", "url" => "mgmt/systemlist", "shorttype" => 2, "icon" => "/images/icon06.png"],
    ];
    public static $langConfig = [
        "en_US" => "English",
        "zh_CN" => "Chinese",
        "ja_JP" => "Japanese"
    ];
    public static $aPos = array();

    public static function getPos($str, $sonStr, $iIndex = 0) {
        $ipos = strpos($str, $sonStr, $iIndex);
        if ($ipos !== false) {
            self::$aPos[count(self::$aPos)] = $ipos;
            self::getPos($str, $sonStr, $ipos + 1);
        }
        return self::$aPos;
    }

    public static function getPos2($str, $sonStr, $iIndex = 0) {
        $shu = count(explode($sonStr, $str));
        for ($i = 0; $i < $shu; $i++) {
            if ($i == 0) {
                $iIndex = 0;
            } else {
                $iIndex = $ipos + 1;
            }
            $ipos = strpos($str, $sonStr, $iIndex);
            if ($ipos !== false) {
                self::$aPos[$i] = $ipos;
            }
        }
        return self::$aPos;
    }

    public static function YPsendMsg($phone) {
        $code = mt_rand(100000, 999999);
        \Yii::$app->session->set("sendcode", $code);
        header("Content-Type:text/html;charset=utf-8");
        $apikey = "010fc7ec271c05260be72b57c54d852a";
        $mobile = $phone;
        $text = "【VMP国际】尊敬的用户，你的验证码是" . $code . "，请在2分钟内输入，为了您的账号安全，请不要告诉别人！";
        $ch = curl_init();

        /* 设置验证方式 */

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8', 'Content-Type:application/x-www-form-urlencoded', 'charset=utf-8'));

        /* 设置返回结果为流 */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* 设置超时时间 */
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        /* 设置通信方式 */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 发送短信
        $data = array('text' => $text, 'apikey' => $apikey, 'mobile' => $mobile);
        curl_setopt($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $json_data = curl_exec($ch);
        $array = json_decode($json_data, true);
        if ($array['code'] == 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function encodeHexStr($dataCoding, $realStr) {
        if ($dataCoding == 15) {
            return strtoupper(bin2hex(iconv('UTF-8', 'GBK', $realStr)));
        } else if ($dataCoding == 3) {
            return strtoupper(bin2hex(iconv('UTF-8', 'ISO-8859-1', $realStr)));
        } else if ($dataCoding == 8) {
            return strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $realStr)));
        } else {
            return strtoupper(bin2hex(iconv('UTF-8', 'ASCII', $realStr)));
        }
    }
    public static function SendMsg($quhao,$strphone){

        if($quhao == "86"){
            $text = "【宠物】尊敬的用户，你的验证码是" . $code . "，请在10分钟内输入，为了您的账号安全，请不要告诉别人！";
        } else {
            $text = "【宠物】Dear user,your verification code is ".$code;
        }

        // 参数数组
        //String fmt = "src={0}&pwd={1}&ServiceID=SEND&dest={2}&sender={3}&msg={4}&codec=8";
        $data = array (
            'src' => 'cto17503215653', // 你的用户名, 必须有值
            'pwd' => 'cto987654321', // 你的密码, 必须有值
            'ServiceID' => 'SEND', //固定，不需要改变
            'dest' => $strphone, // 你的目的号码【收短信的电话号码】, 必须有值
            'sender' => '', // 你的原号码,可空【大部分国家原号码带不过去，只有少数国家支持透传，所有一般为空】
            'codec' => '8', // 编码方式， 与msg中encodeHexStr 对应// codec=8 Unicode 编码,  3 ISO-8859-1, 0 ASCII
            'msg' => self::encodeHexStr(8, $text) // 编码短信内容
        );

        $uri = "http://210.51.190.233:8085/mt/mt3.ashx"; // 接口地址

        $ch = curl_init();
//        print_r($ch);
        curl_setopt ( $ch, CURLOPT_URL, $uri );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        $return = curl_exec ( $ch ); //$return  返回结果，如果是以 “-” 开头的为发送失败，请查看错误代码，否则为MSGID
        curl_close ( $ch );

        $return = json_decode(json_encode($return), true);

        if($return > 0){
            $sms = new SmsCode();
            $sms->phone = $strphone;
            $sms->code = $code;
            $sms->create_at = time();
            $sms->ip = Yii::$app->getRequest()->getUserIP();
            $sms->save(false);
        }
        return $return;
    }

  public static function smsg($phone,$type)
  {
    $code = mt_rand(100000, 999999);
    $account = '1075';
    $key = md5('33q3iX34HQ1800EXi4dXi01I3eDI331U');
    if($type=='1'){
      $mid = '62463';
      $url = "https://ux.hk.cn/user/SsgApi.php?act=msgsend&account=$account&key=$key&m_id=$mid&mobile=$phone&code=$code";
    }
    if($type=='2'){
      $mid = '62464';//被抢购
      $url = "https://ux.hk.cn/user/SsgApi.php?act=msgsend&account=$account&key=$key&m_id=$mid&mobile=$phone&code=";
    }
    if($type=='3'){
      $mid = '62465';//完成抢购
      $url = "https://ux.hk.cn/user/SsgApi.php?act=msgsend&account=$account&key=$key&m_id=$mid&mobile=$phone&code=";
    }
    $res = file_get_contents($url);
    $ret = json_decode($res, 1);
    if ($ret['code'] == '66') {
      $sms = new SmsCode();
      $sms->phone = $phone;
      $sms->code = $code;
      $sms->create_at = time();
      $sms->ip = Yii::$app->getRequest()->getUserIP();
      $sms->save(false);
      return true;
    } else {
      return $ret['msg'];
    }
  }

    public static function getCode(){
        $code = mt_rand(100000, 999999);
        Yii::$app->session->set("emailCode", $code);
        return $code;
    }
    public static function saveMailCode($email,$code){
        $sms = new EmailCode();
        $sms->email = $email;
        $sms->code = $code;
        $sms->create_at = time();
        $sms->ip = Yii::$app->getRequest()->getUserIP();
        $res = $sms->save(false);
        return $res;
    }
    public static function SendTradeMsg($strphone, $text){
//        $code = mt_rand(100000, 999999);
//        Yii::$app->session->set("sendcode", $code);
        header("Content-Type:text/html;charset=utf-8");
//        if($quhao == "86"){
//            $text = "【LKC】尊敬的用户，你的验证码是" . $code . "，请在10分钟内输入，为了您的账号安全，请不要告诉别人！";
//        } else {
//            $text = "【LKC】Dear user,your verification code is ".$code;
//        }

        // 参数数组
        //String fmt = "src={0}&pwd={1}&ServiceID=SEND&dest={2}&sender={3}&msg={4}&codec=8";
        $data = array (
            'src' => 'zsms13015917801', // 你的用户名, 必须有值
            'pwd' => 'zsms7801', // 你的密码, 必须有值
            'ServiceID' => 'SEND', //固定，不需要改变
            'dest' => $strphone, // 你的目的号码【收短信的电话号码】, 必须有值
            'sender' => '', // 你的原号码,可空【大部分国家原号码带不过去，只有少数国家支持透传，所有一般为空】
            'codec' => '8', // 编码方式， 与msg中encodeHexStr 对应// codec=8 Unicode 编码,  3 ISO-8859-1, 0 ASCII
            'msg' => self::encodeHexStr(8, $text) // 编码短信内容
        );

        $uri = "http://210.51.190.233:8085/mt/mt3.ashx"; // 接口地址
        $ch = curl_init();
//        print_r($ch);
        curl_setopt ( $ch, CURLOPT_URL, $uri );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        $return = curl_exec ( $ch ); //$return  返回结果，如果是以 “-” 开头的为发送失败，请查看错误代码，否则为MSGID
        curl_close ( $ch );

        $return = json_decode(json_encode($return), true);

        if($return > 0){
            $sms = new SmsCode();
            $sms->phone = $strphone;
            $sms->code = 0;
            $sms->create_at = time();
            $sms->ip = Yii::$app->getRequest()->getUserIP();
            $sms->save(false);
        }
        return $return;
    }

    /**
     * 二维数组根据字段进行排序
     * @params array $array 需要排序的数组
     * @params string $field 排序的字段
     * @params string $sort 排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
     */
    public static function arraySequence($array, $field, $sort = 'SORT_DESC')
    {
        $arrSort = array();
        foreach ($array as $uniqid => $row) {
            foreach ($row as $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }
        array_multisort($arrSort[$field], constant($sort), $array);
        return $array;
    }

    /**
     * token获取用户id
     * @params string $token 获取当前用户的token值
     * @return string
     */
    public static function tokenToId($token){
        if($token){
            $usermsg = Yii::$app->cache->get($token);
            $login_data = explode('|', $usermsg);

            if (count($login_data) < 2) {
                self::appLoginOut();
            }
            $s_user_id = $login_data[1];
            //  获取当前用户ID 以及 用户信息
            $userid = str_replace('u', '', $s_user_id);
            return $userid;
        }else{
            return null;
        }
    }

    /**
     * APP退出登录跳转到登录界面
     */
    public static function appLoginOut(){
        echo '<body onload="logout()">';
        echo '<a id="test" href="VM://logout"> </a>';
        echo "<script> function logout(){document.getElementById('test').click()}</script>";
        die();
    }

    /**
     * 验签
     */
    public static function validsign($post){
        return true;
        $str = '';
        ksort($post);
        foreach($post as $k=>$val){
            if(is_array($val)){
                $val = json_encode($val);
            }
            if($val != '' && $k != 'sign'){
                if($str == ''){
                    $str = $str.$k.'='.$val;
                }else{
                    $str = $str.'&'.$k.'='.$val;
                }
            }
        }
        $key = 'jdkj963214785';
        $str = $str.$key;
        $sign = strtoupper(md5($str));
//        var_dump($sign);die();

        if($sign != $post['sign']){
            return false;
        }
        return true;
    }

    /**
     * 检验token
     * @param $post
     */
    public static function validtoken($post){
        if(empty($post['token'])){
            return false;
        }else{
            $userdata = Yii::$app->user->identity;
            if($userdata->app_token == $post['token']){
                return true;
            }else{
                return false;
            }
        }
    }

    //  判断收支是否平衡
    public static function walletrecoretrue($userid){return true;
        if(!$userid || $userid <= 0){
            return false;
        }
        //白名单，不用校验直接通过
        $white_id_arr = [3244,6051];
        if(in_array($userid, $white_id_arr)){
            return true;
        }
        $user_wallet = \frontend\models\WB_UserWallet::find()->where("userid=:userid",[":userid"=>$userid])->one();
        if(!$user_wallet){
            return false;
        }
        //卢宝
        $earn_cash1 = \frontend\models\WB_UserWalletRecord::find()->where("`event_type`not in (11,19,20) && `wallet_type`=2 && `pay_type`=1 && userid=:userid",[":userid"=>$userid])->sum('amount');
        $earn_cash = $earn_cash1?$earn_cash1:0;
        $pay_cash1 = \frontend\models\WB_UserWalletRecord::find()->where("`event_type`not in (11,19,20) && `wallet_type`=2 && `pay_type`=2 && userid=:userid",[":userid"=>$userid])->sum('amount');
        $pay_cash = $pay_cash1?$pay_cash1:0;
        //获取所有未成功的卖出余额订单
        $un_succ_cash1 = \frontend\models\WB_UserAmountTrade::find()->where("order_type=1 && status in (0,1,2,4,5,6,7,8,9,10) && out_userid=:out_userid",[":out_userid"=>$userid])->sum('number');
        $un_succ_cash = $un_succ_cash1?$un_succ_cash1:0;
        $cash_amount_res2 = $earn_cash - $pay_cash - $un_succ_cash;
        //lkc
        $earn_lkc1 = \frontend\models\WB_UserWalletRecord::find()->where("`wallet_type`=3 && `pay_type`=1 && userid=:userid",[":userid"=>$userid])->sum('amount');
        $earn_lkc = $earn_lkc1?$earn_lkc1:0;
        $pay_lkc1 = \frontend\models\WB_UserWalletRecord::find()->where("`wallet_type`=3 && `pay_type`=2 && userid=:userid",[":userid"=>$userid])->sum('amount');
        $pay_lkc = $pay_lkc1?$pay_lkc1:0;
        //获取所有未成功的卖出lkc订单
//        $un_succ_lkc1 = \frontend\models\WB_UserAmountTrade::find()->where("order_type=2 && status in (0,1,2,4,5,6,7,8,9,10) && out_userid=:out_userid",[":out_userid"=>$userid])->sum('number');
//        $un_succ_lkc = $un_succ_lkc1?$un_succ_lkc1:0;
        $lkc_amount_res2 = $earn_lkc - $pay_lkc;// - $un_succ_lkc

        $cash_amount_res = (string)$cash_amount_res2;
        $lkc_amount_res = (string)$lkc_amount_res2;

        if($cash_amount_res-$user_wallet->cash_wa<101 && $cash_amount_res-$user_wallet->cash_wa>-101 && $lkc_amount_res-$user_wallet->care_wa<10 && $lkc_amount_res-$user_wallet->care_wa>-10){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 发送邮件
     * @param $mailto   邮箱地址
     * @param $subject  主题
     * @param $msgtype  消息类型,1:存文本内容,2:带html标签内容
     * @param $text     消息内容
     * @return string   'success':发送成,'failed':发送失败,'未配置邮箱设置','default':位置错误
     */
    public static function sendmail($mailto, $subject, $msgtype, $text) {
        EmailConfig::setConfig();
        $mail= Yii::$app->mailer->compose();
        $isset_mail_config = $mail->mailer->useFileTransport;
        if($isset_mail_config) {
            return 'unconfig';
        } else {
            $mail->setTo($mailto);                          // 收件人邮箱
            $mail->setSubject($subject);                    // 主题
            if($msgtype == 1) {
                $mail->setTextBody($text);                  // 发布纯文字文本
            } else {
                $mail->setHtmlBody($text);                  // 发布可以带html标签的文本
            }
            if($mail->send()) {
                return 'success';
            } else {
                return 'failed';
            }
        }
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

    //插入 reids 数量
    public static function AddRedis($num,$zodiac_id){
        //开启redis
//        $redis = new \common\redisphp\lib\redisphp();
//        $redis=$redis->new_redis();
        //添加相对应数量
        for($i=0;$i<$num;$i++){
//        往zodiac_issue列表中,未抢购之前这里应该是默认滴push10个库存数了
            Yii::$app->redis->lpush('zodiac_issue:'.$zodiac_id,'1');
        }
//        $redis->delete($redis->keys('zodiac_issue:'.$zodiac_id)); //清除redis
//        //查看数量
//        $len=$redis->llen('zodiac_issue:'.$zodiac_id);
//        return $len;
    }

}
