<?php

/**
 * @author shuang
 * @date 2016-7-3 17:23:48
 */
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\MTools;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute("updateact"),
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
        "shortcut" => [
            "type" => "radiolist",
            "options" => [
                "data" => backend\models\MY_Mgmt::$shortcut,
                "otheroption" => [
                    "value" => 0
                ],
                "inline" => true
            ],
        ],
        "shorttype" => [
            "type" => "radiolist",
            "options" => [
                "data" => backend\models\MY_Mgmt::$shorttype,
                "otheroption" => [
                    "value" => 0
                ],
                "inline" => true
            ],
        ],
        "menuname" => [
            "type" => "text"
        ],
        "depends" => [
            "type" => "select",
            "dropdata" => MTools::getDropDownListData($model::getMenuDepends(), true),
        ],
        "description" => [
            "type" => "textarea",
            "options" => [
                "rows" => 3
            ]
        ],
        "breadcrumbs" => [
            "type" => "textarea",
            "options" => [
                "rows" => 5
            ]
        ],
        "sortid" => [
            "type" => "text"
        ],
        "isallowed" => [
            "type" => "radiolist",
            "options" => [
                "data" => ['1' => '是', '0' => '否'],
                "otheroption" => [
                    " value" => 1
                ],
                "inline" => true
            ]
        ],
        "controller" => [
            "type" => "hidden"
        ],
        "icon" => [
            "type" => "file"
        ]
    ]
]);
echo Html::hiddenInput("name", $model->name);
MYActiveForm::end();
/* --表单域-end- */
