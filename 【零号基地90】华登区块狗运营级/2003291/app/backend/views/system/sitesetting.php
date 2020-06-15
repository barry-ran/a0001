<?php

/**
 * @author shuang
 * @date 2016-8-5 10:00:25
 */
use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "fileRootDir" => [ "type" => "text"],
        "admindefaultImage" => [ "type" => "text"],
        "website" => [ "type" => "text"],
        "powerby" => [ "type" => "textarea", "options" => [ "rows" => 3]],
        "seo_keywords" => [ "type" => "text"],
        "seo_description" => [ "type" => "textarea","options" => [ "rows" => 3]],
        "seo_title" => [ "type" => "text"],
        "beian" => [ "type" => "text"]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */