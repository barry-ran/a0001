<?php
/*
 * file : prompt
 * author: shuang
 * email : shuangbrother@126.com
 * created_at : 2015-12-15 -- 16:56:05
 */
use yii\bootstrap\Alert;
if (Yii::$app->getSession()->hasFlash('success')) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-success', //这里是提示框的class
        ],
        'body' => Yii::$app->getSession()->getFlash('success'), //消息体
    ]);
}
if (Yii::$app->getSession()->hasFlash('error')) {
    $errors = Yii::$app->getSession()->getFlash('error');
    $str = "";
    if (is_array($errors)) {
        foreach ($errors as $field => $value) {
            $str .= $labels[$field] . ":" . implode("、", $value) . '<br />';
        }
    } else {
        $str = $errors;
    }
    echo Alert::widget([
        'options' => [
            'class' => 'alert-warning',
        ],
        'body' => $str,
    ]);
}
?>
<?php $this->registerJs('var $div = $(".alert-success,.alert-warning");$div.animate({opacity: 0}, 5000, "swing", function () {$div.remove();});'); ?>