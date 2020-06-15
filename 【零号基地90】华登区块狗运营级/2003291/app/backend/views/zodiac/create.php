<?php

/**
 * @author shuang
 * @date 2016-8-2 11:07:51
 */
use common\widgets\MYActiveForm;
use yii\helpers\Url;
use common\components\MTools;

/* --操作提示-start- */
echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --操作提示-end- */

/* --表单域-start- */
//$model->flags = $model->flags ? explode(",", $model->flags) : null;
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
//        "typeid" => [
//            "type" => "select",
//            "dropdata" => MTools::dictDropdown("product_wikid"),
//        ],
        "name" => [
            "type" => "text"
        ],
        "begin_at_hour" => [
            "type" => "text"
        ],
        "begin_at_minu" => [
            "type" => "text"
        ],
        "end_at_hour" => [
            "type" => "text"
        ],
        "end_at_minu" => [
            "type" => "text"
        ],
        "is_show" => [
            "type" => "select",
            "dropdata" => $model::$onOroff,
            "options" => [
                "value" => $model->is_show
            ]
        ],
        "picture" => [
            "type" => "file"
        ],
        "subscribe" => [
            "type" => "text",
            "hints" =>"积分"
        ],
        "seckill" => [
            "type" => "text",
            "hints" =>"积分"
        ],
        "hcg_min" => [
            "type" => "text",
        ],
        "hcg_max" => [
            "type" => "text",
        ],
        "kmd" => [
            "type" => "text",
            "hints" => ""
        ],
        "cash" => [
            "type" => "text",
            'hints' => "个"
        ],
        "due" => [
            "type" => "text",
            "hints" =>"天"
        ],
        "click_num" => [
            "type" => "text",
            "hints" =>"点"
        ],
        "award" => [
            "type" => "text",
            "hints" =>"%"
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
