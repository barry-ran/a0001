<?php

/**
 * @author shuang
 * @date 2016-7-1 16:30:11
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

echo $this->render("/layouts/prompt", array("labels" => $labels));


//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["ajaxalist","controller"=>$controller]),
    "labels" => $labels,
    "columns" => ["name","ismenu","menuname","isallowed","depends","description", "action"],
    "toolbar"=>"#toolbar"
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "importact" => [
            "title" => "导入方法",
            "icon" => "create",
            "params"=>["controller"=>$controller]
        ]
    ]
]);
