<?php

namespace common\components;

use yii;
use yii\base\Object;
use yii\web\UploadedFile;
use common\components\MTools;

class Upload extends Object {

    protected $arr_type = ["image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif"]; //上传图片类型
    protected $size = 5242880; //图片上传尺寸设定
    public $oldname = false; //是否使用原文件名称

    /**
     * [UploadPhoto description]
     * @param [type]  $model      [实例化模型]
     * @param [type]  $path       [图片存储路径]
     * @param [type]  $originName [图片源名称]
     * @param boolean $isthumb    [是否要缩略图 或 压缩] 【1 缩略  2压缩
     * @param [int]   $toW        [缩略宽度]
     * @param [int]   $toH        [缩略高度]
     */

    public function UploadPhoto($model, $originName,$user=null, $isthumb = false, $toW = null, $toH = null) {
        //是否多图片上传
        if(strpos($originName, "[]") === FALSE){
            //返回一个实例化对象
            $files = UploadedFile::getInstance($model, $originName);
            // 检查图片类型、文件名、文件内容、文件大小
            if ($files) {
                if(!$this->checkType($files)) {
                    return 'error';
                    exit();
                }
                if(!$this->checkphoto($files)) {
                    return 'error';
                    exit();
                }
                if(!$this->checkSize($files->size)) {
                    return 'oversize';
                    exit();
                }
                $filename = $this->getFilename($files);
            } else {
                return 'error';
            }
            //保存图片
            if ($files->saveAs($filename, true)) {
                if ($isthumb) {
                    //生成缩略图
                    $this->createThumb($filename, $isthumb, $toW, $toH);
                }
            }
            // 将上传成功的图片用户相关信息也写入日志
            $this->logUploadPhotoDone($filename,$user);
            return $filename;
        }else{
            //返回一个实例化对象
            $files = UploadedFile::getInstancesByName($originName);
            $filename_arr = [];
            foreach($files as $file){
                if($file) {
                    if(!$this->checkType($file)) {
                        return 'error';
                    }
                    if(!$this->checkphoto($files)) {
                        return 'error';
                    }
                    if(!$this->checkSize($file->size)) {
                        return 'oversize';
                    }
                    $filename = $this->getFilename($file);
                    //保存图片
                    if ($file->saveAs($filename, true)) {
                        array_push($filename_arr,$filename);
                        if ($isthumb) {
                            //生成缩略图
                            $this->createThumb($filename, $isthumb, $toW, $toH);
                        }
                    }
                } else {
                    return 'error';
                }
            }
            return $filename_arr;
        }
    }

    /*
     * 判断图片上传类型是否正确
     * params $files object
     * return boolean
     */
    protected function checkType($files) {
        return ($files && in_array($files->type, $this->arr_type)) ? true : false;
    }
    
    /*
     * 判断图片上后缀是否有拼接,或者是否为正确的图片
     * params $files object
     * return boolean
     */
    protected function checkphoto($files) {

        //判断是否是图片
        $info=@getimagesize($files->tempName);
        if($info==false){
            return false;
        }

        /*  检测文件名--begin */
        $Parr = $CArr = $Sarr = [];
        $Parr =[",", ":", "@", "$", "#", "%", "^", "&", "*", "+", "?", "/", "~", "<", ">", "=", "!", "`", ";", "|", "'", "\""];
        $Sarr =["php", "css", "js", "html", "text", "script", "zip", "doc", "RAR", "tmp", "exe", "sql", "mysql",
                "mdf", "htm", "php2", "php3", "php4", "php5", "phtml", "pwml", "inc", "asp", "aspx", "ascx", "jsp",
                "cfm", "cfc", "pl", "bat", "py", "pyc", "rb", "vbs", "reg", "cgi", "htaccess", "shtml", "shtm", "phtm",
                "myd", "myi", "frm", "gz", "tgz"];

        $white_postfix = ["png", "jpg", "jpeg", "PNG", "JPG", "JPEG"];
        $filename_text = explode('.', $files->name);
        $postfix = end($filename_text);
        // 图片后缀白名单
        if(!in_array($postfix, $white_postfix)) {
            $this->log_illegal_behavior($files->name);
            return false;
        }

        // 判断文件名是否出现多个.号(由于手机截图的图片文件名会包含多个.号，所以暂不启用)
//        $cnt = substr_count($files->name, '.');
//        if($cnt > 1) {
//            $this->log_illegal_behavior($files->name);
//            return false;
//        }

        // 比对文件名中是否包含$Parr中的特殊字符
        foreach ($Parr as $pke) {
            if(stripos($files->name,$pke) !== false){
                $this->log_illegal_behavior($files->name);
                return false;
            }
        }
        // 比对文件名中是否第一次出现包含$Sarr中的特定后缀名
        foreach ($Sarr as $sptr) {
            if(stripos($files->name,$sptr) !== false){
                $this->log_illegal_behavior($files->name);
                return false;
            }
        }

        $Parr2 = [".", " "];
        // 比对后缀尾部是否出现点号和空格，最后一次出现的位置是否在后缀尾部
        foreach ($Parr2 as $pke) {
            if(substr($files->name, -1) == $pke) {
                $this->log_illegal_behavior($files->name);
                return false;
            }
        }

        // 拆分文件名，如果有多个后缀，则返回false
//        $CArr["0"] = explode(".", $files->name);
//        $CArr["1"] = explode("_", $files->name);
//        $CArr["2"] = explode("-", $files->name);
//        foreach ($CArr as $key=>$value) {
//            $num=count($value);
//            if($key==0 && $num>2){
//                $this->log_illegal_behavior();
//                return false;
//            }elseif($key>0 && $num>3){
//                return false;
//            }
//        }
        /* 检测文件名 -- end */

        //判断图片内容是否含有php标签和函数，还有特殊的GIF89a文件头
        $str = file_get_contents($files->tempName);

        if(stristr($str,'<?php') || stristr($str,'GIF89a')|| stristr($str,'eval') || stristr($str,'assert')){
            $this->log_illegal_behavior($files->name);
            return false;
        }

        // 文件幻数检测
        /*
         * jpg 幻数：FF D8 FF E0 00 10 4A 46 49 46
         * gif 幻数：47 49 46 38 39 61
         * png 幻数：89 50 4E 47
         */
//        if($this->check_magic_number($str, $files->type) == false) {
//            $this->log_illegal_behavior();
//            return false;
//        }

        return true;        
    }

    /*
     *  文件幻数检测代码
     */
//    protected function check_magic_number($str, $file_type) {
//        $magic_number = ['jpg' => ['ff', 'd8', 'ff'],
//                        'gif' => ['47', '49', '46', '38'],
//                        'png' => ['89', '50', '4e', '47']];
//
//        $content = str_split(bin2hex($str), 2);
//        switch ($file_type) {
//            case 'image/jpeg':
//            case 'image/pjpeg':
//                $type = 'jpg';
//                break;
//            case 'image/gif':
//                $type = 'gif';
//                break;
//            case 'image/png':
//            case 'image/x-png':
//                $type = 'png';
//                break;
//            default:
//                // code... other type, log_illegal_behavior() or nothing to do
//                break;
//        }
//
//        for ($i = 0; $i < count($magic_number[$type]); $i++) {
//            if($content[$i] != $magic_number[$type][$i]) {
//                return false;
//            }
//        }
//        return true;
//    }

    /*
     * 将非法操作的用户名、IP及操作时间写入日志
     */
    protected function log_illegal_behavior($filename) {
        $sip=Yii::$app->api->realIp();
        $userid = Yii::$app->user->id;
        $username =Yii::$app->user->identity->username;
        $path = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."frontend".DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."logs".DIRECTORY_SEPARATOR."pic-ip.log";
        $max_size = 100000;   //声明日志的最大尺寸
        if(file_exists($path) && (abs(filesize($path)) > $max_size)){
            unlink($path);
        }
        file_put_contents($path, date('Y-m-d H:i:s')."   ID:".$userid."   用户名:".$username."   ip:".$sip."   filename: ".$filename."\r\n", FILE_APPEND);
    }

    // 将合法上传的图片，用户等信息写入日志文件内
    protected function logUploadPhotoDone($filename,$user) {
        $sip=Yii::$app->api->realIp();
        $userid = $user->id;
        $username = $user->username;
        $path = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."frontend".DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."logs".DIRECTORY_SEPARATOR."upload_done.log";
        $max_size = 100000;   //声明日志的最大尺寸
        if(file_exists($path) && (abs(filesize($path)) > $max_size)){
            unlink($path);
        }
        file_put_contents($path, date('Y-m-d H:i:s')."   ID:".$userid."   用户名:".$username."   ip:".$sip."   filename: ".$filename."\r\n", FILE_APPEND);
    }

    /*
     * 判断图片上传尺寸是否符合要求
     * params $size
     * return boolean
     */
    protected function checkSize($size) {
        return $size > $this->size ? false : true;
    }

    /*
     * 获取文件上传路径
     * params $files object
     * return string
     */
    protected function getFilename($files) {
        return MTools::getfilePath($files->extension, $this->oldname, $files->name);
    }

    /*
     * 生成缩略图
     * @params $isthumb 1缩略 或 2压缩  
     * @params $filename string 上传原图文件名称路径
     * @params $toW    缩略宽度
     * @params $toH    缩略高度
     * return boolean
     */
    protected function createThumb($filename, $isthumb, $toW, $toH) {
        //判断缩略图 压缩
        if ($isthumb == 1) {
            list($ofile, $ext) = explode(".", $filename);
            $toFile = $ofile . '.thumb' . $ext;
        } else {
            $toFile = $filename;
        }
        $data = getimagesize($filename); //返回含有4个单元的数组，0-宽，1-高，2-图像类型，3-宽高的文本描述。 
        if (!$data) {
            return false;
        }
        //将文件载入到资源变量im中
        switch ($data[2]) { //1-GIF，2-JPG，3-PNG
            case 1:
                if (!function_exists("imagecreatefromgif")) {
                    return false;
                }
                $im = imagecreatefromgif($filename);
                break;
            case 2:
                if (!function_exists("imagecreatefromjpeg")) {
                    return false;
                }
                $im = imagecreatefromjpeg($filename);
                break;
            case 3:
                if (!function_exists("imagecreatefrompng")) {
                    return false;
                }
                $im = imagecreatefrompng($filename);
                break;
        }
        //计算缩略图的宽高
        $srcW = imagesx($im);
        $srcH = imagesy($im);
        if ($isthumb == 1) {
            $toWH = $toW / $toH;
            $srcWH = $srcW / $srcH;
            if ($toWH <= $srcWH) {
                $ftoW = $toW;
                $ftoH = (int) ($ftoW * ($srcH / $srcW));
            } else {
                $ftoH = $toH;
                $ftoW = (int) ($ftoH * ($srcW / $srcH));
            }
        } else {
            $ftoW = $toW;
            $ftoH = $toH;
        }

        if (function_exists("imagecreatetruecolor")) {
            $ni = imagecreatetruecolor($ftoW, $ftoH); //新建一个真彩色图像
            if ($ni) {
                //重采样拷贝部分图像并调整大小 可保持较好的清晰度
                imagecopyresampled($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
            } else {
                //拷贝部分图像并调整大小
                $ni = imagecreate($ftoW, $ftoH);
                imagecopyresized($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
            }
        } else {
            $ni = imagecreate($ftoW, $ftoH);
            imagecopyresized($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
        }

        switch ($data[2]) { //1-GIF，2-JPG，3-PNG
            case 1:
                imagegif($ni, $toFile);
                break;
            case 2:
                imagejpeg($ni, $toFile);
                break;
            case 3:
                imagepng($ni, $toFile);
                break;
        }
        ImageDestroy($ni);
        ImageDestroy($im);
        return $toFile;
    }

    /**
     * [UploadPhoto description]
     * @param [type]  $model      [实例化模型]
     * @param [type]  $path       [图片存储路径]
     * @param [type]  $originName [图片源名称]
     * @param boolean $isthumb    [是否要缩略图 或 压缩] 【1 缩略  2压缩
     * @param [int]   $toW        [缩略宽度]
     * @param [int]   $toH        [缩略高度]
     */

    public function UploadPhotoQn($model, $originName, $isthumb = false, $toW = null, $toH = null) {
        //是否多图片上传
        if(strpos($originName, "[]") === FALSE){
            //返回一个实例化对象
            $files = UploadedFile::getInstance($model, $originName);
            // 检查图片类型、文件名、文件内容、文件大小
            if ($files) {
                if(!$this->checkType($files)) {
                    return 'error';
                }
                if(!$this->checkphoto($files)) {
                    return 'error';
                }
                if(!$this->checkSize($files->size)) {
                    return 'oversize';
                }
                $filename = $this->getFilename($files);
            } else {
                return 'error';
            }
            //  获取上传图片后缀
            $filename_text = explode('.', $files->name);
            $postfix = end($filename_text);
            //  生成图片路径
            $new_filename = 'upload/app/'.$this->getFileNameQn().'.'.$postfix;      // 存储于七牛云上的文件名
            //保存图片
            $qn = new YgQiNiu();
            $result = $qn->setQiniuUplaod($files->tempName, $new_filename);
            if ($result['code']) {
                $filename = 'http://'.$result['domain'].'/'.$new_filename;   // 获得七牛云上的图片完整url
            }else{
                return 'error';
            }
            return $filename;
        }else{
            //返回一个实例化对象
            $files = UploadedFile::getInstancesByName($originName);
            $filename_arr = [];
            foreach($files as $file){
                if($file) {
                    if(!$this->checkType($file)) {
                        return 'error';
                    }
                    if(!$this->checkphoto($files)) {
                        return 'error';
                    }
                    if(!$this->checkSize($file->size)) {
                        return 'oversize';
                    }
                    $filename_text = explode('.', $files->name);
                    $postfix = end($filename_text);
                    $new_filename = $this->getFileNameQn().'.'.$postfix;      // 存储于七牛云上的文件名
                    //保存图片
                    $qn = new YgQiNiu();
                    $result = $qn->setQiniuUplaod($files->tempName, $new_filename);
                    if ($result['code']) {
                        $filename_arr = 'http://'.$result['domain'].'/'.$new_filename;   // 获得七牛云上的图片完整url
                    }
                } else {
                    return 'error';
                }
            }
            return $filename_arr;
        }
    }

    // 生成在七牛云存储的新文件名
    protected function getFileNameQn() {
        $new_file_name =  md5(uniqid(mt_rand(), true));

        return $new_file_name;
    }

}