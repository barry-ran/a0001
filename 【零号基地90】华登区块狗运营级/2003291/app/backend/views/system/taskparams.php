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
        "webimagepath" => ["type" => "text"],
        "adminimagepath" => ["type" => "text"],
        "frontendimagepath" => ["type" => "text"],
        "idrandmax" => [
            "type" => "text",
            "hints" => "会员注册id随机增长的最大值"
        ],
        "turnout_hcg_min" => [
            "type" => "text",
            "hints" => "如20,表示每次最低转出20积分"
        ],
        "turnout_hcg_max" => [
            "type" => "text",
            "hints" => "如10000,表示每次最多转出10000积分"
        ],
        "serverqq" => [
            "type" => "text",
        ],
        "weixin" => [
            "type" => "text",
            "hints" => ""
        ],
        "recharge_position" => [
            "type" => "text",
            "hints" => "例如: 2 ,表示1积分等于2元,"
        ],
        "recharge_number_min" => [
            "type" => "text",
            "hints" => ""
        ],
        "recharge_number_max" => [
            "type" => "text",
            "hints" => ""
        ],
        "withdraw_deposit" => [
            'type' => 'text',
            'hints' => '例如:1000 ,表示:推广收益至少1000才能执行提取'
        ],
        "activeperson" => [
            'type' => 'text',
            'hints' => '例如:10 ,表示:至少拥有10积分才能是激活会员'
        ],
        "weixin_code" => [
            "type" => "file",
        ],
        "qq_code" => [
            "type" => "file",
        ],


    ]
]);
MYActiveForm::end();
/* --表单域-end- */