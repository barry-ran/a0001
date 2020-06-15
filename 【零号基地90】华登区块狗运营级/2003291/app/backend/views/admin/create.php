<?php

use yii\helpers\Url;
use common\widgets\MYActiveForm;
use common\components\MTools;

$cssString = "#my_admin-authids label{width:300px;} .radio-inline + .radio-inline, .checkbox-inline + .checkbox-inline{margin-left:0px;}";
$this->registerCss($cssString);
echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --表单域-start- */
if ($action !== "update") {
    MYActiveForm::begin([
        "action" => Url::toRoute($action),
        "model" => $model,
        "fields" => [
            "username" => [ "type" => "text"],
            "password" => [ "type" => "pass"],
            "repassword" => [ "type" => "pass"],
            "phone" => [ "type" => "text"],
            "email" => [ "type" => "text"],
            "authids" => [ "type" => "checklist", "options" => [
                    "inline" => true,
                    "data" => backend\models\MY_Permission::getAllpermission(),
            ]],
            "upadminpwd" => [ 
                "type" => "hidden",
                "value" => 'create'
            ],
        ]
    ]);
} else {
    $model->authids = explode(",", $model->authids);
    MYActiveForm::begin([
        "action" => Url::toRoute($action),
        "model" => $model,
        "fields" => [
            "username" => [ "type" => "text", "options" => ["disabled" => true]],
            "phone" => [ "type" => "text"],
            "email" => [ "type" => "text"],
            "authids" => [ "type" => "checklist", "options" => [
                    "inline" => true,
                    "data" => backend\models\MY_Permission::getAllpermission(),
                ]],
            "id" => [ "type" => "hidden"],
            "upadminpwd" => [ 
                "type" => "hidden",
                "value" => 'update'
            ],
        ]
    ]);
}
MYActiveForm::end();
/* --表单域-end- */