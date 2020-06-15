<?php

namespace frontend\assets;

/**
 * @author  shuang
 * @date    2016-12-8 17:06:05
 * @version V1.0
 * @desc    
 */
use yii\web\AssetBundle;

class LoginAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/amazeui.min.css',
        'css/base.css',
        'css/login.css',
//        'css/passport.css',
//        'css/ua.css',
//        'css/dapp_n.css',
//        'css/layui.css'
    ];
    public $js = [
        "http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js",
        "http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js",
        'js/layer.js',
        'js/app.js',
        'js/login.js',
        'js/particles.min.js',
        'js/canvaswai.js'
    ];

}
