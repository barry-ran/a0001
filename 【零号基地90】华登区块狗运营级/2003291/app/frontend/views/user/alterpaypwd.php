<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '修改支付密码'); ?></title>
        <link rel="stylesheet" href="/css/ymj.css" />
    </head>

    <body>
        <div class="am-g">
            <!--主背景块-->
            <div class="am-u-sm-12 userGo">
                <div class="accordion2">
                    <div class="accordionInput frm">
                        <input type="password" name="oldpay" id="old_pwd"  placeholder="<?php echo Yii::t('app', '输入您的旧支付密码'); ?>" class="txt large fl" step="1">
                        <label title="<?php echo Yii::t('app', '旧支付密码'); ?>"></label>
                        <span role="tooltip"></span>
                    </div>
                    <div class="goRight opacity6 closeInput">
                        <img src="/img/close_gray_18.png" />
                    </div>
                </div>
                <div class="accordion2">
                    <div class="accordionInput frm">
                        <input type="password" name="newpay" id="new_pwd" placeholder="<?php echo Yii::t('app', '输入您的新支付密码'); ?>" class="txt large fl" step="1">
                        <label title="<?php echo Yii::t('app', '新支付密码'); ?>"></label>
                        <span role="tooltip"></span>
                    </div>
                    <div class="goRight opacity6 closeInput">
                        <img src="/img/close_gray_18.png" />
                    </div>
                </div>
                <div style="position: relative;">
                    <a href="<?php echo Url::toRoute(['user/forgetpaypwd'])?>" class="pwd1">
                        <?php echo Yii::t('app', '忘记支付密码？'); ?>
                    </a>
                </div>
            </div>
            <div class="am-u-sm-12 safeLogout" style="margin-top: 30px;">
                <button type="button" class="button"  id="btn" style="background-color:#1e88e5;color:white;">
                    <?php echo Yii::t('app', '修改支付密码'); ?>
                </button>
            </div>
        </div>
        <script charset="utf-8" src="/js/3.2.1.js"></script>
        <script src="/js/jquery.min.js"></script>
        <script>
            $(".button").click(function(){
                $('.button').attr("disabled","disabled");
                var old_pwd = $('#old_pwd').val();
                var new_pwd = $('#new_pwd').val();
                if(old_pwd == "" || new_pwd == ""){
                    alert('<?php echo Yii::t('app', '请输入密码'); ?>');
                    $('.button').attr("disabled",false);
                    return false;
                }
                $.ajax({
                    type: "post",
                    data: {old_pwd:old_pwd,new_pwd:new_pwd},
                    dataType: "json",
                    url: "/user/alterpaypwd.html",
                    success: function (data) {
                        if (data.status == '0001') {
                            alert(data.msg);
                        } else {
                            alert(data.msg);
                            $('.button').attr("disabled",false);
                        }
                    }
                });
            });

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