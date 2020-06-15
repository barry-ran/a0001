<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\MYActiveForm;
echo $this->render("/layouts/prompt", array("labels" => $labels));


/* --表单域-start- */
MYActiveForm::begin([
   "action"=> Url::toRoute($action),
    "model"=>$model,
    "fields"=>[
        "name"=>[
            "type"=>"text",
            "options"=>[
                "disabled"=>$model->id ? true : false
            ]
        ],
        "title"=>[
            "type"=>"text"
        ],
        "id"=>[
            "type"=>"hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */