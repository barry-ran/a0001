<?php

use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "img" => [
            "type" => "file"
        ],
        "content" => [
            "type" => "text"
        ],
        "url" => [
            "type" => "text"
        ],
        "id" => [
            "type" => "hidden"
        ]
    ],

]);
MYActiveForm::end();
/* --表单域-end- */
