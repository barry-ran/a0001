<?php

namespace common\components;
// 引入鉴权类
use common\components\qiniu_sdk\src\Qiniu\Auth;
// 引入上传类
use common\components\qiniu_sdk\src\Qiniu\Storage\UploadManager;
/**
 * 功能说明：七牛云存储上传
 */
class YgQiNiu {
    private static $Accesskey = 'cKHS4I-Sn7kZ8oru8O52d8JrnlJyGgUvdbb5deK8';

    private static $Secretkey = '6UjMq90XxkV_V7ARkkMQvsVNNTGx-sVNCJE6oP5x';

    private static $Bucket = 'ctoshop';

    private static $QiniuUrl = 'testshop.tmf520.cn';

    /**
     * 七牛基本设置
     * @return string $qiniu_config
     */
    public function getQiniuConfig(){
        //用于签名的公钥
        $qiniu_config['Accesskey']  = self::$Accesskey;
        //用于签名的私钥
        $qiniu_config['Secretkey']  = self::$Secretkey;
        //存储空间名称
        $qiniu_config['Bucket']     = self::$Bucket;
        //七牛用户自定义访问域名
        $qiniu_config['QiniuUrl']   = self::$QiniuUrl;

        return $qiniu_config;
    }
    /**
     * 设置七牛参数配置
     * @param string $filePath  上传图片路径
     * @param string $key 上传到七牛后保存的文件名
     */
    public function setQiniuUplaod($filePath, $key){
        $config = $this->getQiniuConfig();
        //Access Key 和 Secret Key
        $accessKey = $config["Accesskey"];
        $secretKey = $config["Secretkey"];
        //构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        //要上传的空间
        $bucket = $config["Bucket"];
        $domain = "";
        $token = $auth->uploadToken($bucket);
        // 初始化 UploadManager 对象并进行文件的上传
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            return ["code"=>false,"path"=>"","domain"=>"", "bucket"=>""];
        } else {
            //返回图片的完整URL
            return ["code"=>true,"path"=>self::$QiniuUrl."/". $key,"domain"=>self::$QiniuUrl, "bucket"=>self::$Bucket];
        }
    }
}
