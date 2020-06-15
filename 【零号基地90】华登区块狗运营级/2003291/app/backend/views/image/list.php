<?php

/*
 * @Filename     : 
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2015-12-23
 * @Description  : 
 */

use yii\helpers\Url;
use common\widgets\DatalistWidgets;

echo $this->render("/layouts/prompt", array("labels" => $labels));


//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("image/ajaxlist"),
    "labels" => $labels,
    "columns" => ["picpath", "imageurl","size", "apptype", "updated_at", "action"],
    "toolbar"=>"#toolbar",
    "fieldAttributes" => [
        "picpath" => [
            "data-class" => "table-image-list"
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