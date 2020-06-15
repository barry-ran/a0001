<?php

use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '安全验证'); ?></title>
        <link rel="stylesheet" href="/css/ymj.css" />
        <style>
            .accordionName {
                margin-left: 5%;
                width: 60%;
            }
        </style>
    </head>

    <body>
        <div class="am-container">
            <div class="am-g">
                <div class="am-u-sm-12 userGo">
                    <a href="<?php echo Url::toRoute(["user/alterlogpwd"]); ?>">
                        <div class="accordion">
                            <div class="accordionName">
                                <?php echo Yii::t('app', '修改登录密码'); ?>
                            </div>
                            <div class="goRight">
                                <img src="/img/goRight.png" />
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo Url::toRoute(["user/alterpaypwd"]); ?>">
                        <div class="accordion">
                            <div class="accordionName">
                                <?php echo Yii::t('app', '修改支付密码'); ?>
                            </div>
                            <div class="goRight">
                                <img src="/img/goRight.png" />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>