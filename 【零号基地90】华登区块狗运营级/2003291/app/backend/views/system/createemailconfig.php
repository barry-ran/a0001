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
//if($model['host']){
//    $model['host'] = explode('.', $model['host'])['1'];
//}

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "host" => [
            "type" => "text",
            "hints" => "例如：smtp.qy.tom.com，smtp.qq.com"
        ],
        "port" => [
            "type" => "text",
            "hints" => "如不清楚，请勿填写"
        ],
        "email" => [
            "type" => "text",
        ],
        "password" => [
            "type" => "text"
        ],
        "encryption" => [
            "type" => "text",
        ],
//        "is_active" => [
//            "type" => "select",
//            "dropdata" => \common\components\MTools::getDropDownListData(\common\models\EmailConfig::$is_active),
//        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
