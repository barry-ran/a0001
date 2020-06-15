<?php

namespace common\widgets;

/**
 * @author  shuang
 * @date    2016-8-2 11:55:42
 * @version V1.0
 * @desc    
 */
use yii\web\AssetBundle;
 
class UeditorAsset extends AssetBundle
{
    public $js = [
        'ueditor.config.js',
        'ueditor.all.js',
    ];
    public $css = [
    ];
    public function init()
    {
        $this->sourcePath =$_SERVER['DOCUMENT_ROOT'].\Yii::getAlias('@web').'/Ueditor'; //设置资源所处的目录
    }
}

