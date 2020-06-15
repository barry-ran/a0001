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
$ssl = is_ssl() ? 'https://' : 'http://';
$link = $ssl . $_SERVER['HTTP_HOST'] . IN_PATH;
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
echo ' - 基本信息 - ';
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
echo 'static/index/uploadify-icon.js"></script>
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
<div class="page-app app-info">
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
					<li><a class="ng-binding active"><i class="icon-file"></i>基本信息</a></li>
					<li><a class="ng-binding" style="border-left:1px solid" href="';
echo IN_PATH;
echo 'index.php/each_app/';
echo $row['in_id'];
echo '"><i class="icon-combo"></i>应用合并</a></li>
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
	<div class="ng-scope">
		<div class="page-tabcontent apps-app-info">
			<div class="middle-wrapper">
				<div class="app-info-form">
					<div class="field app-id">
						<div class="left-label ng-binding">应用编号</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
echo $row['in_id'];
echo '</span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">应用大小</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
echo formatsize($row['in_size']);
echo '</span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">版本类型</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
echo $row['in_type'] > 0 ? '企业版' : '内测版';
echo '</span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">最新版本</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
echo $row['in_bsvs'] . '（Build ' . $row['in_bvs'] . '）';
echo '</span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">公司名称</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
echo $row['in_nick'];
echo '</span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">集团信息</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
echo $row['in_team'];
echo '</span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">更新时间</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
echo $row['in_addtime'];
echo '</span>
							</div>
						</div>
					</div>
					<hr>
					';
if (IN_SPEEDPOINTS && IN_DENIED && !getapp($row['in_app']) && !preg_match('/(\\.mobileconfig)$/', $row['in_app'])) {
	echo '<div class="field app-short">
						<div class="left-label ng-binding">下载通道</div>
						<div class="value">
							<div class="apps-app-security">
								';
	if ($row['in_highspeed']) {
		echo '已升级';
	} else {
		echo '<div class="btn-invite-member" style="border:1px solid #ec4242;color:#ec4242" onclick="high_speed(in_id, 1)">扣除 ';
		echo IN_SPEEDPOINTS;
		echo ' 下载点数升级为全速通道</div>';
	}
	echo '							</div>
						</div>
					</div>';
}
echo '					';
if (!getapp($row['in_app']) && preg_match('/(\\.mobileconfig)$/', $row['in_app'])) {
	echo '<div class="field app-short">
						<div class="left-label ng-binding">描述验证</div>
						<div class="value">
							<div class="apps-app-security">
								';
	if (preg_match('/(\\-signed\\.mobileconfig)$/', $row['in_app'])) {
		echo '已验证';
	} else {
		echo '<div class="btn-invite-member" style="border:1px solid #ec4242;color:#ec4242" onclick="signed(in_id, 1)">免费验证</div>';
	}
	echo '							</div>
						</div>
					</div>';
}
echo '					<div class="field app-short">
						<div class="left-label ng-binding">文件提取</div>
						<div class="value">
							<div class="apps-app-security">
								<div class="btn-invite-member" style="border:1px solid #ec4242;color:#ec4242" onclick="downapp()">免费提取</div>
							</div>
						</div>
					</div>
					<div class="field app-short">
						<div class="left-label ng-binding">应用图标</div>
						<div class="value">
							<div class="apps-app-security">
								<input type="file" id="upload_icon" onchange="upload_icon()" style="display:none">
								<div class="btn-invite-member" onclick="$(\'#upload_icon\').click()">更新图标</div>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">应用名称</div>
						<div class="value">
							<input type="text" value="';
echo $row['in_name'];
echo '" id="in_name">
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">短链地址</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
echo $link;
echo '</span>
								<input type="text" class="form-control" value="';
echo $row['in_link'];
echo '" id="in_link" onkeyup="value=value.replace(/[\\W|\\_]/g,\'\')" onblur="value=value.replace(/[\\W|\\_]/g,\'\')"';
if (!IN_REWRITE) {
	echo ' placeholder="短链功能未开放！" readonly';
}
echo '>
							</div>
						</div>
					</div>
					<div class="field actions">
						<div class="value">
							<button class="save ng-binding" onclick="edit_app()">保存</button>
						</div>
					</div>
					';
if (IN_ADPOINTS && !$row['in_removead']) {
	echo '<div class="field app-deletion">
						<hr>
						<div class="left-label ng-binding">去除广告</div>
						<div class="value">
							<button class="btn require-confirm" onclick="remove_ad(in_id, 1)">
								<span class="ng-scope">扣除 ';
	echo IN_ADPOINTS;
	echo ' 下载点数去除广告</span>
							</button>
						</div>
					</div>';
}
echo '				</div>
			</div>
		</div>
	</div>
</div>
</section>
';
include 'source/index/bottom.php';
echo '</body>
</html>';