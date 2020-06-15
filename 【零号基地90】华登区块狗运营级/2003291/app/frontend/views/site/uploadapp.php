<?php

use yii\helpers\Url;
?>
<section class="content">
    <header data-am-widget="header" class="am-header am-header-default" style="height: 8%;background-color: #2e2e2d;">
<!--        <div class="am-header-left am-header-nav">-->
<!--            <a href="javascript:history.go(-1);" class="">-->
<!--                <img src="/img/jiantouzuo.png">-->
<!--            </a>-->
<!--        </div>-->
    </header>
    <div class="h-roll">
        <p><?php echo Yii::t('app', '扫一扫'); ?></p>
        <div class="h-roll1">

            <img src="/img/uploadimg.png" style="width:100%;"/>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <!--<![endif]-->
    <script src="../js/amazeui.min.js"></script>

</section>
