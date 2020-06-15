<?php

/**
 * @author shuang
 * @date 2016-11-8 15:12:45
 */
use frontend\assets\LoginAsset;
use yii\helpers\Html;
use yii\helpers\Url;

//LoginAsset::register($this);
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <title><?php echo Yii::t('app', '登录'); ?></title>

    <!-- Behavioral Meta Data -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Core Meta Data -->
    <meta name="author" content="Matthew Wagerfield">

    <meta name="keywords" content="">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/assets/styles/css/styles.css"/>

    <!-- Favicon -->
    <!--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">-->
    <!--<link rel="shortcut icon" href="http://wagerfield.github.io/parallax/favicon.png" type="image/png">-->

</head>
<body>

<div id="fb-root"></div>

<div id="container" class="wrapper">
    <ul id="scene" class="scene unselectable"
        data-friction-x="0.1"
        data-friction-y="0.1"
        data-scalar-x="25"
        data-scalar-y="15">

        <li class="layer" data-depth="0.10"><div class="background"></div></li>

        <li class="layer" data-depth="0.20">
            <h1 class="title"></h1>

        </li>
        <li class="layer" data-depth="0.30">
            <ul class="rope depth-30">
                <li class="hanger position-5">
                    <div class="board cloud-4 swing-1"></div>
                </li>
            </ul>
        </li>

        <li class="layer" data-depth="0.40"><div class="wave plain depth-40"></div></li>
        <li class="layer" data-depth="0.50"><div class="wave paint depth-50"></div></li>
        <li class="layer" data-depth="0.60"><div class="lighthouse depth-60"></div></li>

        <li class="layer" data-depth="0.60"><div class="wave plain depth-60"></div></li>
        <li class="layer" data-depth="0.80"><div class="wave plain depth-80"></div></li>
        <li class="layer" data-depth="1.00"><div class="wave paint depth-100"></div></li>
    </ul>
    <section id="about" class="wrapper about accelerate hide">
        <div class="cell accelerate">
            <div class="cables center accelerate">
                <div class="panel accelerate">
                    <header>
                        <h1>登录<em></em></h1>
                    </header>
                    <p class="inputBorder mb0">
                        <span class="colorBlack"><?php echo Yii::t('app', '用户名/手机'); ?>:</span>
                        <input type="text"  name="username" id="username"  value="<?php echo isset($_GET['username'])?$_GET['username']:'';?>" placeholder="<?php echo Yii::t('app', '请输入用户名/手机'); ?>"/>
                    </p>
                    <p class="inputBorder borderT0">
                        <span class="colorBlack"><?php echo Yii::t('app', '登录密码'); ?>:</span>
                        <input type="password" name="password" id="password" placeholder="<?php echo Yii::t('app', '请输入登录密码'); ?>"/>
                    </p>

                    <!--下面是两个按钮-->
                    <ul class="links">
                        <!--<li><a class="download" href="">REGIST</a></li>
                        <li><a class="github" target="_blank" href="">LOGIN</a></li>-->
                        <li>
                            <a class="github" href="<?php echo Url::toRoute(["register"]); ?>">
                                <?php echo Yii::t('app', '注册'); ?>
                            </a>
                        </li>
                        <li>
                            <a class="download" href="<?php echo Url::toRoute(["forgetpassword"]); ?>">
                                <?php echo Yii::t('app', '忘记密码'); ?>？
                            </a>
                        </li>

                    </ul>
                    <div align="center">
                        <button type="button" class="am-btn am-btn-secondary am-radius login" style="background-color:#F7CA4B;
                        outline: none;
                        border-bottom: 0px;
                        border-top: 0px;
                        border-left: 0px;
                        border-right: 0px;">
                            <?php echo Yii::t('app', '登录'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--关闭的图标-->
    <button id="toggle" class="toggle i">
        <div class="cross">
            <div class="x"></div>
            <div class="y"></div>
        </div>
    </button>
    <div id="prompt" class="wrapper prompt hide accelerate">

    </div>
</div>

<!-- Scripts -->
<script src="/assets/scripts/js/libraries.min.js"></script>
<script src="/deploy/jquery.parallax.js"></script>
<script src="/js/loginFloat.js"></script>
<script src="/js/jquery.min.js"></script>
<script>
    $("#open").on("click", function () {
        $("#open").css("display", "none");
        $("#close").css("display", "block");
        $("#password").attr("type", "password");

    });

    $("#close").on("click", function () {
        $("#open").css("display", "block");
        $("#close").css("display", "none");
        $("#password").attr("type", "text");
    });

    $(".login").click(function(){
        var username = $("#username").val(),
            password = $("#password").val();
        if(username.length <= 0 || username==""){
            alert("<?php echo Yii::t('app', "请输入用户名/手机")?>");
            return false;
        }
        if(password.length < 6){
            alert("<?php echo Yii::t('app', "请输入登录密码")?>");
            return false;
        }

        $(".login").prop('disabled',true);
        $.ajax({
            type: "post",
            data: {username: username, password: password},
            dataType: "json",
            url: "/site/login.html",
            success: function (data) {
                if (data.status === true) {
                    window.location.href = data.url;
                } else {
                    alert(data.message);
                }
                $(".login").prop('disabled',false);
            }
        });
    })
</script>

</body>
</html>
