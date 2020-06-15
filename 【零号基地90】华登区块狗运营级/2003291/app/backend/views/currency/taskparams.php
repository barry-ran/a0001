<?php

/**
 * @author shuang
 * @date 2016-10-28 9:47:27
 */
use yii\helpers\Url;
use common\components\MTools;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "lkctradeswitch" => [
            "type" => "select",
            "dropdata" => $model::$onOroff,
            "options" => [
            ]
        ],
        "transfer_fee" => [
            "type" => "text",
            "hints" => "(%)"
        ],
        "terrace_fee" => [
            "type" => "text",
            "hints" => "(%)"
        ],
        "tbthawper"=>[
            "type" => "text",
            "hints" => "（%）"
        ],
        "available" => [
            "type" => "text",
            "hints" => "（%）"
        ],
        "min_care" => [
            "type" => "text",
        ],

        "buycarelimit"=>[
            "type" => "text",
            "hints" => "（枚）"
        ],

        "superprofit" => [
            "type" => "text"
        ],

        "superprofit2" => [
            "type" => "text"
        ],
    ]
]);
MYActiveForm::end();
/* --表单域-end- */