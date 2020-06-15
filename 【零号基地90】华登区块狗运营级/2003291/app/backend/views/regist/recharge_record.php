<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

//$userprofileLabels = new backend\models\MY_UserProfile();
//$userwalletLabels = new backend\models\MY_UserWallet();
$labels = \yii\helpers\ArrayHelper::merge($labels, [
    //"truename" => $userprofileLabels->attributeLabels()["truename"],
//    "hcg_wa" => '积分',
]);
//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
    <!--顶部条件筛选-->
    <div id="toolbar">
        <div class="form-inline" role="form">
            <!--        用户名手机号-->
            <div class="form-group">
                <input name="search" class="form-control" type="text" placeholder="用户名或ID">
            </div>
            <!--        开始日期-->
            <div class="form-group">
                <input id="begin_at" class="form-control" name="created_at"  value=""  placeholder="充值时间" autocomplete="off" type="text" />
            </div>
            <!--        查询按钮-->
            <button id="ok" type="submit" class="btn btn-primary">查 询</button>
        </div>
    </div>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["regist/ajaxrechargelist"]),
    "labels" => $labels,
    "columns" => ["id", "userid","username", "hcg","money", "scale","created_at",],
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