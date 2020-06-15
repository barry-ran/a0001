<?php

//decode by 精品资源分享网www.xiomao.cn
if (!defined('IN_ROOT')) {
	exit('Access denied');
}
echo '<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="';
echo IN_CHARSET;
echo '">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="';
echo IN_KEYWORDS;
echo '">
<meta name="description" content="';
echo IN_DESCRIPTION;
echo '">
<title>立即登录 - ';
echo IN_NAME;
echo '</title>
<link href="';
echo IN_PATH;
echo 'static/index/application.css" rel="stylesheet">
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/lib.js"></script>
<script type="text/javascript">
var in_path = \'';
echo IN_PATH;
echo '\';
var home_link = \'';
echo IN_PATH . 'index.php/home';
echo '\';
</script>
</head>
<body class="page-sessions-new">
<div class="partials-brands">
	<a href="';
echo IN_PATH;
echo '"><i class="icon-" style="font-size:';
echo checkmobile() ? 30 : 40;
echo 'px;font-weight:bold">';
echo $_SERVER['HTTP_HOST'];
echo '</i></a>
</div>
<div class="form-container">
	<div class="form-behavior divider">
		<span>立即登录</span>
	</div>
	<div class="form-inner">
		<form class="form-float-label" onsubmit="login();return false">
			<div class="alert-warning hidden" id="alert-warning"></div>
			<div class="form-group">
				<input class="form-control" autofocus placeholder="邮箱" type="text" id="mail"><span class="float-label"><i class="icon-email"></i></span>
			</div>
			<div class="form-group">
				<input class="form-control" placeholder="密码" type="password" id="pwd"><span class="float-label"><i class="icon-lock"></i></span>
			</div>
			<div class="form-group action">
				<button type="submit" class="btn btn-block btn-primary">立即登录</button>
			</div>
		</form>
		<div class="help-section">
			<span class="btn-alternative"><a href="';
echo IN_PATH . 'index.php/reg';
echo '">免费注册</a></span><a href="';
echo IN_PATH . 'index.php/lost';
echo '">忘记密码？</a>
		</div>
	</div>
</div>
</body>
</html>';