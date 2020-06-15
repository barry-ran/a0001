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
//        "email" => [
//            "type" => "text",
//            "hints"=>"<font color='red'>会员的默认 登陆密码：111111，安全交易密码：111111</font>"
//        ],
        "username" => [
            "type" => "text",
            "hints"=>"<font color='red'>会员账号必须是字母开头,长度为8-16位的字母数字组合！<br/>默认的登陆密码：111111，安全交易密码：111111</font>"
        ],
        "truename" => [
            "type" => "text"
        ],
        "phone" => [
            "type" => "text",
        ],
//        "idcard" => [
//            "type" => "text"
//        ],
        "invite_code" => [
            "type" => "text",
            "hints"=>"若是要生成系统账号，则不填"
        ],
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
