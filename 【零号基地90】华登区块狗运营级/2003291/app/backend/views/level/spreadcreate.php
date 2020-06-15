<?php

use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "number" => [
            "type" => "text",
            "options" => [
                "value" => $model->number
            ]
        ],
        "present_integral" => [
            "type" => "text",
            "options" => [
                "value" => $model->present_integral
            ]
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
