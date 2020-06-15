<?php

/**
 * @author shuang
 * @date 2016-8-2 11:07:56
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\components\MTools;

$labels = \yii\helpers\ArrayHelper::merge($labels, [
            "id" => "ID",
            "content" => "标题",
            "img" => "图片",
            "created_at" => "创建时间",
        ]);

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));

//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("system/ajaxcoins"),
    "labels" => $labels,
    "columns" => ["id", "name", "en_name","img", "price","us_price","baseVolume","percentChange","updated_at", "action"],
    "toolbar" => "#toolbar",
    "tableOtherAttributes" => ["data-click-to-select" => "true"],
    "fieldAttributes" => [
        "mid" => [
            "data-checkbox" => "true"
        ],      
    ]
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "addcoin" => [
            "title" => "添加",
            "icon" => "create"
        ]
    ]
]);