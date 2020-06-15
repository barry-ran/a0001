<?php

//decode by 精品资源分享网www.xiomao.cn
if (!defined('IN_ROOT')) {
	exit('Access denied');
}
echo '';
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
<title>封装价格 - ';
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
echo 'static/index/main.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/pack/colpick/colpick.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/pack/webview/manage.css" rel="stylesheet">
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/main.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/layer/lib.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/colpick/colpick.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/webview/lib.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/mobileconfig/lib.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/webview/lib_android.js"></script>
<script type="text/javascript">
var in_path = \'';
echo IN_PATH;
echo '\';
var in_login = ';
echo $GLOBALS['userlogined'] ? '1' : '-1';
echo ';
var oauth = {\'api\':\'';
echo IN_WEBVIEWAPI;
echo '\',\'listen\':\'';
echo IN_WEBVIEWLISTEN;
echo '\',\'ext\':\'';
echo $GLOBALS['userlogined'] ? $GLOBALS['erduo_in_userid'] . '-' . time() : '0';
echo '\'};
function change(type) {
	if (type == 1) {
		$("#webview").hide();
		$("#android").hide();
		$("#mobileconfig").show();
	} else if (type == 2) {
		$("#webview").hide();
		$("#mobileconfig").hide();
		$("#android").show();
	} else {
		$("#mobileconfig").hide();
		$("#android").hide();
		$("#webview").show();
	}
}
</script>
</head>
<body class="page-Pricing">
<nav class="navbar navbar-transparent" role="navigation">
<div class="navbar-header">
	<a class="navbar-brand" href="';
echo IN_PATH;
echo '"><i class="icon-" style="font-size:';
echo checkmobile() ? 30 : 40;
echo 'px;font-weight:bold">';
echo $_SERVER['HTTP_HOST'];
echo '</i></a>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" ng-controller="NavbarController">
	<div class="dropdown">
		<div>
			<i class="icon-brace-left"></i>
			<ul class="navbar-bracket">
				<li><a href="';
echo IN_PATH;
echo '">首页</a><i class="icon-comma"></i></li>
				<li><a href="';
echo IN_PATH . 'user/price';
echo '">分发价格</a><i class="icon-comma"></i></li>
				';
if (IN_SIGN) {
	echo '<li><a href="';
	echo IN_PATH . 'user/price';
	echo '">签名价格</a><i class="icon-comma"></i></li>';
}
echo '				<li><a href="';
echo IN_PATH . 'index.php/webview';
echo '">封装价格</a><i class="icon-comma"></i></li>
				';
if ($GLOBALS['userlogined']) {
	echo '				<li><a href="';
	echo IN_PATH . 'index.php/home';
	echo '">应用管理</a><i class="icon-comma"></i></li>
				<li class="signup"><a href="';
	echo IN_PATH . 'index.php/logout';
	echo '">退出</a></li>
				';
} else {
	echo '				<li><a href="';
	echo IN_PATH . 'index.php/login';
	echo '">立即登录</a><i class="icon-comma"></i></li>
				<li class="signup"><a href="';
	echo IN_PATH . 'index.php/reg';
	echo '">免费注册</a></li>
				';
}
echo '			</ul>
			<i class="icon-brace-right"></i>
		</div>
	</div>
</div>
</nav>
<div class="menu-toggle">
	<i class="icon-menu"></i>
</div>
<menu>
<ul>
	<li><a href="';
echo IN_PATH;
echo '">首页</a></li>
	<li><a href="';
echo IN_PATH . 'index.php/install';
echo '">分发价格</a></li>
	';
if (IN_SIGN) {
	echo '<li><a href="';
	echo IN_PATH . 'index.php/sign';
	echo '">签名价格</a></li>';
}
echo '	<li><a href="';
echo IN_PATH . 'index.php/webview';
echo '">封装价格</a></li>
	';
if ($GLOBALS['userlogined']) {
	echo '	<li><a href="';
	echo IN_PATH . 'index.php/home';
	echo '">应用管理</a></li>
	<li><a href="';
	echo IN_PATH . 'index.php/logout';
	echo '">退出</a></li>
	';
} else {
	echo '	<li><a href="';
	echo IN_PATH . 'index.php/reg';
	echo '">免费注册</a></li>
	<li><a href="';
	echo IN_PATH . 'index.php/login';
	echo '">立即登录</a></li>
	';
}
echo '</ul>
</menu>
<div id="root-packages">
	<div class="banner banner-packages">
		<h1>
		<div class="brackets">
			<i class="icon-brace-left"></i><span>应用封装</span><i class="icon-brace-right"></i>
		</div>
		<small>在线封装</small>
		</h1>
		<div class="pattern-bg"></div>
	</div>
	<div class="section packages-content">
		<section class="ng-scope">
		<div class="page-app app-info">
			<div class="ng-scope">
				<div class="page-tabcontent apps-app-info">
					<div class="middle-wrapper">
						<div class="app-info-form">
							<div class="field app-name">
								<div class="value">
									<input type="radio" name="wv_type" onclick="change(0)" checked>&nbsp;苹果极速封装&nbsp;&nbsp;
									<input type="radio" name="wv_type" onclick="change(1)">&nbsp;苹果免签封装（支持绿标验证）&nbsp;&nbsp;
								</div>
							</div>
						</div>
						<div class="app-info-form" id="webview">
							<div class="field app-name">
								<div class="value">
									<input type="text" placeholder="应用名称" id="in_title">
								</div>
							</div>
							<div class="field app-name">
								<div class="value">
									<input type="text" placeholder="域名地址" id="in_url" onkeyup="if(!value.match(/^https?:\\/\\//)){value=\'http://\'+value}" onblur="if(!value.match(/^https?:\\/\\//)){value=\'http://\'+value}">
								</div>
							</div>
							<div class="field app-name">
								<div class="value">
									<input type="text" placeholder="顶部颜色" id="in_b_color" onmousedown="$(this).colpick({layout:\'hex\',submit:0,colorScheme:\'dark\',onChange:function(hsb,hex,rgb,el,bySetColor){if(!bySetColor)$(el).val(hex);}}).keyup(function(){$(this).colpickSetColor(this.value);})" onkeyup="value=value.replace(/[\\W|\\_]/g,\'\')" onblur="value=value.replace(/[\\W|\\_]/g,\'\')">
								</div>
							</div>
							<div class="field app-name">
								<div class="value">
									<input type="text" placeholder="标题颜色" id="in_t_color" onmousedown="$(this).colpick({layout:\'hex\',submit:0,colorScheme:\'dark\',onChange:function(hsb,hex,rgb,el,bySetColor){if(!bySetColor)$(el).val(hex);}}).keyup(function(){$(this).colpickSetColor(this.value);})" onkeyup="value=value.replace(/[\\W|\\_]/g,\'\')" onblur="value=value.replace(/[\\W|\\_]/g,\'\')">
								</div>
							</div>
							<div class="field app-short">
								<div class="value">
									<div class="apps-app-security" id="preview_a_icon">
										<input type="file" id="upload_a_icon" onchange="upload_a_icon()" style="display:none">
										<div class="btn-invite-member"  id="tips_a_icon" onclick="$(\'#upload_a_icon\').click()">上传应用图标</div>
									</div>
								</div>
							</div>
							<div class="field app-short">
								<div class="value">
									<div class="apps-app-security" id="preview_l_image">
										<input type="file" id="upload_l_image" onchange="upload_l_image()" style="display:none">
										<div class="btn-invite-member" id="tips_l_image" onclick="$(\'#upload_l_image\').click()">上传启动图片</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="field actions">
								<div class="value">
									<button class="save ng-binding" onclick="web_view()">一键封装</button>
								</div>
							</div>
						</div>
						<div class="app-info-form" id="mobileconfig" style="display:none">
							<div class="field app-name">
								<div class="value">
									<input type="text" placeholder="应用名称" id="mc_title">
								</div>
							</div>
							<div class="field app-name">
								<div class="value">
									<input type="text" placeholder="域名地址" id="mc_url" onkeyup="if(!value.match(/^https?:\\/\\//)){value=\'http://\'+value}" onblur="if(!value.match(/^https?:\\/\\//)){value=\'http://\'+value}">
								</div>
							</div>
							<div class="field app-short">
								<div class="value">
									<div class="apps-app-security" id="preview_mc_a_icon">
										<input type="file" id="upload_mc_a_icon" onchange="upload_mc_a_icon()" style="display:none">
										<div class="btn-invite-member"  id="tips_mc_a_icon" onclick="$(\'#upload_mc_a_icon\').click()">上传应用图标</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="field actions">
								<div class="value">
									<button class="save ng-binding mc-btn" onclick="mobile_config()">一键封装</button>
								</div>
							</div>
						</div>
						<div class="app-info-form" id="android" style="display:none">
							<div class="field app-name">
								<div class="value">
									<input type="checkbox" checked="checked" disabled="disabled" style="margin:5px">发布到我的应用
								</div>
							</div>
							<div class="field app-name">
								<div class="value">
									<input type="text" placeholder="应用名称" id="ar_title">
								</div>
							</div>
							<div class="field app-name">
								<div class="value">
									<input type="text" placeholder="域名地址" id="ar_url" onkeyup="if(!value.match(/^https?:\\/\\//)){value=\'http://\'+value}" onblur="if(!value.match(/^https?:\\/\\//)){value=\'http://\'+value}">
								</div>
							</div>
							<div class="field app-short">
								<div class="value">
									<div class="apps-app-security" id="preview_ar_a_icon">
										<input type="file" id="upload_ar_a_icon" onchange="upload_ar_a_icon()" style="display:none">
										<div class="btn-invite-member"  id="tips_ar_a_icon" onclick="$(\'#upload_ar_a_icon\').click()">上传应用图标</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="field actions">
								<div class="value">
									<button class="save ng-binding ar-btn" onclick="and_roid(1)">一键封装</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</section>
	</div>
	<div class="section packages-cert">
		<div class="cert-header">
			<i class="icon icon-users"></i>
		</div>
		<div class="cret-row-wrap">
			<div class="cert-row">
				<div class="half text-right">
					<div class="cert-item">封装方式</div>
					<ul class="list-unstyled cert-list">
						<li>WAP网站生成APP应用</li>
						<li>我的应用中预览</li>
					</ul>
				</div>
				<div class="half text-left">
					<div class="cert-item">收费方式</div>
					<ul class="list-unstyled cert-list">
						<li>单次扣除 ';
echo IN_WEBVIEWPOINTS;
echo ' 下载点数</li>
						<li>购买点数包获取</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	';
include 'source/index/faq.php';
echo '</div>
';
include 'source/index/bottom.php';
echo '</body>
</html>';