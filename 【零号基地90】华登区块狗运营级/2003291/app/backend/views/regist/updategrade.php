<?php

use yii\helpers\Url;
use common\widgets\MYActiveForm;

echo $this->render("/layouts/prompt", array("labels" => $labels));

/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "fields" => [
        "name" => [
            "type" => "text"
        ],
        "transaction_sum" => [
            "type" => "text",
            "options" => [
                "value" => $model->transaction_sum
            ],
            "hints" => "以上"
        ],
        "recommend_sum" => [
            "type" => "text",
            "options" => [
                "value" => $model->recommend_sum
            ],
            "hints" => ""
        ],
        "fans_sum" => [
            "type" => "text",
            "options" => [
                "value" => $model->fans_sum
            ],
            "hints" => ""
        ],
        "performance_sum" => [
            "type" => "text",
            "options" => [
                "value" => $model->performance_sum
            ],
            "hints" => ""
        ],
        "frees_sum" => [
            "type" => "text",
            "options" => [
                "value" => $model->frees_sum
            ],
            "hints" => ""
        ],
        "promote_sum" => [
            "type" => "text",
            "options" => [
                "value" => $model->promote_sum
            ],
            "hints" => ""
        ],
        "static_sum" => [
            "type" => "text",
            "options" => [
                "value" => $model->static_sum * 100
            ],
            "hints" => "(单位%)"
        ],
        "dynamic_sum" => [
            "type" => "text",
            "options" => [
                "value" => $model->dynamic_sum * 100
            ],
            "hints" => "(单位%)"
        ],
//        "reg_score_min" => [
//            "type" => "text",
//            "options" => [
//                "value" => $model->reg_score_min
//            ],
//            "hints" => ""
//        ],
//        "recom_v1" => [
//            "type" => "text",
//            "options" => [
//                "value" => $model->recom_v1
//            ]
//        ],
//        "recom_v2" => [
//            "type" => "text",
//            "options" => [
//                "value" => $model->recom_v2
//            ]
//        ],
//        "recom_v3" => [
//            "type" => "text",
//            "options" => [
//                "value" => $model->recom_v3
//            ]
//        ],
//        "send_limit" => [
//            "type" => "text",
//            "options" => [
//                "value" => $model->send_limit
//            ]
//        ],
//        "recom_integral_num" => [
//            "type" => "text",
//            "options" => [
//                "value" => $model->recom_integral_num
//            ]
//        ],
//        "recom_integral" => [
//            "type" => "text",
//            "options" => [
//                "value" => $model->recom_integral
//            ]
//        ],
//        "release_per" => [
//            "type" => "text",
//            "hints" => "(单位%)",
//            "options" => [
//                "value" => $model->release_per * 100
//            ]
//        ],
//        "recom_per" => [
//            "type" => "text",
//            "hints" => "(单位%) 首次投资",
//            "options" => [
//                "value" => $model->recom_per * 100
//            ]
//        ],
//        "repeat_per" => [
//            "type" => "text",
//            "hints" => "(单位%) 2-15层",
//            "options" => [
//                "value" => $model->repeat_per * 100
//            ]
//        ],
//        "circulate_per" => [
//            "type" => "text",
//            "hints" => "(单位%) 转让，商城支付",
//            "options" => [
//                "value" => $model->circulate_per * 100
//            ]
//        ],
        "id" => [
            "type" => "hidden"
        ]
    ]
]);
MYActiveForm::end();
/* --表单域-end- */
