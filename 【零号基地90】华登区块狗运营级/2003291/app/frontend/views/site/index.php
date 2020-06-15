<?php

use yii\helpers\Url;

$this->beginPage();
?>
<style>
    .swiper-container {
        width: 100%;
        height: 13%;
    }

    .swiper-container img {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        width: 100% !important;
        margin-right: 0 !important;
    }
</style>
<section>
    <!--导航栏、扫码模块-->
    <div class="am-g homenav">
        <div id="mydiv" style="height: 250px;position: absolute;top: 0;left: 0;right: 0;width:100%;"></div>
        <div class="am-u-sm-2">
            <img src="/<?php echo $user->userprofile->icon != '' ? $user->userprofile->icon : 'img/header.png'; ?>" class="homeheader">
        </div>
        <div class="am-u-sm-8">
            <p><?php echo Yii::t('app', '用户名'); ?>：<?php echo $user->username ?></p>
            <p class="creditQ"><?php echo Yii::t('app', '信用'); ?>&nbsp;<span style="color:red;">
                    <?php
                      echo $user['start'];
//                    $n = $user['start'];
//                    for ($i = 0; $i < $n; $i++) {
//                        echo "❤";
//                    }
                    ?>
                </span>
            </p>
        </div>
        <div class="am-u-sm-2">
            <a href="/user/set.html"><img src="/img/shezhi.png" class="homeheader1"></a>
        </div>
        <div align="center" class="am-u-sm-12">
            <a href="XLSchemes://scanQrcode" >
                <img src="/img/saomazhifu.png" class="homeheader2">
            </a>
            <p class="payQ"><?php echo Yii::t('app', '扫&nbsp;码&nbsp;支&nbsp;付'); ?></p>
        </div>

        <div align="center" class="am-u-sm-4 top">
            <span><?php echo Yii::t('app', '卢宝'); ?></span><br />
            <span><?php echo $user->wallet->cash_wa ?></span>
        </div>
        <div align="center" class="am-u-sm-4 top1">
            <span><?php echo Yii::t('app', '卢呗'); ?></span><br />
            <span><?php echo $user->wallet->hcg_wa ?></span>
        </div>
        <div align="center" class="am-u-sm-4 top1">
            <span><?php echo Yii::t('app', 'LKC'); ?></span><br />
            <span><?php echo $user->wallet->care_wa ?></span>
        </div>
    </div>
    <!--轮播图-->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ($img_src as $item): ?>
            <div class="swiper-slide">
                <img src="<?php   echo $item['src']; ?>">
            </div>
            <?php endforeach; ?>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination" style="margin-top: 100px;bottom:0;"></div>
    </div>

    <!--图标模块-->
    <div class="am-g turn-1">
        <div align="center" class="am-u-sm-3">
            <a href="/register/send.html"><img src="/img/send.png" ><br/> 
                <?php echo Yii::t('app', '转出'); ?>
            </a>
        </div>
        <div align="center" class="am-u-sm-3">
            <a href="/profile/sendin.html"><img src="/img/sendin.png"><br/> 
                <?php echo Yii::t('app', '转入'); ?>
            </a>
        </div>
        <div align="center" class="am-u-sm-3">
            <a href="/trade/buying.html"><img src="/img/mr.png"><br/> 
                <?php echo Yii::t('app', '买入'); ?>
            </a>
        </div>
        <div align="center" class="am-u-sm-3">
            <a href="/trade/selling.html"><img src="/img/mc.png"><br/> 
                <?php echo Yii::t('app', '卖出'); ?>
            </a>
        </div>
        <div align="center" class="am-u-sm-3">
            <a href=""><img src="/img/zhongchou2x.png"><br/> 
                <?php echo Yii::t('app', '公益'); ?>
            </a>
        </div>
        <div align="center" class="am-u-sm-3">
            <a href=""><img src="/img/yule2.png"><br/> 
                <?php echo Yii::t('app', '娱乐'); ?>
            </a>
        </div>
        <div align="center" class="am-u-sm-3">
            <a href=""><img src="/img/bianmin2.png"><br/> 
                <?php echo Yii::t('app', '便民'); ?>
            </a>
        </div>
        <div align="center" class="am-u-sm-3">
            <a href="http://mall.yinweidao.cn"><img src="/img/shangdian.png"><br/>
                <?php echo Yii::t('app', '商店'); ?>
            </a>
        </div>
    </div>

    <div class="guanggaobo">
        <marquee class="bo-content" hspace="20">
            <?php echo Yii::t('app', '致敬Goldlink事业伙伴们：GL集团收购了BLB公司的消费返利项目，为了BLB会员原始利益不受损失，现GL集团进行原始购入数字核对清算
            并对充GL资产。1.购入价格来对换GL现在原始价格对充。2.注册和对充事务找直推上级核对咨询。3.GL排单上线时间2018.5.16日开始注册完毕并开始拨B激活主帐号。4.
            GL排单上线时间2018.5.16日开始上市。5.GL卢呗原始首发价为1.99元。6.正式上线应用时间2018.5.16日启航。'); ?>


        </marquee>
    </div>
    <div class="guanggaobo1"></div>

    <div class="am-g turn-2">
        <div align="center" class="am-u-sm-4"  style="display: none;" id="wei">
            <a href="/">
                <img src="/img/diansy.png">
                <br/>
                <span style="color:#F7CA4B ;"><?php echo Yii::t('app', '首页'); ?></span>
            </a>
        </div>

        <div align="center" class="am-u-sm-4" id="dian">
            <img src="/img/diansy.png"><br/>
            <span style="color:#F7CA4B ;"><?php echo Yii::t('app', '首页'); ?></span>
        </div>

        <div align="center" class="am-u-sm-4" id="chan">
            <a href="/trade/assets.html">
                <img src="/img/weizc.png"><br/>
                <span><?php echo Yii::t('app', '资产'); ?></span>
            </a>
        </div>

        <div align="center" class="am-u-sm-4" style="display: none;" id="zi">
            <img src="/img/dianzc.png"><br/>
            <span style="color:#F7CA4B ;"><?php echo Yii::t('app', '资产'); ?></span>
        </div>

        <div align="center" class="am-u-sm-4" id="my">
            <a href="/user/mycontent.html">
                <img src="/img/weiwo.png"><br/>
                <span><?php echo Yii::t('app', '我的'); ?></span>
            </a>
        </div>

        <div align="center" class="am-u-sm-4" style="display: none;" id="self">
            <img src="/img/dianwd.png"><br/>
            <span style="color:#F7CA4B ;"><?php echo Yii::t('app', '我的'); ?></span>
        </div>
    </div>

    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="/js/jquery.min.js"></script>
<!--    <script type="text/javascript" src="/js/canvas-particle.js"></script>-->
    <!--<![endif]-->
    <script src="/js/amazeui.min.js"></script>
    <script src="/js/swiper-3.3.1.min.js"></script>
    <script src="/js/home.js"></script>
    <script>
        function scanQrcodeRes(str) {
            // document.getElementById('str').innerText = str;
            location.href = str;
        }
    </script>
</section>
