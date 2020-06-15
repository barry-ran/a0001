<?php

/**
 * @author shuang
 * @date 2016-10-9 16:38:46
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));

//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("admin/ajaxperlist"),
    "labels" => $labels,
    "columns" => ["mid", "id", "name", "updated_at", "action"],
    "toolbar" => "#toolbar",
    "tableOtherAttributes" => ["data-click-to-select" => "true"],
    "fieldAttributes" => [
        "mid" => [
            "data-checkbox" => "true"
        ]
    ]
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "createper" => [
            "title" => "添加",
            "icon" => "create"
        ]
    ]
]);
