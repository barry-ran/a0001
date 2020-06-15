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
        "tradeswitch" => [
            "type" => "select",
            "dropdata" => $model::$onOroff,
            "options" => [
            ]
        ],
        "applytradeswitch" => [
            "type" => "select",
            "dropdata" => $model::$onOroff,
            "options" => [
            ]
        ],
//        "autotradeswitch" => [
//            "type" => "select",
//            "dropdata" => $model::$onOroff,
//            "options" => [
//            ]
//        ],
        "buyeruntradelimit" => [
            "type" => "text",
            "hints" => "次限制交易"
        ],
        "buyertradeovertime" => [
            "type" => "text",
            "hints" => "个小时",
        ],
        "sellertradeovertime" => [
            "type" => "text",
            "hints" => "个小时",
        ],
    ]
]);
MYActiveForm::end();
/* --表单域-end- */