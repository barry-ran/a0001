<?php

use yii\helpers\Url;
?>
<div class="Nav">
    <div class="navs1">
        <a href="<?php echo Url::toRoute(["site/index"]); ?>" class="nav1">首页</a>
        <a href="<?php echo Url::toRoute(["trade/send"]); ?>" class="nav1">转账</a>
        <a href="<?php echo Url::toRoute(["trade/selling"]); ?>" class="nav1">我的交易</a>
        <a href="<?php echo Url::toRoute(["trade/tradecenter"]); ?>" class="nav1">交易大厅</a>
        <a href="<?php echo Url::toRoute(["bonus/actuser"]); ?>" class="nav1">激活账号</a>
        <a href="<?php echo Url::toRoute(["trade/history"]); ?>" class="nav1">财务明细</a>
        <a href="<?php echo Url::toRoute(["profile/upgrade"]); ?>" class="nav1">原点升级</a>
        <a href="<?php echo Url::toRoute(["profile/conver"]); ?>" class="nav1">卢呗转换</a>
        <a href="javascript:;" class="nav1">游戏</a>
        <a href="<?php echo Url::toRoute(["user/shares"]); ?>" class="nav1">我的分享</a>
        <a href="<?php echo Url::toRoute(["site/transfertosubaccount"]); ?>" class="nav1">转账给子账号</a>
        <a href="javascript:;" class="nav1 showInMobi">基本信息</a>
        <a href="<?php echo Url::toRoute(["site/logout"]); ?>" target="_self" class="nav1 showInMobi">退出登录</a>
    </div>
</div>
