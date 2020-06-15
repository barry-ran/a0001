<?php

/**
 * @author shuang
 * @date 2016-8-2 11:07:56
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\widgets\MYSearchForm;
use common\components\MTools;

$labels = \yii\helpers\ArrayHelper::merge($labels, [
            "id" => "标题",
            "content" => "标题",
            "img" => "图片",
            "created_at" => "创建时间",
        ]);

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));

//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("article/ajaxadvertisement"),
    "labels" => $labels,
    "columns" => ["id", "content", "img","created_at", "action"],
    "toolbar" => "#toolbar",
    "tableOtherAttributes" => ["data-click-to-select" => "true"],
    "fieldAttributes" => [
        "mid" => [
            "data-checkbox" => "true"
        ],      
    ]
]);

//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "addadvertisement" => [
            "title" => "添加",
            "icon" => "create"
        ]
    ]
]);

$this->beginBlock('tablesearch') 
?>
var $table = $('#table'),
$ok = $('#ok');
$(function () {
$ok.click(function () {
$table.bootstrapTable('refresh',{pagination:true});
});
});
function queryParams(params) {
$('#toolbar').find('input[name]').each(function () {
params[$(this).attr('name')] = $(this).val();
});
$('#toolbar').find('select[name]').each(function () {
params[$(this).attr('name')] = $(this).val();
});

return params;
}
jeDate({
dateCell: '#begin_at',
format: 'YYYY-MM-DD',
festival: true,
maxDate: '2099-06-16 23:59:59', //最大日期
isTime: true
});
jeDate({
dateCell: '#end_at',
format: 'YYYY-MM-DD',
festival: true,
maxDate: '2099-06-16 23:59:59', //最大日期
isTime: true
});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['tablesearch'], \yii\web\View::POS_END); ?>
