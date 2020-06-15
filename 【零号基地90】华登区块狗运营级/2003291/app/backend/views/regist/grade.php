<?php

use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\components\MTools;


//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));



//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("regist/ajaxgrade"),
    "labels" => $labels,
    "columns" => [
            "name",
        "transaction_sum",
        "recommend_sum",
        "fans_sum",
        "performance_sum",
        "frees_sum",
        "promote_sum",
        "static_sum",
        "dynamic_sum",
//        "reg_score_min",
//        "recom_v1",
//        "recom_v2",
//        "recom_v3",
//        'send_limit',
//        'recom_integral_num',
//        'recom_integral',
//        'release_per',
//        'recom_per',
//        'repeat_per',
//        'circulate_per',
        "updated_at",
        "action"],
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