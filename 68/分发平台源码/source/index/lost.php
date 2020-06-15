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
<title>找回密码 - ';
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
var login_link = \'';
echo IN_PATH . 'index.php/login';
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
		<span>找回密码</span>
	</div>
	<div class="form-inner">
		<form class="form-float-label" onsubmit="lost();return false">
			<div class="alert-warning hidden" id="alert-warning"></div>
			<div class="form-group">
				<input class="form-control" autofocus placeholder="邮箱" type="text" id="mail">
			</div>
			<div class="form-group form-group-sign-code">
				<input class="form-control" placeholder="请输入邮件码" type="text" id="mcode">
				<button type="button" class="btn btn-primary btn-get-sign-code" id="send_btn" onclick="send_mail()">获取邮件码</button>
			</div>
			<div class="form-group">
				<input class="form-control" placeholder="重设密码" type="password" id="pwd">
			</div>
			<div class="form-group">
				<input class="form-control" placeholder="确认密码" type="password" id="rpwd">
			</div>
			<div class="form-group action">
				<button type="submit" class="btn btn-block btn-primary">开始重置</button>
			</div>
		</form>
		<div class="help-section">
			<span class="btn-alternative"><a href="';
echo IN_PATH . 'index.php/login';
echo '">返回登录</a></span>
		</div>
	</div>
</div>
</body>
</html>';