<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\widgets;

use yii\web\AssetBundle;

class DatalistWidgetsAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/plugins/bootstrap-table/bootstrap-table.min.css',
    ];
    public $js = [
        'js/plugins/bootstrap-table/bootstrap-table.min.js',
        'js/plugins/bootstrap-table/bootstrap-table-zh-CN.min.js'
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
