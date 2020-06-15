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
<title>实名认证 - ';
echo IN_NAME;
echo '</title>
<link href="';
echo IN_PATH;
echo 'static/index/application.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/index/user_info.css" rel="stylesheet">
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
<div class="user-info">
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
echo '"><span><i class="icon icon-lock"></i></span>修改密码</a>
				</div>
				<div class="col-4">
					<a href="';
echo IN_PATH . 'index.php/profile_verify';
echo '" class="active"><span><i class="icon icon-badge"></i></span>实名认证</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-container">
		<div class="profile-form-wrap form-wrap">
			<div class="partials-user-profile">
				<div class="alert-warning"><ul><li>';
echo $GLOBALS['erduo_in_verify'] > 0 ? $GLOBALS['erduo_in_verify'] > 1 ? '审核中' : '已认证' : '未认证';
echo '</li></ul></div>
				<div class="control-group control-phone-number">
					<div class="control-label">
						<div class="edit-value">
							<input class="value grey-border" style="cursor:auto" type="text" id="real_nick" value="';
echo $GLOBALS['erduo_in_nick'];
echo '" placeholder="真实姓名">
						</div>
					</div>
					<div class="clear-fix"></div>
				</div>
				<div class="control-group control-phone-number">
					<div class="control-label">
						<div style="display:-webkit-box;margin-bottom:10px">
							<span>证件照片<span style="font-size:12px">(单个文件不能超过5MB)</span></span>
						</div>
						<div style="display:flex;-webkit-box-pack:justify;justify-content:space-between">
							<div style="text-align:center" class="upload_groud">
								<input type="file" id="upload_p_rev" onchange="upload_p_rev()" style="display:none">
								<div style="width:110px;height:110px;line-height:110px;text-align:center;cursor:pointer;border:1px dashed #979797;position:relative;border-radius:4px" class="upload" id="card_prev" onclick="$(\'#upload_p_rev\').click()">
									<span>点击上传</span>
									';
if (getverify($GLOBALS['erduo_in_userid'], 'prev')) {
	echo '<img src="';
	echo getverify($GLOBALS['erduo_in_userid'], 'prev', 1);
	echo '" style="width:100%;height:100%;position:absolute;left:0px;top:0px">';
} else {
	echo '<img style="width:100%;height:100%;position:absolute;left:0px;top:0px;display:none">';
}
echo '								</div>
								<div id="tips_prev" style="font-size:14px;margin-top:10px">证件正面</div>
							</div>
							<div style="text-align:center" class="upload_groud">
								<input type="file" id="upload_a_fter" onchange="upload_a_fter()" style="display:none">
								<div style="width:110px;height:110px;line-height:110px;text-align:center;cursor:pointer;border:1px dashed #979797;position:relative;border-radius:4px" class="upload" id="card_after" onclick="$(\'#upload_a_fter\').click()">
									<span>点击上传</span>
									';
if (getverify($GLOBALS['erduo_in_userid'], 'after')) {
	echo '<img src="';
	echo getverify($GLOBALS['erduo_in_userid'], 'after', 1);
	echo '" style="width:100%;height:100%;position:absolute;left:0px;top:0px">';
} else {
	echo '<img style="width:100%;height:100%;position:absolute;left:0px;top:0px;display:none">';
}
echo '								</div>
								<div id="tips_after" style="font-size:14px;margin-top:10px">证件背面</div>
							</div>
							<div style="text-align:center" class="upload_groud">
								<input type="file" id="upload_h_and" onchange="upload_h_and()" style="display:none">
								<div style="width:110px;height:110px;line-height:110px;text-align:center;cursor:pointer;border:1px dashed #979797;position:relative;border-radius:4px" class="upload" id="card_hand" onclick="$(\'#upload_h_and\').click()">
									<span>点击上传</span>
									';
if (getverify($GLOBALS['erduo_in_userid'], 'hand')) {
	echo '<img src="';
	echo getverify($GLOBALS['erduo_in_userid'], 'hand', 1);
	echo '" style="width:100%;height:100%;position:absolute;left:0px;top:0px">';
} else {
	echo '<img style="width:100%;height:100%;position:absolute;left:0px;top:0px;display:none">';
}
echo '								</div>
								<div id="tips_hand" style="font-size:14px;margin-top:10px">手持证件</div>
							</div>
						</div>
						<div class="clear-fix"></div>
					</div>
				</div>
				<div class="control-group control-phone-number">
					<div class="control-label">
						<div class="edit-value">
							<input class="value grey-border" style="cursor:auto" type="text" id="real_card" value="';
echo $GLOBALS['erduo_in_card'];
echo '" placeholder="身份证号" onkeyup="this.value=this.value.replace(/[^\\d]/g,\'\')" onbeforepaste="clipboardData.setData(\'text\',clipboardData.getData(\'text\').replace(/[^\\d]/g,\'\'))">
						</div>
					</div>
					<div class="clear-fix"></div>
				</div>
				<div class="form-group action real-name">
					<span class="btn" style="cursor:pointer" onclick="send_verify(0)">提交审核</span>
				</div>
				<div class="intro">
					<div>
						<label>为什么实名认证?</label>
						<p>应相关部门要求,网络应用传播需要完成实名认证</p>
					</div>
					<div>
						<label>审核失败常见原因:</label>
						<p>1. 无手持身份照片</p>
						<p>2. 非真实身份证件照片</p>
						<p>3. 身份证过期</p>
						<p>4. 手持者与证件不符</p>
						<p>5. 身份证件照片不清晰</p>
					</div>
					<div>
						<label>审核失败站内限制:</label>
						<p>1. 可能无法上传应用</p>
						<p>2. 已上传的应用不影响下载</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>';