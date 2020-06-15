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
//        "icon" => [
//            "type" => "file"
//        ],
//        "condition_sales" => [
//            "type" => "text",
//            "hints" => "(单位TH)"
//        ],
        "reg_score_min" => [
            "type" => "text",
            "options" => [
                "value" => $model->reg_score_min
            ]
        ],
        "reg_score_max" => [
            "type" => "text",
            "options" => [
                "value" => $model->reg_score_max
            ]
        ],
        "peop_per" => [
            "type" => "text",
            "hints" => "(单位%)",
            "options" => [
                "value" => $model->peop_per * 100
            ]
        ],
        "team_per" => [
            "type" => "text",
            "hints" => "(单位%)",
            "options" => [
                "value" => $model->team_per * 100
            ]
        ],
        
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
