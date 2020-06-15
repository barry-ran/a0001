<?php

/**
 * @author shuang
 * @date 2016-8-4 16:14:15
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));

//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["staticfile/ajaxlist"]),
    "labels" => $labels,
    "columns" => [ "id", "http", "filename", "description", "flag", "updated_at", "action"],
    "toolbar" => "#toolbar",
    "tableOtherAttributes" => ["data-click-to-select" => "true"],
    "fieldAttributes" => [
        "id" => [
            "data-checkbox" => "true"
        ]
    ]
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "create" => [
            "title" => "添加",
            "icon" => "create"
        ]
    ]
]);
