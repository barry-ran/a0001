<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->registerJsFile("js/cloud.js", ["depends" => "backend\assets\AppAsset"]);
$this->registerJs('$(".loginbox").css({"position": "absolute", "left": ($(window).width() - 692) / 2});$(window).resize(function() {$(".loginbox").css({"position": "absolute", "left": ($(window).width() - 692) / 2});});');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="#" type="image/png">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login-body" style="background-color:#1c77ac; background-image:url(../images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
        <?php $this->beginBody() ?>
        <div id="mainBody">
            <div id="cloud1" class="cloud"></div>
            <div id="cloud2" class="cloud"></div>
        </div>
        <div class="logintop">    
            <span>欢迎登录后台管理界面平台</span>    
            <ul>
                <li><a href="javascript:;">回首页</a></li>
                <li><a href="javascript:;">帮助</a></li>
                <li><a href="javascript:;">关于</a></li>
            </ul>    
        </div>
        <div class="loginbody">
            <span class="systemlogo"></span> 
            <div class="loginbox">
                <form action="" method="post">
                    <ul>
                        <li><input name="LoginForm[username]" type="text" class="loginuser" value="" onclick="javascript:this.value = '';"/></li>
                        <li><input name="LoginForm[password]" type="password" class="loginpwd" onclick="javascript:this.value = '';"/></li>
                        <input type="hidden" name="<?php echo $csrfname;?>" value="<?php echo $csrfval;?>" />
                        <li><input name="" type="submit" class="loginbtn" value="登录" />
                            <label><input name="LoginForm[rememberMe]" type="checkbox" value="" checked="checked" />记住密码</label>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <div class="loginbm">仅供系统管理员使用，勿用于任何商业用途</div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
