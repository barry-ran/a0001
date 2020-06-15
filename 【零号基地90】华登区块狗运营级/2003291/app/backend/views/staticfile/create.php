<?php

/**
 * @author shuang
 * @date 2016-8-4 16:14:19
 */
use common\widgets\MYActiveForm;
use yii\helpers\Url;
use common\components\MTools;

/* --操作提示-start- */
echo $this->render("/layouts/prompt", array("labels" => $labels));
/* --操作提示-end- */

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "http" => [
            "type" => "select",
            "dropdata" => MTools::dictDropdown("static_http"),
        ],
        "action" => [
            "type" => "text"
        ],
        "params"=>[
            "type"=>"textarea",
            "options"=>[
                "rows"=>3
            ]
        ],
        "dir"=>[
            "type"=>"select",
            "dropdata"=>MTools::dictDropdown("static_dir"),
        ],
        "filename"=>[
            "type"=>"text"
        ],
        "filetype" => [
            "type" => "select",
            "dropdata" => MTools::dictDropdown("static_filetype"),
        ],
         "description"=>[
            "type"=>"textarea",
            "options"=>[
                "rows"=>3
            ]
        ],
        "frequency" => [
            "type" => "text"
        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();