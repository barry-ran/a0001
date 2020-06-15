<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;

$userprofileLabels = new backend\models\MY_UserProfile();
$userwalletLabels = new backend\models\MY_UserWallet();
$labels = \yii\helpers\ArrayHelper::merge($labels, [
            "id" => $userprofileLabels->attributeLabels()["userid"],
            //"truename" => $userprofileLabels->attributeLabels()["truename"],
            "hcg_wa" => '积分',
            "cash_wa" => 'GTC',
            "care_wa" => '推广收益',
            "mycode" => "邀请码",
            "invitename" => "推荐人",
            'grade_name'=>'会员等级',
            'branch_id'=>'所属区ID',
            'total_award' => '累计收益',
            'truename' => '真实姓名',
        ]);
//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
//$labels = \yii\helpers\ArrayHelper::merge($labels, [
//    "username" => '用户账号',
//]);
?>
<!--顶部条件筛选-->
<div id="toolbar">
    <div class="form-inline" role="form">
<!--        是否被封-->
        <div class="form-group">
            <?php 
                    $b = [];
                    $d["id"] ="1";
                    $d["name"] ="已封";
                    $f["id"] ="0";
                    $f["name"] ="正常";
                    array_push($b,$d,$f);
            echo yii\helpers\Html::dropDownList("iseal", null, yii\helpers\ArrayHelper::merge(["" => "是否被封"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
<!--        会员等级-->
        <div class="form-group">
            <?php echo yii\helpers\Html::dropDownList("grade_id", null, yii\helpers\ArrayHelper::merge(["" => "会员等级"], yii\helpers\ArrayHelper::map(common\models\Grade::find()->asArray()->all(), "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
<!--        LKC等级-->
        <div class="form-group">
            <?php echo yii\helpers\Html::dropDownList("level_id", null, yii\helpers\ArrayHelper::merge(["" => "请选择静态收益等级"], yii\helpers\ArrayHelper::map(backend\models\MY_Level::find()->asArray()->all(), "id", "name")), ["class" => "selectpicker"]); ?>
        </div>
<!--        开始日期-->
        <div class="form-group">
            <input id="begin_at" class="form-control" name="begin_at"  value=""  placeholder="开始日期" autocomplete="off" type="text" />
        </div>
<!--        结束日期-->
        <div class="form-group">
            <input id="end_at" class="form-control" name="end_at" autocomplete="off" type="text" value="" placeholder="结束日期"/>
        </div>
<!--        用户名手机号-->
        <div class="form-group">
            <input name="search" class="form-control" type="text" placeholder="用户名或ID">
        </div>
<!--        查询按钮-->
        <button id="ok" type="submit" class="btn btn-primary">查 询</button>
    </div>
</div>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["regist/ajaxlist"]),
    "labels" => $labels,
    "columns" => ["mid", "id", "username",'truename',"mycode","isactivate","iseal","invitename","hcg_wa","cash_wa","care_wa",'total_award',"created_at","action"],
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
        "hcg" => [
            "title" => "拨发积分",
            "icon" => "setting",
            "options" => [
                "class" => "hcg-Data-Mulit"
            ]
        ],
        "reducehcg" => [
            "title" => "扣除积分",
            "icon" => "setting",
            "options" => [
                "class" => "reducehcg-Data-Mulit"
            ]
        ],
        "care" => [
            "title" => "拨发推广收益",
            "icon" => "setting",
            "options" => [
                "class" => "care-Data-Mulit"
            ]
        ],
        "reducecare" => [
            "title" => "扣除推广收益",
            "icon" => "setting",
            "options" => [
                "class" => "reducecare-Data-Mulit"
            ]
        ],
    ]
]);
//操作按钮
//echo common\widgets\Toolbar::widget([
//    "buttons" => [
//    ]
//]);
$this->beginBlock('regist-list');
?>
    var p = new Base.tablist();
<!--    拨积分操作-->
    $(".hcg-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
        p.updateMulit({
            url: "<?php echo Url::toRoute("hcg"); ?>",
            message: '<b>拨给数量：</b><input type="text" value="100" name="score" style="border:1px solid #ccc;line-height:30px;"/><br />您确定要拨发积分操作？<br /><b>拨发说明：</b><input type="text" placeholder="请填写拨发说明" name="scoree" style="border:1px solid #ccc;line-height:30px;"/><br /><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
            self: $(this)
        });
    });
<!--    扣除积分操作-->
    $(".reducehcg-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
        p.updateMulit({
        url: "<?php echo Url::toRoute("reducehcg"); ?>",
        message: '<b>扣除数量：</b><input type="text" value="100" name="score" style="border:1px solid #ccc;line-height:30px;"/><br />您确定要扣除积分操作？<br /><b>扣除说明：</b><input type="text" placeholder="请填写扣除说明" name="scoree" style="border:1px solid #ccc;line-height:30px;"/><br /><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
        self: $(this)
        });
    });
<!--    拨推广收益操作-->
    $(".care-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
        p.updateMulit({
        url: "<?php echo Url::toRoute("care"); ?>",
        message: '<b>拨给数量：</b><input type="text" value="100" name="score" style="border:1px solid #ccc;line-height:30px;"/><br />您确定要拨推广收益操作？<br /><b>拨发说明：</b><input type="text" placeholder="请填写拨发说明" name="scoree" style="border:1px solid #ccc;line-height:30px;"/><br /><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
        self: $(this)
        });
    });
<!--    扣除推广收益操作-->
    $(".reducecare-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
        p.updateMulit({
        url: "<?php echo Url::toRoute("reducecare"); ?>",
        message: '<b>扣除数量：</b><input type="text" value="100" name="score" style="border:1px solid #ccc;line-height:30px;"/><br />您确定要扣除推广收益操作？<br /><b>扣除说明：</b><input type="text" placeholder="请填写扣除说明" name="scoree" style="border:1px solid #ccc;line-height:30px;"/><br /><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
        self: $(this)
        });
    });
<!--    拨自由区操作-->
    $(".free-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
        p.updateMulit({
        url: "<?php echo Url::toRoute("free"); ?>",
        message: '<b>拨给数量：</b><input type="text" value="100" name="score" style="border:1px solid #ccc;line-height:30px;"/><br />您确定要拨自由区操作？<br /><b>拨发说明：</b><input type="text" placeholder="请填写拨发说明" name="scoree" style="border:1px solid #ccc;line-height:30px;"/><br /><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
        self: $(this)
        });
    });


<!--    扣除自由区操作-->
    $(".reducefree-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
        p.updateMulit({
        url: "<?php echo Url::toRoute("reducefree"); ?>",
        message: '<b>扣除数量：</b><input type="text" value="100" name="score" style="border:1px solid #ccc;line-height:30px;"/><br />您确定要扣除自由区操作？<br /><b>扣除说明：</b><input type="text" placeholder="请填写扣除说明" name="scoree" style="border:1px solid #ccc;line-height:30px;"/><br /><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
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