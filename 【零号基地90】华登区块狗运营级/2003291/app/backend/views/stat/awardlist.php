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
            <?php 
                    $b = [];
                    $d["id"] ="1";
                    $d["name"] ="激活账号";
                    $f["id"] ="2";
                    $f["name"] ="会员升级";
                    $e["id"] ="4";
                    $e["name"] ="平台拨发";
                    $g["id"] ="3";
                    $g["name"] ="SDK交易";
                    $h["id"] ="5";
                    $h["name"] ="钱包转换";
                    $x["id"] ="6";
                    $x["name"] ="注册金交易";
//                    $y["id"] ="8";
//                    $y["name"] ="出售sdk";
//                    $z["id"] ="9";
//                    $z["name"] ="现金钱包";
//                    $n["id"] ="10";
//                    $n["name"] ="注册钱包";
//                    $m["id"] ="11";
//                    $m["name"] ="关联钱包";
//                    $i["id"] ="12";
//                    $i["name"] ="分红奖";
                    array_push($b,$d,$f,$g,$h,$x,$e);
            echo yii\helpers\Html::dropDownList("award_type", null, yii\helpers\ArrayHelper::merge(["" => "选择类型"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
        <div class="form-group">
            <input name="search" class="form-control" type="text" placeholder="输入会员账号">
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
    'data_url' => Url::toRoute(["stat/ajaxawardlist"]),
    "labels" => $labels,
    "columns" => ["userid","username", "note", "award_type", "amount", "cash_amount", "regist_amount", "hcg_amount","ip", "updated_at"],
    "tableOtherAttributes" => [
        "data-search" => "true",
        //"data-sort-name"=>"hcg_amount",
        "data-sort-name"=>"me_user_award_record.updated_at",
        "data-sort-order"=>"desc",
        "data-toolbar" => "#toolbar",
        "data-query-params" => "queryParams",
        "data-click-to-select" => "true"
    ],
    "fieldAttributes" => [
        "amount" => ["data-sortable" => "true"],
        "cash_amount" => ["data-sortable" => "true"],
//        "care_amount" => ["data-sortable" => "true"],
//        "shop_amount" => ["data-sortable" => "true"],
        "regist_amount" => ["data-sortable" => "true"],
        "updated_at" => ["data-sortable" => "true"],
        "hcg_amount" => ["data-sortable" => "true"]
        
    ],
    "toolbar" => "#toolbar"
]);
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "awardexcel" => [
            "title" => "EXCEL",
            "icon" => "setting",
        ],
    ]
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
