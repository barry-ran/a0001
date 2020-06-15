<?php

/**
 * @author shuang
 * @date 2016-12-14 20:46:08
 */
use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "price" => [
            "type" => "text"
        ],
        "description" => [
            "type" => "textarea",
            "rows" => 2
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */