<?php

/**
 * @author shuang
 * @date 2016-12-15 18:45:16
 */
use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
//        "problem" => [
//            "type" => "text",
//            "options" => [
//                "disabled" => "disabled"
//            ]
//        ],
        "content" => [
            "type" => "textarea",
            "options" => [
                "disabled" => "disabled",
                "rows" => 3
            ]
        ],
        "replay" => [
            "type" => "textarea",
            "options" => [
                "rows" => 3
            ]
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
