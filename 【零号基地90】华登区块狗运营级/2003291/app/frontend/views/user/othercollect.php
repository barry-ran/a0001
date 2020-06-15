<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en" style="height: auto;overflow: inherit">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app', '其他支付方式'); ?></title>
    <link rel="stylesheet" href="/css/ymj.css" />
    <style>
        body {
            overflow: auto;
            overflow-x: hidden;
            background: url(/img/bg2.png) no-repeat top left;
        }
        .accordion {
            background: rgba(30,136,229,0) !important;
            box-shadow: 2px 0px 12px 1px rgba(0,0,0,.8) !important;
        }
        .accordionName{color:#fff; width: 50%;margin-left: 5%;}
        #popLoad{
            position:fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 99;background: rgba(0,0,0,0.5);
        }
        #popLoad img{
            margin: 100px auto 0;
        }

        /*loading*/
        .ta_c{
            text-align: center;
        }

        @-webkit-keyframes rotation{
            from {-webkit-transform: rotate(0deg);}
            to {-webkit-transform: rotate(360deg);}
        }

        .Rotation{
            -webkit-transform: rotate(360deg);
            animation: rotation 3s linear infinite;
            -moz-animation: rotation 3s linear infinite;
            -webkit-animation: rotation 3s linear infinite;
            -o-animation: rotation 3s linear infinite;
        }
        .am-container{right:initial;bottom:initial;position: initial;z-index: 99;}
    </style>
</head>

<body style="position: relative;">
<div class="am-container">
    <div class="am-g pb60">
        <div class="am-u-sm-12 userGo">
            <a href="<?php echo Url::toRoute(["user/modifycollect", "coid" => "1"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '微信') ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>

            <a href="<?php echo Url::toRoute(["user/modifycollect", "coid" => "2"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '支付宝') ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!--Loading 20180728-->
<div class="ta_c ng-hide" id="popLoad">
    <img class="Rotation" src="/img/loading.png" width="100" height="100"/>
</div>

<script src="/js/jquery.min.js"></script>
</body>

</html>