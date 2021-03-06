<?php

/*
 * @Filename     : list
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-4-15 20:40:04
 * @Description  : 
 */

use yii\helpers\Url;
use common\widgets\DatalistWidgets;


//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));

//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("admin/ajaxlist"),
    "labels" => $labels,
    "columns" => [ "mid", "id", "username", "phone", "email","updated_at", "action"],
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
        "create" => [
            "title" => "添加",
            "icon" => "create"
        ]
    ]
]);
