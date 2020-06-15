<?php

namespace backend\assets;

/**
 * @author  shuang
 * @date    2016-11-28 10:10:28
 * @version V1.0
 * @desc    
 */
use yii\web\AssetBundle;

class HighchartAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        "http://cdn.hcharts.cn/highcharts/highcharts.js",
        "http://cdn.hcharts.cn/highcharts/highcharts-more.js"
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];

}
