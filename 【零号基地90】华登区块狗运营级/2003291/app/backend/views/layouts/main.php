<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use backend\models\MY_Mgmt;
$menu = MY_Mgmt::setActivePlace($this->context->module->requestedRoute);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>管理系统</title>
        <?php $this->head() ?>
    </head>
    <body style="overflow-x:hidden">
        <?php $this->beginBody() ?>
        <?php echo $this->render("header",["shorttype"=>$menu["shorttype"]]); ?>
        <?php echo $this->render("left",["route"=>$menu["route"]]); ?>
        <section  id="content">
            <?php if($menu["breadcrumbs"]):?>
            <div class="place">
                <span>位置：</span>
                <?=
                Breadcrumbs::widget([
                    'links' => $menu['breadcrumbs'] ? $menu['breadcrumbs'] : [],
                    "options" => ["class" => "placeul"],
                    "homeLink" => false
                ])
                ?>
            </div>
            <?php endif;?>
            <artcile id="cont_artcile">
                <?php echo $content; ?>
            </artcile>
        </section>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>