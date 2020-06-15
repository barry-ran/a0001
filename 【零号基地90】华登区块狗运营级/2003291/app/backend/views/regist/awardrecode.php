<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
<!--顶部条件筛选-->
<div id="toolbar">
    <div class="form-inline" role="form">
<!--        出入账-->
        <div class="form-group">
            <?php 
                    $b = [];
                    $d["id"] ="1";
                    $d["name"] ="入账";
                    $f["id"] ="2";
                    $f["name"] ="出账";
                    array_push($b,$d,$f);
            echo yii\helpers\Html::dropDownList("pay_type", null, yii\helpers\ArrayHelper::merge(["" => "请选择出入账类型"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
<!--        钱包类型-->
        <div class="form-group">
            <?php 
                    $b = [];
                    $d["id"] ="1";
                    $d["name"] ="积分";
                    $f["id"] ="2";
                    $f["name"] ="GTC";
                    $g["id"] ="3";
                    $g["name"] ="推广收益";
                    array_push($b,$d,$f,$g);
            echo yii\helpers\Html::dropDownList("wallet_type", null, yii\helpers\ArrayHelper::merge(["" => "请选择钱包类型"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
<!--        事件类型-->
        <div class="form-group">
            <?php
            echo yii\helpers\Html::dropDownList("event_type", null, yii\helpers\ArrayHelper::merge(["" => "请选择事件类型"], yii\helpers\ArrayHelper::map(\common\models\UserWalletRecord::getEventType(), "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
<!--        开始时间-->
        <div class="form-group">
            <input id="begin_at" class="form-control" name="begin_at"  value=""  placeholder="开始日期" autocomplete="off" type="text" />
        </div>
<!--        结束时间-->
        <div class="form-group">
            <input id="end_at" class="form-control" name="end_at" autocomplete="off" type="text" value="" placeholder="结束日期"/>
        </div>
<!--        用户ID或用户名-->
        <div class="form-group">
            <input name="search" class="form-control" type="text" placeholder="用户ID或用户名">
        </div>
        <button id="ok" type="submit" class="btn btn-primary">查 询</button>
    </div>
</div>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["regist/ajaxawardrecode"]),
    "labels" => $labels,
    "columns" => ["mid", "id", "userid", "username","amount","event_type", "wallet_type", "wallet_amount",  "note", "created_at"],
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