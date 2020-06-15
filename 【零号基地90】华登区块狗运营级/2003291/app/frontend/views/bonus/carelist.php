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
            <?php echo Yii::t('app', '激活码'); ?>
        </a>
    </h1>
</header>

<div class="am-g">
    <div class="am-u-sm-12" style="padding-left: 0;padding-right: 0;">

        <div class="name" style="height: 180px;">
            <div class="name-1">
                <div class="nick">
                    <img src="/img/mubisendout.png">&nbsp;
                    <span><?php echo Yii::t('app', '购买'); ?><?php echo Yii::t('app', '通链'); ?></span>

                    <div class="am-header-left am-header-nav right">
                        <a href="<?php echo Url::toRoute(["profile/addcare"]); ?>" class="" style="color: #c1bebe; font-size: 13px;">
                            <img src="/img/youjiantou.png">
                        </a>
                    </div>
                    <div class="right"><span></span></div>
                </div>
            </div>
            <div class="name-2">
                <div class="nick">
                    <img src="/img/sonnum.png">&nbsp;
                    <span><?php echo Yii::t('app', '向平台购买通链记录'); ?></span>
                    <div class="am-header-left am-header-nav right">
                        <a href="<?php echo Url::toRoute(["/profile/mycareorder"]); ?>" class="" style="color: #c1bebe; font-size: 13px;">
                            <img src="/img/youjiantou.png">
                        </a>
                    </div>
                    <div class="right"><span></span></div>
                </div>
            </div>
            <div class="name-2">
                <div class="nick">
                    <img src="/img/sonnum.png">&nbsp;
                    <span><?php echo Yii::t('app', '定存通链'); ?></span>
                    <div class="am-header-left am-header-nav right">
                        <a href="<?php echo Url::toRoute(["profile/freezecare"]); ?>" class="" style="color: #c1bebe; font-size: 13px;">
                            <img src="/img/youjiantou.png">
                        </a>
                    </div>
                    <div class="right"><span></span></div>
                </div>
            </div>
        </div>

    </div>
</div>
