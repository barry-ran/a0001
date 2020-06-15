<?php

/**
 * @author shuang
 * @date 2016-12-8 16:25:45
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\components\MTools;


//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));


//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["service/ajaxcontactlist"]),
    "labels" => $labels,
    "columns" => ['userid',"username","content", "created_at"],
    "tableOtherAttributes" => [
        "data-sort-name" => "updated_at",
        "data-toolbar" => "#toolbar",
        "data-query-params" => "queryParams",
        "data-click-to-select" => "true"
    ],
    "toolbar" => "#toolbar",
    "fieldAttributes" => [
        "mid" => [
            "data-checkbox" => "true"
        ],
        "id" => ["data-sortable" => "true"],
    ]
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "createcontanct" => [
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