<?php

namespace common\widgets;

/**
 * @author  shuang
 * @date    2016-7-8 10:34:08
 * @version V1.0
 * @desc    
 */
use yii\web\AssetBundle;

class DropDownAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/plugins/dropdown/css/dropdown.css',
    ];
    public $js = [
        'js/plugins/dropdown/dropdown.js'
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];

}
