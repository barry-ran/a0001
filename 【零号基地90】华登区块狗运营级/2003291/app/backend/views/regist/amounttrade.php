<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\components\MTools;
$labels = \yii\helpers\ArrayHelper::merge($labels, [
    "action" => "超时及申诉操作",
    "action2" => "撤销订单操作",
    "action3" => "完结订单操作",
]);

$areas = \common\models\TradeNum::getAreaNum();

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
<div id="toolbar">
    <div class="form-inline" role="form">
        <div class="form-group">
            <input name="searchorderid" class="form-control" type="text" placeholder="订单号">
        </div>
        <div class="form-group">
            <?php
            $d = [];
            $e["id"] ="0";
            $e["name"] ="订单已挂出";
            $f["id"] ="1";
            $f["name"] ="买家已下单";
            $g["id"] ="2";
            $g["name"] ="买家已付款";
            $h["id"] ="3";
            $h["name"] ="订单已成交";
            $i["id"] ="4";
            $i["name"] ="订单已取消";
//            $j["id"] ="5";
//            $j["name"] ="付款已超时";
//            $k["id"] ="6";
//            $k["name"] ="收款已超时";
            $l["id"] ="7";
            $l["name"] ="卖家已下单";
            $m["id"] ="8";
            $m["name"] ="卖家申诉中";
            $n["id"] ="9";
            $n["name"] ="卖家申诉成功";
            $o["id"] ="10";
            $o["name"] ="付款超时，订单取消";
            array_push($d,$e,$f,$g,$h,$i,$l,$m,$n,$o);
            echo yii\helpers\Html::dropDownList("status", null, yii\helpers\ArrayHelper::merge(["" => "请选择交易状态"], yii\helpers\ArrayHelper::map($d, "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
        <div class="form-group">
            <input id="begin_at" class="form-control" name="begin_at"  value=""  placeholder="开始日期" autocomplete="off" type="text" />
        </div>
        <div class="form-group">
            <input id="end_at" class="form-control" name="end_at" autocomplete="off" type="text" value="" placeholder="结束日期"/>
        </div>
        <div class="form-group">
            <input name="searchin" class="form-control" type="text" placeholder="买入会员名或ID">
        </div>
        <div class="form-group">
            <input name="searchout" class="form-control" type="text" placeholder="卖出会员名或ID">
        </div>
        <button id="ok" type="submit" class="btn btn-primary">查 询</button>
    </div>
</div>
<style>
    .tipinfo>span{display: none !important;}
    .tip {height:550px;}
    .tipbtn {float: left;}
    .sxValue{text-align: center}
    #laberdia{position: initial;border:none;width:100%;height:inherit;}
</style>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["regist/ajaxamounttrade"]),
    "labels" => $labels,
    "columns" => ["mid", "id", "in_username", "out_username","amount","samount", "number", "price", "status", "phone", "buyer_phone", "old_order_id", "created_at","traded_at", "picture", "action", "action2", "action3"], // , "order_type"
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
//    "buttons" => [
//        "semiautomatch" => [
//            "title" => "手动撮合",
//            "icon" => "setting",
//            "options" => [
//                "class" => "semiautomatch-Data-Mulit"
//            ]
//        ],
//    ]
]);
$this->beginBlock('regist-list');
?>
    var p = new Base.tablist();
    $(".semiautomatch-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
        p.updateMulit({
            url: "<?php echo Url::toRoute("semiautomatch"); ?>",
            message:
                '<input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />'+
                '<label style="color:red;" id="laberdia">填入撮合数量</label><br/>' +
                '<input type="text" name="num" class="form-control"> ' +
                '<label style="color:red;" id="laberdia">选择交易区间</label><br/>' +
                '<select name="areaid">' +
                '<option value="">交易区间</option>' +
                <?php
                    foreach($areas as $area) {
                        echo '\'<option value="'.$area['areaid'].'">'.$area['areaname'].'</option>\'+';
                    }
                ?>'<br/>',
            self: $(this)
        });
    });
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