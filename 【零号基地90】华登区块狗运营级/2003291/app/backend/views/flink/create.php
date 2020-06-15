<?php

use yii\helpers\Url;
use common\components\MTools;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "typeid" => [
            "type" => "select",
            "dropdata" => MTools::dictDropdown("flinktype")
        ],
        "webname" => [
            "type" => "text"
        ],
        "url" => [
            "type" => "text"
        ],
        "introduce" => [
            "type" => "textarea",
            "options" => [
                "rows" => 3
            ]
        ],
        "logo" => [
            "type" => "file"
        ],
        "email" => [
            "type" => "text"
        ],
        "sortid" => [
            "type" => "text"
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
