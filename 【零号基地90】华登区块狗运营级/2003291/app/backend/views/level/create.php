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
        "buy_min" => [
            "type" => "text",
            "options" => [
                "value" => $model->buy_min
            ]
        ],
        "increase" => [
            "type" => "text",
            'hints' => '(单位%)',
            "options" => [
                "value" => $model->increase * 100
            ]
        ],
        "profit" => [
            "type" => "text",
            "hints" => "(单位%)",
            "options" => [
                "value" => $model->profit * 100
            ]
        ],
        "round" => [
            "type" => "text",
            "options" => [
                "value" => $model->round
            ]
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
