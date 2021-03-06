<?php

use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "common_num" => [
            "type" => "text",
            "options" => [
                "value" => $model->common_num
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
