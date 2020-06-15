<?php

/**
 * @author shuang
 * @date 2016-6-30 19:25:30
 */
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\components\MTools;

$auth = MTools::getAdministratorPrivileges();
?>
<header id="top_header">
    <div class="topleft">
        <a href="<?php echo Url::toRoute("site/index"); ?>"><img src="/images/logo.png" alt="系统首页" /></a>
    </div>
<!--    <nav id="top_nav">
        <ol>
            <?php //foreach (common\components\MTools::$setHeaderMenu as $headerMenu): ?>
                <?php //if (!$auth || in_array(str_replace("/", "-", ArrayHelper::getValue($headerMenu, "url")), $auth)): ?>
                    <li>
                        <a href="<?php //echo Url::toRoute(ArrayHelper::getValue($headerMenu, "url")); ?>" class="<?php //echo $shorttype === ArrayHelper::getValue($headerMenu, "shorttype") ? "selected" : null; ?>">
                            <img title="<?php //echo ArrayHelper::getValue($headerMenu, "title"); ?>" src="<?php //echo ArrayHelper::getValue($headerMenu, "icon"); ?>" />
                            <h5><?php //echo ArrayHelper::getValue($headerMenu, "title"); ?></h5>
                        </a>
                    </li>
                <?php //endif; ?>
            <?php //endforeach; ?>
        </ol>
    </nav>-->
    <aside>
        <ul>
            <li><a href="javascript:;"><span class="helpimg"></span>帮助</a></li>
            <li><a href="<?php echo Url::toRoute(["site/logout"]); ?>">退出</a></li>
        </ul>
        <div class="user">
            <span><?php echo Yii::$app->user->identity->username; ?></span>
            <i>消息</i>
            <b>5</b>
        </div>    
    </aside>
</header>