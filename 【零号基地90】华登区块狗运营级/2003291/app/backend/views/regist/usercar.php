<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\components\MTools;

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
<div id="toolbar">
    <div class="form-inline" role="form">
        <div class="form-group">
            <input id="begin_at" class="form-control" name="begin_at"  value=""  placeholder="开始日期" autocomplete="off" type="text" />
        </div>
        <div class="form-group">
            <input id="end_at" class="form-control" name="end_at" autocomplete="off" type="text" value="" placeholder="结束日期"/>
        </div>
        <div class="form-group">
            <input name="search" class="form-control" type="text" placeholder="用户ID或用户名">
        </div>
        <div class="form-group">
            <?php echo yii\helpers\Html::dropDownList("car_id", null, yii\helpers\ArrayHelper::merge(["" => "请选择加速器等级"], yii\helpers\ArrayHelper::map(common\models\Car::find()->asArray()->all(), "id", "level")), ["class" => "selectpicker"]); ?>
        </div>
        <button id="ok" type="submit" class="btn btn-primary">查 询</button>
    </div>
</div>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["regist/ajaxusercar"]),
    "labels" => $labels,
    "columns" => ["mid","userid","username","car_name","en_car_name","car_level","car_price","award_per","get_num","out_num","status","ip","created_at"],
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
    ]
]);
$this->beginBlock('regist-list');
?>

<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['regist-list'], \yii\web\View::POS_END); ?>
<?php $this->beginBlock('tablesearch') ?>
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