<?php

/*
 * @Filename     : createChild
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-6-6 11:53:18
 * @Description  : 添加字典子项
 */

use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\widgets\MYActiveForm;
use common\components\MTools;

if ($column_id) {
    $model->column_id = $column_id;

    /* --操作提示-start- */
    echo $this->render("/layouts/prompt", array("labels" => $labels));
    /* --操作提示-end- */

    /* --表单域-start- */
    $form = MYActiveForm::begin([
                "action" => Url::toRoute($action),
                "model" => $model,
                "fields" => [
                    "icon" => [
                        "type" => "file"
                    ],
                    "column_id" => [
                        "type" => "select",
                        "dropdata"=>MTools::dictDropdown("default"),
                        "options"=>[
                            "selected"=>$column_id,
                        ],
                        "callback" => 'function(v){window.location.href ="' . Url::toRoute(["createChild", "column_id" => ""]) . '"+v}'
                    ],
                    "name" => [
                        "type" => "text"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "options" => ["rows" => 3]
                    ],
                    "id" => [
                        "type" => "hidden"
                    ]
                ]
    ]);
    MYActiveForm::end();
    /* --表单域-end- */

    /* --调用数据列表模板-- */
    echo DatalistWidgets::widget([
        'data_url' => Url::toRoute(["dict/ajaxlist", "child" => true, "column_id" => $column_id]),
        "labels" => $labels,
        "columns" => ["id", "name", "description", "created_at", "updated_at", "action"]
    ]);
}