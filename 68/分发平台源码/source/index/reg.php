<?php
if(!defined('IN_ROOT'))
{
	exit('Access denied');
}
;
echo '<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="';
echo IN_CHARSET;
;
echo '">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="';
echo IN_KEYWORDS;
;
echo '">
<meta name="description" content="';
echo IN_DESCRIPTION;
;
echo '">
<title>免费注册 - ';
echo IN_NAME;
;
echo '</title>
<link href="';
echo IN_PATH;
;
echo 'static/index/application.css" rel="stylesheet">
<script type="text/javascript" src="';
echo IN_PATH;
;
echo 'static/index/lib.js"></script>
<script type="text/javascript">
var in_path = \'';
echo IN_PATH;
;
echo '\';
var home_link = \'';
echo IN_PATH.'index.php/home';
;
echo '\';
function update_seccode(){
	document.getElementById(\'img_seccode\').src = \'';
echo IN_PATH.'source/index/seccode.php';
;
echo '?\' + Math.random();
}
</script>
</head>
<body class="page-sessions-new">
<div class="partials-brands">
	<a href="';
echo IN_PATH;
;
echo '"><i class="icon-" style="font-size:';
echo checkmobile() ?30 : 40;
;
echo 'px;font-weight:bold">';
echo $_SERVER['HTTP_HOST'];
;
echo '</i></a>
</div>
<div class="form-container">
	<div class="form-behavior divider">
		<span>免费注册</span>
	</div>
	<div class="form-inner">
		<form class="form-float-label" onsubmit="reg();return false">
			<div class="alert-warning hidden" id="alert-warning"></div>
			<div class="form-group">
				<input class="form-control" autofocus placeholder="邮箱" type="text" id="mail">
			</div>
			<div class="form-group">
				<input class="form-control" placeholder="设置密码" type="password" id="pwd">
			</div>
			<div class="form-group">
				<input class="form-control" placeholder="确认密码" type="password" id="rpwd">
			</div>
			<div class="form-group form-group-sign-code">
				<input class="form-control" placeholder="请输入验证码" type="text" id="seccode" maxlength="4">
				<img id="img_seccode" onclick="update_seccode()" style="margin:4px;border-radius:4px;cursor:pointer" src="';
echo IN_PATH.'source/index/seccode.php';
;
echo '" height="40">
	</div>
            <div class="checkbox"><input type="checkbox" checked><span>我已阅读并同意<a href="/index.php/agreement" target="_blank" class="color-hover">《极致云分发系统分发协议》</a></span>
			<div class="form-group action">
				<button type="submit" class="btn btn-block btn-primary">免费注册</button>
			</div>
		</form>
		<div class="help-section">
			<span class="btn-alternative"><a href="';
echo IN_PATH.'index.php/login';
;
echo '">已有帐号，去登录</a></span>
		</div>
	</div>
</div>
</body>
</html>';
?>