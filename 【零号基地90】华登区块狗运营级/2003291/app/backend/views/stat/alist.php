<?php

/**
 * @author shuang
 * @date 2016-12-13 23:18:01
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

$userprofileLabels = new backend\models\MY_UserProfile();
$labels = \yii\helpers\ArrayHelper::merge($labels, [
            "truename" => $userprofileLabels->attributeLabels()["truename"],
            "username" => "会员账号"
        ]);
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
        <button id="ok" type="submit" class="btn btn-primary">查 询</button>
    </div>
</div>

<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["stat/ajaxalist"]),
    "labels" => $labels,
    //"columns" => ["username", "note", "award_type", "amount", "cash_amount", "regist_amount", "hcg_amount", "updated_at"],
    "columns" => ["data1","data4","data5","data6","data7","data8","data2","data3"],
    "tableOtherAttributes" => [
        "data-toolbar" => "#toolbar",
        "data-query-params" => "queryParams",
        "data-click-to-select" => "true"
    ],
    "fieldAttributes" => [
        "data1" => ["data-sortable" => "true"],
        "data2" => ["data-sortable" => "true"],
        "data3" => ["data-sortable" => "true"],
    ],
    "toolbar" => "#toolbar"
]);
?>


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
var p = new Base.tablist();
$(".deletestock-Data-Mulit").bind("click", function (e) {
p.updateMulit({
url: "<?php echo Url::toRoute("forcestock"); ?>",
message: '<b>剩余数量：</b><input type="text" value="4300" name="score" style="border:1px solid #ccc;line-height:30px;"/><br />您确定要给清除股？',
self: $(this)
});
});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['tablesearch'], \yii\web\View::POS_END); ?>
