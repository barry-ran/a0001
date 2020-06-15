<?php

use yii\helpers\Url;
use backend\models\MY_Dirfile;
use common\components\MTools;
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
        "content"=>[
            "type"=>"textarea",
            "options"=>[
                "rows"=>3,
                "value"=> $model->name ? MTools::getFilecontent(MY_Dirfile::getFilePath($cid,$model->name))  : ""
            ]
        ],
        "id"=>[
            "type"=>"hidden"
        ],
        "cid"=>[
            "type"=>"hidden",
            "value"=>$cid
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */