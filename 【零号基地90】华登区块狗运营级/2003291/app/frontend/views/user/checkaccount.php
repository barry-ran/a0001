<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Yii::t('app', '我的账号'); ?></title>
    <link rel="alternate icon" type="image/png" href="../i/favicon.png">
    <link rel="stylesheet" href="../css/amazeui.min.css" />
    <link rel="stylesheet" href="../css/base.css" />
    <link rel="stylesheet" href="../css/login.css" />
    <link rel="stylesheet" href="../css/myassets.css" />
</head>
<body>
<div id="mydiv"></div>
<div class="am-g" style="float: left;">
    <div class="login1">
        <label class="nub-2"><?php echo Yii::t('app', '用户名'); ?>：</label>
        <input type="text" id="username" value="<?php echo $user["username"]; ?>" readonly>
    </div>
    <div class="login1">
        <label class="nub-2"><?php echo Yii::t('app', '手机号码'); ?>：</label>
        <input type="text" id="username" value="<?php echo $user['userprofile']["quhao"]; ?><?php echo $user['userprofile']["phone"]; ?>" readonly>
    </div>
</div>
</body>
</html>
