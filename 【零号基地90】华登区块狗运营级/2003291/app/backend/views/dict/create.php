<?php

/*
 * @Filename     : dictform
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-4-15 19:57:09
 * @Description  : 添加通用信息模板页
 */

use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\widgets\MYActiveForm;

/* --操作提示-start- */
echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --操作提示-end- */

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "icon" => [
            "type" => "file",
            "options" => []
        ],
        "name" => [
            "type" => "text"
        ],
        "description" => [
            "type" => "textarea",
            "options" => ["rows" => 3]
        ],
        "id" => [
            "type" => "hidden",
        ]
    ],
]);
MYActiveForm::end();
/* --表单域-end- */

/* --调用数据列表模板-- */
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("dict/ajaxlist"),
    "labels" => $labels,
    "columns" => ["id", "name", "description", "created_at", "updated_at", "action"]
]);
