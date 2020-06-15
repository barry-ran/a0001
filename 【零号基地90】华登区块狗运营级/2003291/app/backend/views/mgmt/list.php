<?php

/**
 * @author shuang
 * @date 2016-7-1 12:08:12
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

echo $this->render("/layouts/prompt", array("labels" => $labels));


//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("ajaxlist"),
    "labels" => $labels,
    "columns" => ["name","ismenu","menuname","description", "action"],
    "toolbar"=>"#toolbar"
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "importcontroller" => [
            "title" => "导入控制器",
            "icon" => "create"
        ]
    ]
]);