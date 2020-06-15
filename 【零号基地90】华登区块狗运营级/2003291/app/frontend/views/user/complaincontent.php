<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app', '详情'); ?></title>
    <link rel="stylesheet" href="/css/ymj.css" />
    <link rel="stylesheet" href="/css/resetTable.css" />
    <link href="/css/page.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
    <link href="/css/amazeui.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/home.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">
    <link href="/css/myassets.css" rel="stylesheet">
    <link href="/css/swiper-3.3.1.min.css" rel="stylesheet">
</head>

<body>
<div class="am-container">
    <div class="am-g">
        <div class="am-u-sm-12">
<!--            <div class="essay-g"><p align="center">--><?php //echo $rse['type'] == 1 ? Yii::t('app', '我的建议 ') :Yii::t('app', '超时申请') ; ?><!--</p></div>-->
            <div class="essay">
                <span><?php echo Yii::t('app', '我的建议'); ?>：</span>
                <span><?php echo $rse["content"]; ?></span>
            </div>
            <div class="essay">
                <span><?php echo Yii::t('app', '图片'); ?>：</span>
                <span style="<?php echo $rse["picture"] == '/img/jiahao.png' ? 'display:none;' : ''; ?>">
                    <?php if($rse["picture"] != ''){
                        ?>
                        <img src="<?php echo $rse["picture"]; ?>" style="display: block;margin: 20px auto 0;width:80%;height: 50% "/>
                        <?php
                    }?>
                </span>
            </div>

            <div class="essay">
                <span><?php echo Yii::t('app', '客服回复'); ?>：</span>
                <span><?php echo $rse["replay"]; ?></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
