<?php

use yii\helpers\Url;
use common\widgets\DatalistWidgets;


echo $this->render("/layouts/prompt", array("labels" => $labels));


//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("level/ajaxpowlist"),
    "labels" => $labels,
    "columns" => ["name","oper_at","value","hourly_output","twelve_output","seventytwo_output","sevenhundred_output","score",'created_at',"action"],
    "toolbar"=>"#toolbar"
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "powcreate" => [
            "title" => "添加",
            "icon" => "create"
        ]
    ]
]);
