<?php
/*
 * file : prompt
 * author: shuang
 * email : shuangbrother@126.com
 * created_at : 2015-12-15 -- 16:56:05
 */
if (Yii::$app->getSession()->hasFlash('success')):
?>
<div class="alert alert-success fade in">
    <button class="close" data-dismiss="alert">×</button>
    <i class="fa-fw fa fa-times-circle"></i><?php echo Yii::$app->getSession()->getFlash('success'); ?>
</div>
<?php Yii::$app->getSession()->setFlash('success', null); ?>
<?php endif; ?>
<?php
if (Yii::$app->getSession()->hasFlash('error')):?>
<div class="alert alert-danger fade in">
    <button class="close" data-dismiss="alert">×</button>
    <i class="fa-fw fa fa-times-circle"></i><?php echo Yii::$app->getSession()->getFlash('error'); ?>
</div>
<?php Yii::$app->getSession()->setFlash('error', null); ?>
<?php endif;?>