<?php

use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "areaname" => [
            "type" => "text",
            "options" => [
                "value" => $model->areaname
            ]
        ],
        "min" => [
            "type" => "text",
            "options" => [
                "value" => $model->min
            ]
        ],
        "max" => [
            "type" => "text",
            "options" => [
                "value" => $model->max
            ]
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
