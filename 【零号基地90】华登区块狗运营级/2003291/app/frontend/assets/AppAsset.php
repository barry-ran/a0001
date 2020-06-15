<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/page.css',
        'css/admin.css',
        'css/amazeui.min.css',
        "css/app.css",
        'css/base.css',
        'css/home.css',
        'css/login.css',
        'css/myassets.css',
        'css/swiper-3.3.1.min.css'
        
    ];
    public $js = [
        "js/jquery.min.js",
//        "js/amazeui.min.js",
        "js/swiper-3.3.1.min.js",
        'js/home.js',
        'js/interactive.js',
    ];
    public $depends = [
    ];

}
