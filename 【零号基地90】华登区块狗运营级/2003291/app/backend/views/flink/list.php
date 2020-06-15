<?php

use yii\helpers\Url;
use common\widgets\DatalistWidgets;


echo $this->render("/layouts/prompt", array("labels" => $labels));


//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("flink/ajaxlist"),
    "labels" => $labels,
    "columns" => ["id","webname", "url", "typeid", "updated_at", "action"],
    "toolbar"=>"#toolbar",
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
