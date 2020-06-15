<?php

use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\components\MTools;


//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
<div id="toolbar">
    <div class="form-inline" role="form">
        <div class="form-group">
            <?php 
                    $b = [];
                    $d["id"] ="1";
                    $d["name"] ="预热中";
                    $f["id"] ="2";
                    $f["name"] ="进行中";
                    $h["id"] ="3";
                    $h["name"] ="已结束";
                    array_push($b,$d,$f,$h);
            echo yii\helpers\Html::dropDownList("status", null, yii\helpers\ArrayHelper::merge(["" => "请选择状态"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
        
        <div class="form-group">
            <input id="begin_at" class="form-control" name="begin_at"  value=""  placeholder="开始日期" autocomplete="off" type="text" />
        </div>
        <div class="form-group">
            <input id="end_at" class="form-control" name="end_at" autocomplete="off" type="text" value="" placeholder="结束日期"/>
        </div>
        <button id="ok" type="submit" class="btn btn-primary">查 询</button>
    </div>
</div>

<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("currency/ajaxsellcare"),
    "labels" => $labels,
    "columns" => ["id","img","sell_num","remain_num",'sell_time','end_time','status',"admin_id","admin_name","ip","note","created_at"],
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
        "createsellcare" => [
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