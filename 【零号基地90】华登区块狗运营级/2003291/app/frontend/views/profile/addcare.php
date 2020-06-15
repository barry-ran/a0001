<?php

use yii\helpers\Url;
?>
<!DOCTYPE html>
<html style="overflow: visible;background: #F1F1F1;">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title><?php echo Yii::t('app', '众筹'); ?></title>
        <link rel="stylesheet" href="/css/amazeui.min.css" />
        <link rel="stylesheet" href="/css/common222.css" />
        <!--<link rel="stylesheet" href="/css/resetTable.css" />-->
        <style>
            .content {
                height: 100%;
                /* background-color: #2e2e2d; */
                width: calc(100%);
                position: absolute;
                top: 0;
                /*overflow: auto;*/
            }
            body{
                overflow: visible;
            }
        </style>
    </head>

    <body style="background-color: #F1F1F1;">
        <div class="content" >
            <div class="am-g">

                <div class="am-u-sm-12 pad0">
                    <div class="am-u-sm-12 pad0" id="tit" style="background-color: white;padding:8px 0;">
                        <a href="<?php echo Url::toRoute(["profile/addcare", "status" => 1]); ?>">
                            <div class="am-u-sm-4 am-text-center active" data-id="t1">
                                <img src="<?php echo $status==1?'/img/yurezhong-xuan.png':'/img/yurezhong-wei.png'; ?>" width="20px"/>
                                <p class="mar0" style="color:<?php echo $status==1?'#1e88e5;':'#b3b3b3'; ?>" >
                                    <?php echo Yii::t('app', '预热中');?>
                                </p>
                            </div>
                        </a>
                        <a href="<?php echo Url::toRoute(["profile/addcare", "status" => 2]); ?>">
                            <div class="am-u-sm-4 am-text-center" data-id="t2" style="<?php echo $status==2?'color:#1e88e5;;':''; ?>">
                                <img src="<?php echo $status==2?'/img/jinxing-xuan@2x.png':'/img/jinxing-wei@2x.png'; ?>"height="20px"/>
                                <p class="mar0" style="color:<?php echo $status==2?'#1e88e5;':'#b3b3b3'; ?>;"><?php echo Yii::t('app', '进行中');?></p>
                        </div>
                        </a>
                        <a href="<?php echo Url::toRoute(["profile/addcare", "status" => 3]); ?>">
                            <div class="am-u-sm-4 am-text-center" data-id="t3" style="<?php echo $status==3?'color:#1e88e5;':''; ?>">
                                <img src="<?php echo $status==3?'/img/jieshu-xuan.png':'/img/jieshu-wei.png'; ?>" width="20px"/>
                                <p class="mar0" style="color:<?php echo $status==3?'#1e88e5;':'#b3b3b3'; ?>;"><?php echo Yii::t('app', '已结束');?></p>
                            </div>
                        </a>
                    </div>
                    <div style="clear: both;height:10px;"></div>
                        <div class="accordion">
                            <a href="/profile/mycareorder.html">
                                <div class="headerUser">
                                    <span class="headerName fr" style="vertical-align: middle;
                                    height: 24px;line-height: 24px;display: inline-block;padding-right: 5px;
                                   color:#1e88e5;">
                                        <?php echo Yii::t('app', '记录'); ?></span>
                                </div>
                            </a>
                        </div>
                    <div class="am-u-sm-12 pad0" id='con' style="background-color:white;border-radius: 5px;">
                        <?php foreach ($all_sell_care as $item): ?>
                        <div class="am-u-sm-12 pad10_0" id="t1">
                            <div class="am-u-sm-12">
                                <div class="am-u-sm-2 pad0">
                                    <img src="<?php echo $item['img']; ?>" width="100%"/>
                                </div>
                                <div class="am-u-sm-6">
                                    <h3 class="pad0 mar0" style="color:#333;"><?php echo Yii::t('app', 'LKC');?></h3>
                                    <p class="mar0 fz10 color-gray" style="color:#333;"><?php echo Yii::t('app', '每个id限购');?>： <?php echo $buy_limit; ?> <?php echo Yii::t('app', '枚');?></p>
                                    <p class="mar0 fz10 color-gray"style="color:#ddd;"><?php echo Yii::t('app', '接受币种');?>：
                                        <span class="fw fz12 color-bla"style="color:#333;"><?php echo Yii::t('app', '卢宝');?></span>
                                    </p>
                                </div>
                                <div class="am-u-sm-4 pad0">
                                    <img src="/img/naozhong.jpg" width="15px" height="15px"style="margin-top:-4px;"/>
                                    <span class="fz10" style="color:#1e88e5;"><?php echo Yii::$app->formatter->asDate($item["sell_time"]); ?></span> 
                                </div>
                            </div>
                            <div class="am-u-sm-12 mar10 pt10">
                                <div class="am-u-sm-4">
                                    <p class="mar0 pad0 color-gray" style="color:#ddd;"><?php echo Yii::t('app', '众筹规模');?></p>
                                    <p class="mar0 pad0"style="color:#333;"><?php echo $item["sell_num"]; ?></p>
                                </div>
                                <div class="am-u-sm-4 am-text-center">
                                    <p class="mar0 pad0 color-gray" style="color:#ddd;"><?php echo Yii::t('app', '价格');?></p>
                                    <p class="mar0 pad0"style="color:#333;">1 <?php echo Yii::t('app', '通链');?>=<?php echo $status==1?'?':$price; ?></p>
                                </div>
                                <div class="am-u-sm-4 am-text-right">
                                    <p class="mar0 pad0 color-gray" style="color:#ddd;"><?php echo Yii::t('app', '剩余时间');?></p>
                                    <p class="mar0 pad0 color-red"style="color:#1e88e5;">
                                        <?php 
                                        if($status == 1){
                                            echo  Yii::t('app', '未开始');
                                        }else if($status == 2){
                                            echo Yii::t('app', '进行中');
                                        }else{
                                            echo Yii::t('app', '已结束');
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="am-u-sm-12 pad10">
                                <div class="am-u-sm-7 pad0">
                                    <div class="am-progress am-progress-xs mar0 mar10">
                                        <div class="am-progress-bar bei_se" style="width: <?php echo $item["percent"]; ?>"></div>
                                    </div>
                                </div>
                                <div class="am-u-sm-2 pad0 fz10" style="color:#FFF;">
                                    <div class="" style="margin-top: 5px;padding-left: 5px">
                                        <?php echo $item["percent"]; ?>
                                    </div>
                                </div>
                                <div class="am-u-sm-3 pad0">
                                    <?php
                                    if($item["status"] == 2){
                                    ?>
                                    <div class="am-header-left am-header-nav right1">
                                        <a href="<?php echo Url::toRoute(["profile/buycare", "id" => $item["id"]]); ?>" class="" style="color: #c1bebe; font-size: 13px;">
                                            <button class="fz10 am-btn-sm am-btn" style="background: #1e88e5;color:#fff;border-radius: 5px;"><?php echo Yii::t('app', '立即购买');?></button>
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
        <!--<script src="/js/3.2.1.js"></script>-->
        <script src="/js/interactive.js"></script>
<!--        <script type="text/javascript" src="/js/canvas-particle.js"></script>-->
    </body>
    <script type="text/javascript">
        $("#tit").on('click', "div", function () {
            $(this).children('p').css('color', "#0F9AE0");
            $(this).siblings().children('p').css('color', "#333");
            var a = $(this).attr("data-id");
            $("#con>div").css("display", "none");
            $("#" + a).css("display", "block");
        })
    </script>
</html>