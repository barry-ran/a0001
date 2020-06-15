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
            "type" => "text"
        ],
        "oper_at" => [
            "type" => "text"
        ],
        "value" => [
            "type" => "text",
            "hints" => "(GH/s)",
        ],
        "hourly_output" => [
            "type" => "text",
            "hints" => "(GFC/h)",
        ],
        "twelve_output" => [
            "type" => "text"
        ],
        "seventytwo_output" => [
            "type" => "text"
        ],
        "sevenhundred_output" => [
            "type" => "text"
        ],
        "score" => [
            "type" => "text"
        ],
        "id" => [
            "type" => "hidden"
        ]
//        "is_inside" => [
//            "type" => "radiolist",
//            "options" => [
//                "data" => ['1' => '是', '0' => '否'],
//                "otheroption" => [
//                    " value" => 0
//                ],
//                "inline" => true
//            ]
//        ],
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
