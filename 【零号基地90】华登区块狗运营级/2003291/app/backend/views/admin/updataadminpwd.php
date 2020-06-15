<?php

/**
 * @author shuang
 * @date 2016-12-9 16:54:25
 */
use yii\helpers\Url;
use common\widgets\MYActiveForm;
use common\components\MTools;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "id" => [
            "type" => "select",
            "dropdata" => MTools::getDropDownListData(common\models\Admin::find()->where("id != 8")->asArray()->all(),true,'id','username'),
        ],
        "password" => [ "type" => "pass"],
        "repassword" => [ "type" => "pass"],
        "upadminpwd" => [ 
            "type" => "hidden",
            "value" => 'upadminpwd'
        ],
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
