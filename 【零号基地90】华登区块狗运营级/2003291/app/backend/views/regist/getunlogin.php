<?php

/**
 * @author shuang
 * @date 2016-12-7 10:12:13
 */
use yii\helpers\Url;
use common\widgets\DatalistWidgets;
use common\components\MTools;

$userprofileLabels = new backend\models\MY_UserProfile();
$userwalletLabels = new backend\models\MY_UserWallet();
$labels = \yii\helpers\ArrayHelper::merge($labels, [
    "id" => $userprofileLabels->attributeLabels()["userid"],
    //"truename" => $userprofileLabels->attributeLabels()["truename"],
//    "permanent_wa" => $userwalletLabels->attributeLabels()["permanent_wa"],
//    "free_wa" => $userwalletLabels->attributeLabels()["free_wa"],
    "cash_wa" => $userwalletLabels->attributeLabels()["cash_wa"],
    "up_referrer_id" => $userprofileLabels->attributeLabels()["up_referrer_id"],
    "down_team_id" => $userprofileLabels->attributeLabels()["down_team_id"],
    "invitename" => "推荐人",
    'grade_name'=>'会员等级',
]);
//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
?>
    <div id="toolbar">
        <div class="form-inline" role="form">
<!--            <div class="form-group">-->
<!--                --><?php
//                $b = [];
//                $d["id"] ="1";
//                $d["name"] ="上级成员";
//                $f["id"] ="2";
//                $f["name"] ="下级成员";
//                array_push($b,$d,$f);
//                echo yii\helpers\Html::dropDownList("type", null, yii\helpers\ArrayHelper::merge(["" => "上级/下级"], yii\helpers\ArrayHelper::map($b, "id", "name")), ["class" => "selectpicker"]); ?>
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <input name="search" class="form-control" type="text" placeholder="用户名或ID或手机号">-->
<!--            </div>-->
<!--            <button id="ok" type="submit" class="btn btn-primary">查 询</button>-->
        </div>
    </div>
    <style>
        .tipinfo>span{display: none !important;}
        .tip {height:550px;}
    </style>
<?php
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute(["regist/ajaxunloginlist"]),
    "labels" => $labels,
    "columns" => ["id", "username", "grade_name", "isactivate", "iseal", "invitename","up_referrer_id","down_team_id", "cash_wa", "created_at", "last_login_at", "login_ip"],
    "tableOtherAttributes" => [
        "data-sort-name" => "updated_at",
        "data-toolbar" => "#toolbar",
        "data-query-params" => "queryParams",
        "data-click-to-select" => "true"
    ],
    "toolbar" => "#toolbar",
    "fieldAttributes" => [
        "id" => ["data-sortable" => "true"],
    ]
]);

//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "batchunloginsuspend" => [
            "title" => "批量封号",
            "icon" => "setting",
            "options" => [
                "class" => "suspend-Data-Mulit"
            ]
        ],
        "batchunloginrelease" => [
            "title" => "批量解封",
            "icon" => "setting",
            "options" => [
                "class" => "release-Data-Mulit"
            ]
        ],
    ]
]);
//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
    ]
]);
$this->beginBlock('regist-list');
?>

    var p = new Base.tablist();
    $(".suspend-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
    p.updateMulit({
    url: "<?php echo Url::toRoute("batchunloginsuspend"); ?>",
    message: '<b>需要封号处理的id：</b><br /><textarea type="text" name="ids" style="border:1px solid #ccc;line-height:30px;"/><label style="color:red;">若要连同查询ID一同批量封号，请在开头或结尾处输入查询ID以-连接, <br />例如查询ID为6的，下级成员ID线为7-8-9-10，则如下所示6-7-8-9-10</label><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
    self: $(this)
    });
    });

    $(".release-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
    p.updateMulit({
    url: "<?php echo Url::toRoute("batchunloginrelease"); ?>",
    message: '<b>需要解封的id：</b><br /><textarea type="text" name="ids" style="border:1px solid #ccc;line-height:30px;"/><label style="color:red;">若要连同查询ID一同批量解封，请在开头或结尾处输入查询ID以-连接, <br />例如查询ID为6的，下级成员ID线为7-8-9-10，则如下所示6-7-8-9-10</label><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />',
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
    function send_code(type){
    var num = $("*[name='score']").val();

    $.ajax({
    type: "post",
    data: {type:type,num:num},
    dataType: "json",
    url: "/regist/batchsuspend.html",
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