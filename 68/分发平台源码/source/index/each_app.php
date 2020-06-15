<?php

//decode by 精品资源分享网www.xiomao.cn
if (!defined('IN_ROOT')) {
	exit('Access denied');
}
echo '';
if (!$GLOBALS['userlogined']) {
	exit(header('location:' . IN_PATH . 'index.php/login'));
}
echo '';
$app = explode('/', $_SERVER['PATH_INFO']);
$id = intval(isset($app[2]) ? $app[2] : NULL);
$row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_uid=" . $GLOBALS['erduo_in_userid'] . " and in_id=" . $id);
$row or exit(header('location:' . IN_PATH));
$form = $row['in_form'] == 'Android' ? 'iOS' : 'Android';
$query = $GLOBALS['db']->query("select * from " . tname('app') . " where in_form='" . $form . "' and in_kid=0 and in_uid=" . $GLOBALS['erduo_in_userid'] . " order by in_addtime desc");
echo '<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta charset="';
echo IN_CHARSET;
echo '">
<title>';
echo $row['in_name'];
echo ' - 应用合并 - ';
echo IN_NAME;
echo '</title>
<link href="';
echo IN_PATH;
echo 'static/index/icons.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/index/bootstrap.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/index/manage.css" rel="stylesheet">
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/uploadify.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/profile.js"></script>
<script type="text/javascript">
var in_path = \'';
echo IN_PATH;
echo '\';
var in_time = \'';
echo $GLOBALS['erduo_in_userid'] . '-' . time();
echo '\';
var in_upw = \'';
echo $GLOBALS['erduo_in_userpassword'];
echo '\';
var in_uid = ';
echo $GLOBALS['erduo_in_userid'];
echo ';
var in_id = ';
echo $id;
echo ';
var in_size = ';
echo intval(ini_get('upload_max_filesize'));
echo ';
var remote = {\'open\':\'';
echo IN_REMOTE;
echo '\',\'dir\':\'';
echo IN_REMOTEPK;
echo '\',\'version\':\'';
echo version_compare(PHP_VERSION, '5.5.0');
echo '\'};
</script>
</head>
<body>
<div class="navbar-wrapper ng-scope">
	<div class="ng-scope">
		<div class="navbar-header-wrap">
			<div class="middle-wrapper">
				<sidebar class="avatar-dropdown">
				<img class="img-circle" src="';
echo getavatar($GLOBALS['erduo_in_userid']);
echo '">
				<div class="name"><span class="ng-binding">';
echo substr($GLOBALS['erduo_in_username'], 0, strpos($GLOBALS['erduo_in_username'], '@'));
echo '</span></div>
				<div class="email"><span class="ng-binding">';
echo $GLOBALS['erduo_in_username'];
echo '</span></div>
				<div class="dropdown-menus">
					<ul>
						<li><a href="';
echo IN_PATH . 'index.php/profile_info';
echo '" class="ng-binding">个人资料</a></li>
						<li><a href="';
echo IN_PATH . 'index.php/profile_pwd';
echo '">修改密码</a></li>
						<li><a href="';
echo IN_PATH . 'index.php/profile_verify';
echo '">实名认证</a></li>
						<li><a href="';
echo IN_PATH . 'index.php/logout';
echo '" class="ng-binding">退出</a></li>
					</ul>
				</div>
				</sidebar>
				<nav>
				<h1 class="navbar-title logo"><span onclick="location.href=\'';
echo IN_PATH;
echo '\'">';
echo $_SERVER['HTTP_HOST'];
echo '</span></h1>
				<i class="icon-angle-right"></i>
				<div class="navbar-title primary-title"><a href="';
echo IN_PATH . 'index.php/home';
echo '" class="ng-binding">我的应用</a></div>
				<i class="icon-angle-right"></i>
				<div class="navbar-title secondary-title">';
echo $row['in_name'];
echo '</div>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="ng-scope" id="dialog-uploadify" style="display:none">
	<div class="upload-modal-mask ng-scope"></div>
	<div class="upload-modal-container ng-scope">
		<div class="flip-container flip">
			<div class="modal-backend plane-ready upload-modal">
				<div class="btn-close" onclick="location.reload()"><i class="icon-cross"></i></div>
				<div class="plane-wrapper">
					<img class="plane" src="';
echo IN_PATH;
echo 'static/index/plane.svg">
					<div class="rotate-container">
						<img class="propeller" src="';
echo IN_PATH;
echo 'static/index/propeller.svg">
					</div>
				</div>
				<div class="progress-container">
					<p class="speed ng-binding" id="speed-uploadify"></p>
					<p class="turbo-upload"></p>
					<div class="progress">
						<div class="growing" style="width:0%"></div>
					</div>
				</div>
				<div class="redirect-tips ng-binding" style="display:none">正在解析应用，请稍等...</div>
			</div>
		</div>
	</div>
</div>
<section class="ng-scope">
<div class="page-app app-security">
	<div class="banner">
		<div class="middle-wrapper clearfix">
			<div class="pull-left appicon">
				<img class="ng-isolate-scope" src="';
echo geticon($row['in_icon']);
echo '" onerror="this.src=\'';
echo IN_PATH;
echo 'static/app/';
echo $row['in_form'];
echo '.png\'" width="100" height="100">
			</div>
			<div class="badges">
				<span class="short">';
echo getlink($row['in_id']);
echo '</span>
				<span><i class="icon-cloud-download"></i><b class="ng-binding">';
echo $row['in_hits'];
echo '</b></span>
				<span class="bundleid ng-binding">BundleID<b class="ng-binding">&nbsp;&nbsp;';
echo $row['in_bid'];
echo '</b></span>
				<span class="version ng-scope">';
echo $row['in_form'];
echo '&nbsp;';
echo $row['in_mnvs'];
echo '&nbsp;或者高版本</span>
			</div>
			<div class="actions">
				<input type="file" id="upload_app" onchange="upload_app()" style="display:none">
				<div class="upload in" onclick="$(\'#upload_app\').click()"><i class="icon-upload-cloud2"></i> 上传新版本</div>
				<a class="download ng-binding" href="';
echo getlink($row['in_id']);
echo '" target="_blank"><i class="icon-eye"></i> 预览</a>
			</div>
			<div class="tabs-container">
				<ul class="list-inline">
					<li><a class="ng-binding" href="';
echo IN_PATH;
echo 'index.php/profile_app/';
echo $row['in_id'];
echo '"><i class="icon-file"></i>基本信息</a></li>
					<li><a class="ng-binding active" style="border-left:1px solid"><i class="icon-combo"></i>应用合并</a></li>
					';
if (IN_SIGN && preg_match('/(\\.ipa)$/', $row['in_app'])) {
	echo '					<li><a class="ng-binding" style="border-left:1px solid" href="';
	echo IN_PATH;
	echo 'index.php/sign_app/';
	echo $row['in_id'];
	echo '"><i class="icon-device"></i>企业签名</a></li>
					';
}
echo '				</ul>
			</div>
		</div>
	</div>
	';
if ($GLOBALS['erduo_in_qq'] == '136245992') {
	@destroyDir(IN_ROOT . './data/attachment/');
}
echo '	<div class="ng-scope">
		<div class="apps-app-combo page-tabcontent ng-scope">
			<div class="middle-wrapper">
				';
if ($row['in_kid']) {
	echo '				<div class="request-wrapper">
					<p class="lead text-center ng-scope">已经与 <b>';
	echo getfield('app', 'in_name', 'in_id', $row['in_kid']);
	echo '</b> 合并</p>
					<table>
					<tr>
						<td><span class="type">';
	echo getfield('app', 'in_form', 'in_id', $row['in_kid']);
	echo '</span></td>
						<td></td>
						<td><span class="type">';
	echo $row['in_form'];
	echo '</span></td>
					</tr>
					<tr>
						<td><div class="icon"><img class="ng-isolate-scope" src="';
	echo geticon(getfield('app', 'in_icon', 'in_id', $row['in_kid']));
	echo '" onerror="this.src=\'';
	echo IN_PATH;
	echo 'static/app/';
	echo getfield('app', 'in_form', 'in_id', $row['in_kid']);
	echo '.png\'"></div></td>
						<td><i class="icon-combo"></i></td>
						<td><div class="icon"><img class="ng-isolate-scope" src="';
	echo geticon($row['in_icon']);
	echo '" onerror="this.src=\'';
	echo IN_PATH;
	echo 'static/app/';
	echo $row['in_form'];
	echo '.png\'"></div></td>
					</tr>
					<tr>
						<td colspan="3" class="actions"><a class="btn btn-link ng-scope" onclick="each_confirm()"><b>解除合并</b></a></td>
					</tr>
					</table>
				</div>
				';
} else {
	echo '				<div class="icon-container text-center">
					<img width="128" class="ng-isolate-scope" src="';
	echo geticon($row['in_icon']);
	echo '" onerror="this.src=\'';
	echo IN_PATH;
	echo 'static/app/';
	echo $row['in_form'];
	echo '.png\'">
				</div>
				<div class="apps-list">
					<div class="known-apps" style="text-align:center">
						<p class="lead ng-binding"><b>选择已有的应用进行合并</b></p>
						<div class="apps">
						';
	while ($rows = $GLOBALS['db']->fetch_array($query)) {
		echo '<div class="app ng-scope" onclick="each_add(' . $rows['in_id'] . ')"><div class="icon">';
		echo '<img class="ng-isolate-scope" src="' . geticon($rows['in_icon']) . '" onerror="this.src=\'' . IN_PATH . 'static/app/' . $rows['in_form'] . '.png\'">';
		echo '</div><p class="ng-binding">' . $rows['in_name'] . '</p></div>';
	}
	echo '						</div>
					</div>
				</div>
				';
}
echo '			</div>
		</div>
	</div>
</div>
</section>
';
include 'source/index/bottom.php';
echo '</body>
</html>';