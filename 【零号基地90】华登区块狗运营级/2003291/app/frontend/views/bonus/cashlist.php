<?php

use yii\helpers\Url;
?>
<header data-am-widget="header" class="am-header am-header-default" style="height: 8%;background-color:#F7CA4B;">
    <div class="am-header-left am-header-nav">
        <a href="/" class="">
            <img src="/img/jiantouzuo.png">
        </a>
    </div>

    <h1 class="am-header-title">
        <a href="#" class="">
            <?php echo Yii::t('app', '卢宝'); ?>
        </a>
    </h1>
</header>

<div class="am-g">
    <div class="am-u-sm-12" style="padding-left: 0;padding-right: 0;">

        <div class="name" style="height: 180px;">
            <div class="name-2">
                <div class="nick">
                    <img src="/img/mubisendout.png">&nbsp;
                    <span><?php echo Yii::t('app', '卢宝');?> <?php echo Yii::t('app', '转换');?> <?php echo Yii::t('app', '卢呗'); ?></span>

                    <div class="am-header-left am-header-nav right">
                        <a href="<?php echo Url::toRoute(["profile/conver"]); ?>" class="" style="color: #c1bebe; font-size: 13px;">
                            <img src="/img/youjiantou.png">
                        </a>
                    </div>
                    <div class="right"><span></span></div>
                </div>
            </div>
            <div class="sonacount">
                <div class="nick">
                    <img src="/img/sonnum.png">&nbsp;
                    <span><?php echo Yii::t('app', '购买加速器'); ?></span>
                    <div class="am-header-left am-header-nav right">
                        <a href="<?php echo Url::toRoute(["register/allcar"]); ?>" class="" style="color: #c1bebe; font-size: 13px;">
                            <img src="/img/youjiantou.png">
                        </a>
                    </div>
                    <div class="right"><span></span></div>
                </div>
            </div>
        </div>

    </div>
</div>
