<?php

use yii\helpers\Url;
use common\widgets\MYActiveForm;

$cssString = "#my_permission-authitems label{width:300px;} .radio-inline + .radio-inline, .checkbox-inline + .checkbox-inline{margin-left:0px;}";
$this->registerCss($cssString);

echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --表单域-start- */
if ($action !== "updateper") {
    MYActiveForm::begin([
        "action" => Url::toRoute($action),
        "model" => $model,
        "fields" => [
            "name" => [ "type" => "text"],
            "authitems" => [ "type" => "checklist", "options" => [
                    "inline" => true,
                    "data" => $model::getFunctionsData(),
                ]]
        ]
    ]);
} else {
    $model->authitems = explode(",", $model->authitems);
    MYActiveForm::begin([
        "action" => Url::toRoute($action),
        "model" => $model,
        "fields" => [
            "name" => [ "type" => "text", "options" => ["disabled" => true]],
            "authitems" => [ "type" => "checklist", "options" => [
                    "inline" => true,
                    "data" => $model::getFunctionsData(),
                ]],
            "id" => [ "type" => "hidden"]
        ]
    ]);
}
MYActiveForm::end();
/* --表单域-end- */