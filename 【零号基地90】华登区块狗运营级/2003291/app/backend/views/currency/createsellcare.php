<?php

/**
 * @author shuang
 * @date 2016-12-14 20:46:08
 */
use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "img" => [
            "type" => "file"
        ],
        "sell_num" => [
            "type" => "text"
        ],
        "lv_limit" => [
            "type" => "text"
        ],
        "lv0_limit" => [
            "type" => "text"
        ],
        "lv1_limit" => [
            "type" => "text"
        ],
        "lv2_limit" => [
            "type" => "text"
        ],
        "lv3_limit" => [
            "type" => "text"
        ],
        "sell_time" => [
            "type" => "date",
        ],
        "end_time" => [
            "type" => "date",
        ],
//        "price" => [
//            "type" => "text"
//        ],
        "note" => [
            "type" => "textarea",
            "rows" => 2
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
?>

