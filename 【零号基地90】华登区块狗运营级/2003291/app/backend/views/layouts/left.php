<?php

/**
 * @author shuang
 * @date 2016-6-30 19:26:43
 */
use yii\helpers\Url;
$data = common\components\MTools::getAuthMenu();
?>
<section id="leftmenu">
    <div class="lefttop">
        <span></span>
        管理菜单
    </div>
    <nav id="left_nav">
        <ol>
            <?php foreach ($data["menu"] as $var): ?>
                <li>
                    <div class="title">
                        <span><img src="/images/leftico02.png" alt=""/></span>
                        <?php echo $var["title"]; ?>           
                    </div>
                    <ul>
                        <?php foreach ($var["son"] as $val): $curoute = strtolower($var["controller"]) . "/" . strtolower($val["url"]); ?>
                            <li class="<?php echo $curoute === $route ? "active" : null ?>">
                                <span></span>
                                <a href="<?php echo Url::toRoute([$curoute]); ?>"><?php echo $val["title"]; ?></a>
                                <i></i>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ol>
    </nav>
</section>