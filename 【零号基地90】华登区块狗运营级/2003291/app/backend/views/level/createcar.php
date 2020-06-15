<?php

use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "name" => [
            "type" => "text",
            "options" => [
                "value" => $model->name
            ]
        ],
        "en_name" => [
            "type" => "text",
            "options" => [
                "value" => $model->en_name
            ]
        ],
        "level" => [
            "type" => "text",
            "options" => [
                "value" => $model->level
            ]
        ],
        "img" => [
            "type" => "file"
        ],
        "price" => [
            "type" => "text",
            "options" => [
                "value" => $model->price
            ]
        ],
        "out_times" => [
            "type" => "text",
            "options" => [
                "value" => $model->out_times
            ]
        ],
        "award_per" => [
            "type" => "text",
            "hints" => "(单位%)",
            "options" => [
                "value" => $model->award_per * 100
            ]
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
