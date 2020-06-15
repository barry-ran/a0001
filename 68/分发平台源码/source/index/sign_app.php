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
$row and IN_SIGN and preg_match('/(\\.ipa)$/', $row['in_app']) or exit(header('location:' . IN_PATH));
$row['in_sign'] or $GLOBALS['db']->query("delete from " . tname('signlog') . " where in_aid=" . $id);
$status = $GLOBALS['db']->getone("select in_status from " . tname('signlog') . " where in_aid=" . $id);
$sign = $status ? $status > 1 ? 2 : '<b id="_listen" style="color:#ec4242">正在进行签名，请稍等...</b>' : '未签名';
$ssl = is_ssl() ? 'https://' : 'http://';
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
echo ' - 企业签名 - ';
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
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/sign.js"></script>
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
var oauth = {\'api\':\'';
echo IN_API;
echo '\',\'ssl\':\'';
echo $ssl;
echo '\',\'site\':\'';
echo $_SERVER['HTTP_HOST'];
echo '\',\'path\':\'';
echo IN_PATH;
echo '\',\'ipa\':\'';
echo bin2hex($row['in_app']);
echo '\',\'charset\':\'';
echo IN_CHARSET;
echo '\',\'name\':\'';
echo auth_codes($row['in_name']);
echo '\'};
window.onload = get_cert_list;
';
if ($status && $status < 2) {
	echo 'setInterval(\'listen()\', ';
	echo IN_LISTEN;
	echo ');';
}
echo 'layer.use(\'confirm-ext.js\');
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
<div class="page-app app-combo">
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
					<li><a class="ng-binding" style="border-left:1px solid" href="';
echo IN_PATH;
echo 'index.php/each_app/';
echo $row['in_id'];
echo '"><i class="icon-combo"></i>应用合并</a></li>
					<li><a class="ng-binding active" style="border-left:1px solid"><i class="icon-device"></i>企业签名</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="ng-scope">
		<div class="page-tabcontent apps-app-info">
			<div class="middle-wrapper">
				<div class="app-info-form">
					<div class="field app-id">
						<div class="left-label ng-binding">签名期限</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
if ($row['in_sign']) {
	echo '<b style="color:#1aa79a">' . date('Y-m-d H:i:s', $row['in_sign']) . '</b>';
} else {
	echo '未开通';
}
echo '</span>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">补签名额</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
if ($row['in_resign']) {
	echo '<b style="color:#1aa79a">' . $row['in_resign'] . '</b>';
} else {
	echo $row['in_resign'];
}
echo '</span>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">证书指定</div>
						<div class="value">
							<div class="input-group">
								<select class="form-control" id="in_cert"><option value="">请选择企业证书</option>
</select>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">签名指定</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">多文件以|隔开</span>
								<input type="text" class="form-control" placeholder="指定文件签名，默认留空！" id="in_replace">
							</div>
						</div>
					</div>
					';
if (is_numeric($sign)) {
	echo '					<div class="field app-short">
						<div class="left-label ng-binding">签名文件</div>
						<div class="value actions">
							<button class="save ng-binding" style="margin-right:260px;background-color:#1aa79a" onclick="download()">文件下载</button>
							<button class="save ng-binding" style="background-color:#1aa79a" onclick="window.open(\'';
	echo getlink($row['in_id']);
	echo '\')">分发预览</button>
						</div>
					</div>
					';
} else {
	echo '					<div class="field app-short">
						<div class="left-label ng-binding">签名文件</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">';
	echo $sign;
	echo '</span>
							</div>
						</div>
					</div>
					';
}
echo '					<hr>
					<div class="field app-short">
						<div class="left-label ng-binding">开通签名</div>
						<div class="value">
							<div class="apps-app-security">
								<div class="btn-invite-member" onclick="layer.prompt({title:\'请输入签名密钥\'},function(_key){purchase(_key)})">开通或续期</div>
								<div class="btn-invite-member" style="margin-left:5px;border:1px solid #1aa79a;color:#1aa79a" onclick="window.open(\'';
echo IN_PATH . 'user/price';
echo '\')" title="购买密钥"><i class="icon icon-cart"></i></div>
							</div>
						</div>
					</div>
					<div class="field actions">
						<div class="value">
							<div class="apps-app-security">
								<button class="save ng-binding" onclick="sign_confirm()">开始签名</button>
								';
if ($status && $status < 2) {
	echo '<div class="btn-invite-member" style="margin-left:5px;border:1px solid #f8ba0b;color:#f8ba0b" onclick="reset_sign_confirm()" title="重置签名"><i class="icon icon-update"></i></div>';
}
echo '								<input type="checkbox" onclick="if(checked){$(\'#in_cert\').attr(\'disabled\',true)}else{$(\'#in_cert\').attr(\'disabled\',false)}" style="margin:5px">签名正常
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
';
include 'source/index/bottom.php';
echo '</body>
</html>';