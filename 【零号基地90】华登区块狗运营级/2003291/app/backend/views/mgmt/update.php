<?php

/**
 * @author shuang
 * @date 2016-7-1 13:35:22
 */
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute("update"),
    "model" => $model,
    "fields" => [
        "name" => [
            "type" => "text",
            "options" => [
                "disabled" => $model->name ? true : false
            ]
        ],
        "ismenu" => [
            "type" => "radiolist",
            "options" => [
                "data" => ['1' => '是', '0' => '否'],
                "otheroption" => [
                    " value" => 1
                ],
                "inline" => true
            ]
        ],
        "menuname" => [
            "type" => "text"
        ],
        "description" => [
            "type" => "textarea",
            "options" => [
                "rows" => 3
            ]
        ],
        "module" => [
            "type" => "text"
        ],
        "sortid" => [
            "type" => "text"
        ],
        "icon"=>[
            "type"=>"file"
        ]
    ]
]);
echo Html::hiddenInput("name",$model->name);
MYActiveForm::end();
/* --表单域-end- */
