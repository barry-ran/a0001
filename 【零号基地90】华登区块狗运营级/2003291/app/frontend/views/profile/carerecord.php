<?php

use yii\helpers\Url;
?>
<section class="content">
    <header data-am-widget="header" class="am-header am-header-default" style="height: 8%;background-color:#F7CA4B;">
        <div class="am-header-left am-header-nav">
            <a href="javascript:history.back(-1);" class="">
                <img src="/img/jiantouzuo.png">
            </a>
        </div>

        <h1 class="am-header-title">
            <a href="#title-link" class="">
                <?php echo $type==1?Yii::t('app', '转入记录'):Yii::t('app', '转出记录'); ?>
            </a>
        </h1>
    </header>

    <div class="am-g">
        <div align="center" class="am-u-sm-5 Nubtime"><?php echo $type==1?Yii::t('app', '转入账号'):Yii::t('app', '转出账号'); ?></div>
        <div align="center" class="am-u-sm-3 Nubtime"><?php echo Yii::t('app', '数量'); ?></div>
        <div align="center" class="am-u-sm-4 Nubtime"><?php echo Yii::t('app', '时间'); ?></div>
    </div>

    <?php foreach ($res['data'] as $item): ?>
    <div class="am-g Nubtime1">
        <div align="center" class="am-u-sm-5"><?php echo $item['username'] ?></div>
        <div align="center" class="am-u-sm-3"><?php echo $item['amount']?></div>
        <div align="center" class="am-u-sm-4">
            <p class="time1"><?php echo date("Y-m-d",$item['created_at']); ?></p>
        </div>
        <hr data-am-widget="divider" style="" class="am-divider am-divider-default wrie" width="90%"/>	
    </div>
    <?php endforeach; ?>
    
    <div class="pagination">
        <?php echo common\components\SLinkPager::widget([
                'pagination' => $res['pager'],
                'firstPageLabel' => Yii::t("app", "首页"),
                'nextPageLabel' => Yii::t("app", "下一页"),
                'prevPageLabel' => Yii::t("app", "上一页"),
                'lastPageLabel' => Yii::t("app", "末页"),
                "hideOnSinglePage" => false
            ]);
        ?>
    </div>

    <!--[if lt IE 9]>
    <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="assets/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->

    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="/js/jquery.min.js"></script>
    <!--<![endif]-->
    <script src="/js/amazeui.min.js"></script>
    <script src="/js/interactive.js"></script>
</section>




