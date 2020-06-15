<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\components\MTools;
$labels = \yii\helpers\ArrayHelper::merge($labels,[
    "wechat" => '微信号',
    "wechat_img" => '微信收款码',
    'alipay' => '支付宝账号',
    'alipay_img' => '支付宝收款码',
    'action' => '操作'
]);

//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
    <div id="toolbar">
        <div class="form-inline" role="form">
            <div class="form-group">
                <input name="search" class="form-control" type="text" placeholder="用户名或ID或手机号">
            </div>
            <button id="ok" type="submit" class="btn btn-primary">查 询</button>
        </div>
    </div>
    <style>
        .tipinfo>span{display: none !important;}
        .tip {height:550px;}
    </style>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["regist/ajaxcertificationlist"]),
    "labels" => $labels,
    "columns" => ["mid", "userid", "username", "name","idNo","wechat","wechat_img","alipay","alipay_img", "created_at", "is_success", "action"],
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
        "disagree" => [
            "title" => "审核驳回",
            "icon" => "setting",
            "options" => [
                "class" => "disagree-Data-Mulit"
            ]
        ],
    ]
]);

$this->beginBlock('regist-certification');
?>
    var p = new Base.tablist();
    $(".disagree-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
    p.updateMulit({
    url: "<?php echo Url::toRoute("disagree"); ?>",
    message: '<b>驳回原因：</b><input type="text" placeholder="驳回原因" name="reason" style="border:1px solid #ccc;line-height:30px;"/><br /><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
    self: $(this)
    });
    });


<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['regist-certification'], \yii\web\View::POS_END); ?>
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