<?php
/**
 * Created by JetBrains PhpStorm.
 * User: taoqili
 * Date: 12-7-18
 * Time: 上午11: 32
 * UEditor编辑器通用上传类
 */
$dr = str_replace("backend/web", "", $_SERVER['DOCUMENT_ROOT']);
require_once ($dr."common/components/YgQiNiu.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/Auth.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/functions.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/Storage/UploadManager.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/Config.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/Storage/FormUploader.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/Zone.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/Http/Client.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/Http/Request.php");
require_once ($dr."common/components/qiniu_sdk/src/Qiniu/Http/Response.php");

use common\components\YgQiNiu;

class Uploader
{
    private $fileField; //文件域名
    private $file; //文件上传对象
    private $base64; //文件上传对象
    private $config; //配置信息
    private $oriName; //原始文件名
    private $fileName; //新文件名
    private $fullName; //完整文件名,即从当前配置目录开始的URL
    private $filePath; //完整文件名,即从当前配置目录开始的URL
    private $fileSize; //文件大小
    private $fileType; //文件类型
    private $stateInfo; //上传状态信息,
    private $stateMap = array( //上传状态映射表，国际化用户需考虑此处数据的国际化
        "SUCCESS", //上传成功标记，在UEditor中内不可改变，否则flash判断会出错
        "文件大小超出 upload_max_filesize 限制",
        "文件大小超出 MAX_FILE_SIZE 限制",
        "文件未被完整上传",
        "没有文件被上传",
        "上传文件为空",
        "ERROR_TMP_FILE" => "临时文件错误",
        "ERROR_TMP_FILE_NOT_FOUND" => "找不到临时文件",
        "ERROR_SIZE_EXCEED" => "文件大小超出网站限制",
        "ERROR_TYPE_NOT_ALLOWED" => "文件类型不允许",
        "ERROR_CREATE_DIR" => "目录创建失败",
        "ERROR_DIR_NOT_WRITEABLE" => "目录没有写权限",
        "ERROR_FILE_MOVE" => "文件保存时出错",
        "ERROR_FILE_NOT_FOUND" => "找不到上传文件",
        "ERROR_WRITE_CONTENT" => "写入文件内容错误",
        "ERROR_UNKNOWN" => "未知错误",
        "ERROR_DEAD_LINK" => "链接不可用",
        "ERROR_HTTP_LINK" => "链接不是http链接",
        "ERROR_HTTP_CONTENTTYPE" => "链接contentType不正确",
        "INVALID_URL" => "非法 URL",
        "INVALID_IP" => "非法 IP"
    );

    /**
     * 构造函数
     * @param string $fileField 表单名称
     * @param array $config 配置项
     * @param bool $base64 是否解析base64编码，可省略。若开启，则$fileField代表的是base64编码的字符串表单名
     */
    public function __construct($fileField, $config, $type = "upload")
    {
        $this->fileField = $fileField;
        $this->config = $config;
        $this->type = $type;
        if ($type == "remote") {
            exit;
//            $this->saveRemote();
        } else if($type == "base64") {
            exit;
//            $this->upBase64();
        } else {
            $this->upFile();
        }

        $this->stateMap['ERROR_TYPE_NOT_ALLOWED'] = iconv('unicode', 'utf-8', $this->stateMap['ERROR_TYPE_NOT_ALLOWED']);
    }

    /**
     * 上传文件的主处理方法
     * @return mixed
     */
    private function upFile()
    {
        $file = $this->file = $_FILES[$this->fileField];
        if (!$file) {
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_NOT_FOUND");
            return;
        }
        if ($this->file['error']) {
            $this->stateInfo = $this->getStateInfo($file['error']);
            return;
        } else if (!file_exists($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMP_FILE_NOT_FOUND");
            return;
        } else if (!is_uploaded_file($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMPFILE");
            return;
        }

        $this->oriName = $file['name'];
        $this->fileSize = $file['size'];
        $this->fileType = $this->getFileExt();
//        $this->fullName = $this->getFullName();
//        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
//        $dirname = dirname($this->filePath);

        $Parr =[",", ":", "@", "$", "#", "%", "^", "&", "*", "+", "?", "/", "~", "<", ">", "=", "!", "`", ";", "|", "'", "\""];
        // 比对文件名中是否包含$Parr中的特殊字符
        foreach ($Parr as $pke) {
            if(stripos($this->oriName,$pke) !== false){
                $this->log_illegal_behavior($this->oriName);
                $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
                return;
            }
        }

        $Parr2 = [".", " "];
        // 比对后缀尾部是否出现点号和空格，最后一次出现的位置是否在后缀尾部
        foreach ($Parr2 as $pke) {
            if(substr($this->oriName, -1) == $pke) {
                $this->log_illegal_behavior($this->oriName);
                $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
                return;
            }
        }

        $Sarr =["php", "css", "js", "html", "text", "script", "zip", "doc", "RAR", "tmp", "exe", "sql", "mysql",
            "mdf", "htm", "php2", "php3", "php4", "php5", "phtml", "pwml", "inc", "asp", "aspx", "ascx", "jsp",
            "cfm", "cfc", "pl", "bat", "py", "rb", "vbs", "reg", "cgi", "htaccess", "shtml", "shtm", "phtm",
            "myd", "myi", "frm", "gz", "tgz"];

        $white_postfix = ["png", "jpg","gif", "jpeg", "PNG", "JPG","GIF", "JPEG"];
        $filename_text = explode('.', $this->oriName);
        $postfix = end($filename_text);
        // 图片后缀白名单
        if(!in_array($postfix, $white_postfix)) {
            $this->log_illegal_behavior($this->oriName);
            return false;
        }

        // 比对文件名中是否第一次出现包含$Sarr中的特定后缀名
        foreach ($Sarr as $sptr) {
            if(stripos($this->oriName,$sptr) !== false){
                $this->log_illegal_behavior($this->oriName);
                $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
                return;
            }
        }

        // 判断文件名是否出现多个.号
        $cnt = substr_count($this->oriName, '.');
        if($cnt > 1) {
            $this->log_illegal_behavior($this->oriName);
            $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return;
        }
        $img = file_get_contents($file['tmp_name']);
        if(stristr($img,'<?php') || stristr($img,'GIF89a')|| stristr($img,'eval') || stristr($img,'assert')){
            $this->log_illegal_behavior($this->oriName);
            $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return;
        }

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //检查是否不允许的文件格式
        if (!$this->checkType()) {
            $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return;
        }

        // 上传到七牛
        switch ($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $ext = 'jpg';
                break;
            case 'image/png':
                $ext = 'png';
                break;
            default:
                $ext = 'jpg';
                break;
        }


        $new_filename = 'upload/app/'.$this->getFilename().'.'.$ext;

        //保存图片
        $qn = new YgQiNiu();
        $result = $qn->setQiniuUplaod($file['tmp_name'], $new_filename);
        if ($result['code']) {
            $filename = 'http://'.$result['domain'].'/'.$new_filename;   // 获得七牛云上的图片完整url
            $this->fullName = $filename;
            $this->stateInfo = $this->stateMap[0];
            // 将上传成功的图片用户相关信息也写入日志
            $this->logUploadPhotoDone($filename);
        }else{
            $this->stateInfo = $this->getStateInfo("ERROR_UNKNOWN");
        }
//        return $filename;

        //创建目录失败
//        if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
//            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
//            return;
//        } else if (!is_writeable($dirname)) {
//            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
//            return;
//        }

        //移动文件
//        if (!(move_uploaded_file($file["tmp_name"], $this->filePath) && file_exists($this->filePath))) { //移动失败
//            $this->stateInfo = $this->getStateInfo("ERROR_FILE_MOVE");
//        } else { //移动成功
//            $this->stateInfo = $this->stateMap[0];
//        }
    }

    // 获取新文件名
    private function getFilename() {
        $new_file_name =  md5(uniqid(mt_rand(), true));

        return $new_file_name;
    }

    /*
     * 将非法操作的用户名、IP及操作时间写入日志
     */
    protected function log_illegal_behavior($filename) {
        $sip = $_SERVER['REMOTE_ADDR'];
        $username = '';
        $dr = str_replace("backend/web", "", $_SERVER['DOCUMENT_ROOT']);
        $path = $dr.DIRECTORY_SEPARATOR."frontend".DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."logs".DIRECTORY_SEPARATOR."pic-ip.log";
        $max_size = 100000;   //声明日志的最大尺寸
        if(file_exists($path) && (abs(filesize($path)) > $max_size)){
            unlink($path);
        }
        file_put_contents($path, date('Y-m-d H:i:s')."   "."用户:".$username."  ip:".$sip."   filename: ".$filename."\r\n", FILE_APPEND);
    }

    // 将合法上传的图片，用户等信息写入日志文件内
    protected function logUploadPhotoDone($filename) {
        $sip = $_SERVER['REMOTE_ADDR'];
        $userid = '';
        $username = '';
        $dr = str_replace("backend/web", "", $_SERVER['DOCUMENT_ROOT']);
        $path = $dr.DIRECTORY_SEPARATOR."frontend".DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."logs".DIRECTORY_SEPARATOR."upload_done.log";
        $max_size = 100000;   //声明日志的最大尺寸
        if(file_exists($path) && (abs(filesize($path)) > $max_size)){
            unlink($path);
        }
        file_put_contents($path, date('Y-m-d H:i:s')."   ID:".$userid."   用户名:".$username."   ip:".$sip."   filename: ".$filename."\r\n", FILE_APPEND);
    }

    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    private function getStateInfo($errCode)
    {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }

    /**
     * 获取文件扩展名
     * @return string
     */
    private function getFileExt()
    {
        return strtolower(strrchr($this->oriName, '.'));
    }

    /**
     * 文件类型检测
     * @return bool
     */
    private function checkType()
    {
        return in_array($this->getFileExt(), $this->config["allowFiles"]);
    }

    /**
     * 文件大小检测
     * @return bool
     */
    private function  checkSize()
    {
        return $this->fileSize <= ($this->config["maxSize"]);
    }

    /**
     * 获取当前上传成功文件的各项信息
     * @return array
     */
    public function getFileInfo()
    {
        return array(
            "state" => $this->stateInfo,
            "url" => $this->fullName,
            "title" => $this->fileName,
            "original" => $this->oriName,
            "type" => $this->fileType,
            "size" => $this->fileSize
        );
    }

}