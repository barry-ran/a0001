<?php

/**
 * @author shuang
 * @date 2016-11-7 18:53:59
 */
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN" class="ACCOUNT">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <?= Html::csrfMetaTags() ?>
        <title><?php echo Yii::t("app", $this->title); ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php echo $this->render("//layouts/prompt"); ?>
        <?php //echo $this->render("header"); ?>
        <?php //echo $this->render("left"); ?>
        <?php echo $content; ?>
    </div>
    <?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>
</html>
