<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

$userprofileLabels = new backend\models\MY_UserProfile();
$userwalletLabels = new backend\models\MY_UserWallet();
//$labels = \yii\helpers\ArrayHelper::merge($labels, [
//
//]);
// 添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
    <div id="toolbar">
        <div class="form-inline" role="form">
            <div class="form-group">
                <?php
                $b = [];
                $d["id"] ="0";
                $d["name"] ="申购中";
                $f["id"] ="1";
                $f["name"] ="申购已完成";
                $g["id"] = "2";
                $g["name"] = "申购未成功";
                array_push($b,$d,$f,$g);
                echo yii\helpers\Html::dropDownList("status", null, yii\helpers\ArrayHelper::merge(["" => "-- 申购状态 --"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
            </div>
            <div class="form-group">
                <input name="search" class="form-control" type="text" placeholder="用户ID/用户名">
            </div>
            <div class="form-group">
                <input name="searchorderid" class="form-control" type="text" placeholder="申购订单号">
            </div>
            <button id="ok" type="submit" class="btn btn-primary">查 询</button>
        </div>
    </div>
    <style>
        .tipinfo>span{display: none !important;}
        .tip {height:320px;}
    </style>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["applypurchase/ajaxapplypurchase"]),
    "labels" => $labels,
    "columns" => ["mid", "id", "userid", "username", "wallet_token","add_label", "number", "totalamount", "coin_type", "status","branch_id", "created_at", "updated_at"],
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
        "finishorder" => [
            "title" => "申购完成",
            "icon" => "setting",
            "options" => [
                "class" => "finish-Data-Mulit"
            ],
        ],
        "dealfail" => [
            "title" => "申购未成功",
            "icon" => "setting",
            "options" => [
                "class" => "fail-Data-Mulit"
            ]
        ],
    ]
]);

//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
    ]
]);
$this->beginBlock('applypurchase-applypur');
?>

    var p = new Base.tablist();
    $(".finish-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
    p.updateMulit({
    url: "<?php echo Url::toRoute("finishorder"); ?>",
    message: '是否确认申购完成？<input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
    self: $(this)
    });
    });

    $(".fail-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
    p.updateMulit({
    url: "<?php echo Url::toRoute("dealfail"); ?>",
    message: '是否确认申购未完成？LKC或卢宝将返还到用户钱包<input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
    self: $(this)
    });
    });

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['applypurchase-applypur'], \yii\web\View::POS_END); ?>
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
    function send_code(type){
    var num = $("*[name='score']").val();

    $.ajax({
    type: "post",
    data: {type:type,num:num},
    dataType: "json",
    url: "/applypurchase/finishorder.html",
    success: function (data) {
    if (data.status == true) {
    alert(data.msg);
    } else {
    alert(data.msg);
    }
    }
    });
    }
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['tablesearch'], \yii\web\View::POS_END); ?>