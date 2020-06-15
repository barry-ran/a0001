<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app', '修改登录密码'); ?></title>
    <link rel="stylesheet" href="/css/ymj.css" />
</head>

<body>
<div class="am-container">
    <div class="am-g">
        <!--主背景块-->
        <form action= "<?php echo Url::toRoute(["alterlogpwd"]);?>" method="post">
            <div class="am-u-sm-12 userGo">
                <div class="accordion2">
                    <div class="accordionInput frm">
                        <input type="password" name="oldpwd"  placeholder="<?php echo Yii::t('app', '输入您的旧密码'); ?>" class="txt large fl" step="1">
                        <label title="<?php echo Yii::t('app', '旧密码'); ?>"></label>
                        <span role="tooltip"></span>
                    </div>
                    <div class="goRight opacity6 closeInput">
                        <img src="/img/close_gray_18.png" />
                    </div>
                </div>
                <div class="accordion2">
                    <div class="accordionInput frm">
                        <input type="password" name="newpwd" placeholder="<?php echo Yii::t('app', '输入您的新密码'); ?>" class="txt large fl" step="1">
                        <label title="<?php echo Yii::t('app', '新密码'); ?>"></label>
                        <span role="tooltip"></span>
                    </div>
                    <div class="goRight opacity6 closeInput">
                        <img src="/img/close_gray_18.png" />
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12 safeLogout" style="margin-top: 30px;">
                <button type="submit" class="button" style="background-color:#1e88e5;color:white;">
                    <?php echo Yii::t('app', '确定'); ?>
                </button>
            </div>
        </form>
    </div>
</div>
<script charset="utf-8" src="/js/3.2.1.js"></script>
<script>
    $(".large").focus(function() {
        $(this).parent().parent().css("margin-top", "24px");
    });
    $(".large").blur(function() {
        $(this).parent().parent().css("margin-top", "10px");
    });
    $(".closeInput").on("click", function() {
        $(this).prev().find("input").val("");
    });
</script>
</body>
</html>