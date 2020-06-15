<?php

/*
 * @Filename     : list
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-4-15 20:40:04
 * @Description  : 
 */

use yii\helpers\Url;
use common\widgets\DatalistWidgets;

$labels = \yii\helpers\ArrayHelper::merge($labels, [
    "is_sell" => '是否售出',
    'zodiac_name' => "宠物名称"
]);
//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
<!--顶部条件筛选-->
<div id="toolbar">
    <div class="form-inline" role="form">
        <!--        是否被封-->
        <div class="form-group">
            <?php
            $b = [];
            $d["id"] ="1";
            $d["name"] ="已限制出售";
            $f["id"] ="0";
            $f["name"] ="未限制出售";
            array_push($b,$d,$f);
            echo yii\helpers\Html::dropDownList("allow_rack", null, yii\helpers\ArrayHelper::merge(["" => "是否被限制出售"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
        <div class="form-group">
            <?php
            $b = [];
            $d["id"] ="1";
            $d["name"] ="已上架";
            $f["id"] ="0";
            $f["name"] ="未上架";
            array_push($b,$d,$f);
            echo yii\helpers\Html::dropDownList("is_rack", null, yii\helpers\ArrayHelper::merge(["" => "是否上架"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
        <!--用户名或id-->
        <div class="form-group">
            <input name="search" class="form-control" type="text" placeholder="用户名或id">
        </div>
        <!--        查询按钮-->
        <button id="ok" type="submit" class="btn btn-primary">查 询</button>
    </div>
</div>

<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("zodiac/ajaxuserzodiac"),
    "labels" => $labels,
    "columns" => [ "id","userid", "username","zodiac_id","zodiac_name", "old_hcg","hcg","created_at", "due", "award","rise_num","is_rack", "is_overtime",'is_sell',"over_time", "updated_at",'source',"action"],
    "toolbar" => "#toolbar",
    "tableOtherAttributes" => [
        "data-sort-name" => "updated_at",
        "data-toolbar" => "#toolbar",
        "data-query-params" => "queryParams",
        "data-click-to-select" => "true"
    ],
    "fieldAttributes" => [
        "mid" => [
            "data-checkbox" => "true"
        ],
        "id" => ["data-sortable" => "true"],
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
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['tablesearch'], \yii\web\View::POS_END); ?>