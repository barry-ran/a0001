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
        "miner_rate" => [
            "type" => "text",
            "hints" => "(%)"
        ],
        "applybuylimit" => [
            "type" => "text",
            "hints" => "LKC才可申购"
        ],
        "applybuydayone" => [
            "type" => "text",
            "hints" => "-"
        ],
        "applybuydaytwo" => [
            "type" => "text",
            "hints" => "个工作日到账",
        ],
    ]
]);
MYActiveForm::end();
/* --表单域-end- */