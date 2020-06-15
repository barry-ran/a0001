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
        <title><?php echo Yii::t('app', '分享'); ?></title>
        <link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />
        <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
        <script src="/js/js.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="page" class="page m">
            <p class="trft1"><?php echo Yii::t('app', '扫一扫'); ?></p>
            <div class="trftd">
                <img src="<?php echo $share_qrcode; ?>"  class="trfdimg" />
            </div>
            <div class="trflink">
                <?php echo Yii::t('app','我的邀请码');?>:
                <?php echo $mycode;?>
            </div>
            <div class="trflink">
                <?php echo Yii::t('app','团队总人数');?>:
                <?php echo $count_tj;?>
                <a href="/site/sharerecord.html" style="color: #1E88E5;text-decoration: underline;">
                    <?php echo Yii::t('app','分享记录');?>
                </a>
            </div>
        </div>
    </body>
</html>