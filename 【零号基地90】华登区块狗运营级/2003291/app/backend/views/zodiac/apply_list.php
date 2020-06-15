<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;
$labels = \yii\helpers\ArrayHelper::merge($labels, [
    "username" => '用户账号',
    "zodiac_name" => '宠物名称',
    "grade_name" => '宠物等级名称'
]);
//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
    <!--顶部条件筛选-->
    <div id="toolbar">
        <div class="form-inline" role="form">
            <div class="form-group">
                <?php
                echo yii\helpers\Html::dropDownList("zodiac_name", null, yii\helpers\ArrayHelper::merge(["" => "选择宠物名称"], yii\helpers\ArrayHelper::map(\common\models\Zodiac::getZodiacname(), "id", "name")), ["class" => "selectpicker"]); ?>
            </div>

            <button id="ok" type="submit" class="btn btn-primary">查 询</button>
        </div>
    </div>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["zodiac/ajaxapplylist"]),
    "labels" => $labels,
    "columns" => ["id", "username","zodiac_name","grade_name","created_at","status","islock","action"],
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