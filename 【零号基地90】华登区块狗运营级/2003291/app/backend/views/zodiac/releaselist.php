<?php

use yii\helpers\Url;
use common\widgets\DatalistWidgets;
$labels = \yii\helpers\ArrayHelper::merge($labels, [
    "belong_name" => "所属用户",
    "due" => "周期",
]);
//添加操作提示模板
echo $this->render("/layouts/prompt", array("labels" => $labels));
//调用数据列表模板
echo DatalistWidgets::widget([
    'data_url' => Url::toRoute("zodiac/ajaxreleaselist"),
    "labels" => $labels,
    "columns" => ["mid","id","zodiac_name","hcg","issel","belong_name","due", "created_at"],
    "toolbar" => "#toolbar",
    "tableOtherAttributes" => ["data-click-to-select" => "true"],
    "fieldAttributes" => [
        "mid" => [
            "data-checkbox" => "true",
        ]
    ]
]);

//操作按钮
echo common\widgets\Toolbar::widget([
    "buttons" => [
        "releasezodiac" => [
            "title" => "拆分产品",
            "icon" => "setting",
            "options" => [
                "class" => "releasezodiac-Data-Mulit"
            ]
        ],
    ]
]);
$this->beginBlock('regist-list');
?>

    var p = new Base.tablist();
    $(".releasezodiac-Data-Mulit").attr("href","javascript:;").bind("click", function (e) {
        p.updateMulit({
            url: "<?php echo Url::toRoute("releasezodiac"); ?>",
            message:
                `<b>价格：</b><input type="text" value="100" name="score" style="border:1px solid #ccc;line-height:30px;"/><br />您确定要拆分操作？<br /><b>拆分说明：</b><input type="text" placeholder="请填写拆分说明" name="scoree" style="border:1px solid #ccc;line-height:30px;"/><br /><div style="width: 300px;color:red;">例如：所选的宠物价格是250,输入140，则把宠物拆分成价格140和110的两个宠物，如果宠物剩余价格或输入的数值不在任何一种宠物的价格范围则不拆分宠物。</div><br /><input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo Yii::$app->request->getCsrfToken();?>" />`,
            self: $(this)
        });
    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['regist-list'], \yii\web\View::POS_END); ?>
