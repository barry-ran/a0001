<?php

/**
 * @author shuang
 * @date 2016-12-9 23:55:25
 */
use yii\helpers\Url;
?>
<section class="content">
    <header data-am-widget="header" class="am-header am-header-default" style="height: 8%;background-color: #F7CA4B;">
        <div class="am-header-left am-header-nav">
            <a href="javascript:history.go(-1);" class="">
                <i class="am-header-icon am-icon-angle-left"></i>
            </a>
        </div>

        <h1 class="am-header-title">
            <a href="#title-link" class="">
                公告
            </a>
        </h1>
    </header>

    <div class="am-g">
        <div class="am-u-sm-12" style="padding-left: 0px;padding-right: 0px;">
            <?php foreach ($data as $item): ?>
            <div class="notice">
                <p class="notice1"><?php echo $item["title"]; ?></p>
                <p class="time"><?php echo Yii::$app->formatter->asDate($item["created_at"]); ?></p>
                <div class="am-header-left am-header-nav right1">
                    <a href="<?php echo Url::toRoute(["article/detail", "id" => $item["id"]]); ?>" class="" style="color: #c1bebe; font-size: 13px;">
                        <i class="am-header-icon am-icon-angle-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="pagination" style="float:right;font-size: 1.1rem">
        <?php
        echo
        \yii\widgets\LinkPager::widget([
            'pagination' => $pager,
            'nextPageLabel' => '下一页',
            'prevPageLabel' => '上一页',
        ]);
        ?>
    </div>
</section>
