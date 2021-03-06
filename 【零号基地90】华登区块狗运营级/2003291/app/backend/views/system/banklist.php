<?php

/**
 * @author shuang
 * @date 2016-12-14 20:46:00
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));

//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["system/ajaxbanklist"]),
    "labels" => $labels,
    "columns" => ["name", "en_name","updated_at", "action"],
    "toolbar" => "#toolbar"
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "bankcreate" => [
            "title" => "添加",
            "icon" => "create"
        ]
    ]
]);
