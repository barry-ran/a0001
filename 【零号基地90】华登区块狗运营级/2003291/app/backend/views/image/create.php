<?php

use yii\helpers\Url;
use common\components\MTools;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action"=>Url::toRoute($action),
    "model"=>$model,
    "fields"=>[
        "apptype"=>[
            "type"=>"select",
            "dropdata"=>MTools::dictDropdown("apptype")
        ],
        "size"=>[
            "type"=>"select",
            "dropdata"=>MTools::dictDropdown("picsize")
        ],
        "picpath"=>[
            "type"=>"file",
            "name"=>"picpath[]"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
