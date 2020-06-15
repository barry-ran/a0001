<?php

use yii\helpers\Url; ?>
<a href="javascript:;" class="Logo Logo2"><img src="/images/105.png" /></a>
<div class="Tray">
    <h1 class="NavName showInMobi"><strong class="ng-binding"></strong><a class="iF NavMenu"></a></h1>
    <ul class="navs">
        <li class="nav on">
            <a href="<?php echo Url::toRoute(["site/index"]); ?>">首页</a>
        </li>
        <li class="nav false">
            <a href="<?php echo Url::toRoute(["user/index"]); ?>">基本信息</a>
        </li>
    </ul>
    <?php if (!Yii::$app->user->isGuest): ?>
        <ul class="navs2">
            <li class="nav2 navnick">
                <a href="javacript:;" class="unick"><i class="iF iF-user ng-binding"><?php echo Yii::$app->user->identity->username; ?></i></a>
            </li>
            <li class="nav2">
                <a href="<?php echo Url::toRoute(["site/logout"]); ?>" target="_self">退出登录</a>
            </li>
        </ul>
    <?php else: ?>
        <ul class="navs2">
            <li class="nav2">
                <a href="<?php echo Url::toRoute(["site/login"]); ?>">登录</a>
            </li>
            <li class="nav2">
                <a href="<?php echo Url::toRoute(["site/signup"]); ?>">注册</a>
            </li>
        </ul>
    <?php endif; ?>
</div>