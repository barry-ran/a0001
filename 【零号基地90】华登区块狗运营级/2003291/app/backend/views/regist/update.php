<?php

/**
 * @author shuang
 * @date 2016-12-14 19:45:37
 */
use yii\helpers\Url;
use common\widgets\MYActiveForm;

$user = backend\models\MY_User::findOne(Yii::$app->request->get("id"));
echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "username" => [
            "type" => "text",
            "options" => [
                "disabled" => true,
                "value" => $user->username
            ]
        ],
        "truename" => [
            "type" => "text",
            "options" => [
                "value" => $user->userprofile->truename
            ]
        ],
        "phone" => [
            "type" => "text",
            "options" => [
                "value" => $user->userprofile->phone
            ]
        ],

        "idcard" => [
            "type" => "text",
            "options" => [
                "value" => $user->userprofile->idcard
            ]
        ],

        "iseal" => [
            "type" => "select",
            "dropdata" => $model::$onOroff,
            "options" => [
                "selected"=>$user->iseal,
            ]
        ],
//        "issell" => [
//            "type" => "select",
//            "dropdata" => $model::$lkcsellOrnot,
//            "options" => [
//                //"value" => $user->iseal
//            ]
//        ],
//        "seal_reason" => [
//            "type" => "text",
//            "hints" => "（若有封号操作，请填入封号原因）",
//            "options" => [
//                "value" => ''
//            ]
//        ],
        "password_hash" => [
            "type" => "text",
            "hints" => "（若不修改登录密码则不用填写）",
            "options" => [
                "value" => ''
            ]
        ],
        "password_hash2" => [
            "type" => "text",
            "hints" => "（若不修改交易密码则不用填写）",
            "options" => [
                "value" => ''
            ]
        ],
        "id" => [
            "type" => "hidden",
            "options" => [
                "value" => $user->id
            ]
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */