<?php

namespace common\widgets;

use yii\web\AssetBundle;

class FileInputAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/plugins/fileinput/css/fileinput.css',
    ];
    public $js = [
        'js/plugins/fileinput/fileinput.js',
        'js/plugins/fileinput/fileinput_locale_zh.js'
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];

}
