<?php

use yii\helpers\Url;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title><?php echo Yii::t('app', '转入'); ?></title>
        <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />
        <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
        <script src="/js/js.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="header" style="background:none;top:0px;">
            <a href="/register/sendoutrecord.html?pay_type=1" class="helr" style="color:#1e88e5;">
                <?php echo Yii::t('app', '转入记录'); ?>
            </a>
        </div>
        <div id="page" class="page m">
            <div class="accordion" style="background: none">
                <a href="/register/sendoutrecord.html?pay_type=1">
                    <div class="headerUser" style="overflow:hidden;">
                        <span class="headerName fr" style="color: #1e88e5;float:right;text-align: right;padding-right: .25rem;height: .8rem;line-height: .8rem;font-size: .24rem;"><?php echo Yii::t('app', '转入记录'); ?></span>
                    </div>
                </a>
            </div>
            <p class="trft1"><?php echo Yii::t('app', '扫一扫，向我付款'); ?></p>
            <div class="trftd">
                <img src="<?php echo $sendin_qrcode; ?>" class="trfdimg"/>
            </div>
        </div>
    </body>
</html>