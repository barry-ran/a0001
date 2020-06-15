<?php

/**
 * @author shuang
 * @date 2016-8-2 11:07:51
 */
use common\widgets\MYActiveForm;
use yii\helpers\Url;
use common\components\MTools;

/* --操作提示-start- */
echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --操作提示-end- */

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "name" => [
            "type" => "text",
        ],
        "en_name" => [
            "type" => "text",
        ],
        "price" => [
            "type" => "text"
        ],
        "us_price" => [
            "type" => "text"
        ],
        "baseVolume" => [
            "type" => "text"
        ],
        "percentChange" => [
            "type" => "text"
        ],
        "img" => [
            "type" => "file",
            "options" => [
                "value" => $model->img
            ]

        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
