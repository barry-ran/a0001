<?php

//decode by 精品资源分享网www.xiomao.cn
if (!defined('IN_ROOT')) {
	exit('Access denied');
}
echo '';
if (!$GLOBALS['userlogined']) {
	exit(header('location:' . IN_PATH . 'index.php/login'));
}
echo '<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="';
echo IN_CHARSET;
echo '">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<title>修改密码 - ';
echo IN_NAME;
echo '</title>
<link href="';
echo IN_PATH;
echo 'static/index/application.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/index/user_info.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/index/user_pwd.css" rel="stylesheet">
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/upload/avatar.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/profile.js"></script>
<script type="text/javascript">
var in_path = \'';
echo IN_PATH;
echo '\';
var in_upw = \'';
echo $GLOBALS['erduo_in_userpassword'];
echo '\';
var in_uid = ';
echo $GLOBALS['erduo_in_userid'];
echo ';
</script>
</head>
<body>
<header>
<div class="brand">
	<a href="';
echo IN_PATH;
echo '"><i class="icon-" style="font-size:';
echo checkmobile() ? 25 : 35;
echo 'px;font-weight:bold">';
echo $_SERVER['HTTP_HOST'];
echo '</i></a>
</div>
<nav>
	<ul><li><a id="signoutLink" href="';
echo IN_PATH . 'index.php/home';
echo '">我的应用</a></li></ul>
</nav>
</header>
<div class="user-info form-container">
	<form class="avatar">
		<label class="img-container">
			<input type="file" id="a_vatar" onchange="upload_a_vatar()" style="display:none">
			<img src="';
echo getavatar($GLOBALS['erduo_in_userid']);
echo '" width="120" height="120">
			<i class="icon-upload-cloud" onclick="$(\'#a_vatar\').click()"></i>
		</label>
	</form>
	<form class="auto-save-form">
		<div class="form-group floated">
			<span class="name">';
echo substr($GLOBALS['erduo_in_username'], 0, strpos($GLOBALS['erduo_in_username'], '@'));
echo '</span>
		</div>
	</form>
	<div class="user_pro_tabs">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<a href="';
echo IN_PATH . 'index.php/profile_info';
echo '"><span><i class="icon icon-user"></i></span>个人资料</a>
				</div>
				<div class="col-4">
					<a href="';
echo IN_PATH . 'index.php/profile_pwd';
echo '" class="active"><span><i class="icon icon-lock"></i></span>修改密码</a>
				</div>
				<div class="col-4">
					<a href="';
echo IN_PATH . 'index.php/profile_verify';
echo '"><span><i class="icon icon-badge"></i></span>实名认证</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-inner">
		<form class="edit_user">
			<div class="alert-warning"><ul style="text-align:left;display:none" id="user_tips"></ul></div>
			<div class="form-group">
				<input placeholder="当前密码" type="password" id="old_pwd">
			</div>
			<div class="form-group">
				<input placeholder="新密码" type="password" id="new_pwd">
			</div>
			<div class="form-group">
				<input placeholder="确认密码" type="password" id="rnew_pwd">
			</div>
			<div class="form-group action">
				<input type="button" onclick="profile_pwd()" value="更新密码" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
</body>
</html>';