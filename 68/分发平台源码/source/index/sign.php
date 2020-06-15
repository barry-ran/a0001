<?php

//decode by 精品资源分享网www.xiomao.cn
if (!defined('IN_ROOT')) {
	exit('Access denied');
}
echo '';
IN_SIGN or exit(header('location:' . IN_PATH));
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
<title>签名价格 - ';
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
echo 'static/index/lib.js"></script>
<script type="text/javascript">
var in_path = \'';
echo IN_PATH;
echo '\';
var in_pay = ';
echo IN_PAY;
echo ';
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
echo IN_PATH . 'index.php/install';
echo '">分发价格</a><i class="icon-comma"></i></li>
				';
if (IN_SIGN) {
	echo '<li><a href="';
	echo IN_PATH . 'index.php/sign';
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
			<i class="icon-brace-left"></i><span>企业签名</span><i class="icon-brace-right"></i>
		</div>
		<small>自动签名</small>
		</h1>
		<div class="pattern-bg"></div>
	</div>
	<div class="section packages-content">
		<h3>
		<div>选择密钥种类</div>
		';
if ($GLOBALS['userlogined']) {
	echo '		<small style="color:#1aa79a">最多只展示【<b style="color:#f87335">3</b>】条最近购买的密钥</small>
		';
	$query = $GLOBALS['db']->query("select * from " . tname('key') . " where in_uid=" . $GLOBALS['erduo_in_userid'] . " order by in_time desc LIMIT 0,3");
	while ($row = $GLOBALS['db']->fetch_array($query)) {
		echo '<br /><small style="color:' . ($row['in_state'] ? '#f87335' : '#f8ba0b') . '">' . $row['in_code'] . '</small>';
	}
	echo '		';
} else {
	echo '		<small style="color:#1aa79a">登录后，此处将展示最近购买的密钥。</small>
		';
}
echo '		</h3>
		<div class="package-cards-wrap">
			<div class="package-cards" id="package_content">
				<div class="package-card">
					<div class="package-header">
						<h2>包月</h2>
						<small>签名密钥</small>
					</div>
					<div class="package-content">
						<div>￥';
echo IN_SIGN;
echo '</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(1)">购买</button>
					</div>
				</div>
				<div class="package-card active">
					<div class="package-header">
						<h2>包季</h2>
						<small>签名密钥</small>
					</div>
					<div class="package-content">
						<div class="package-badge">
							<div class="badge-wrap"><span>推荐</span><span class="arraw"></span></div>
						</div>
						<div>￥';
echo IN_SIGN * 3;
echo '</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(2)">购买</button>
					</div>
				</div>
				<div class="package-card">
					<div class="package-header">
						<h2>包年</h2>
						<small>签名密钥</small>
					</div>
					<div class="package-content">
						<div>￥';
echo IN_SIGN * 12;
echo '</div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(3)">购买</button>
					</div>
				</div>
			</div>
		</div>
		<small>如需线下付款购买，请联系&nbsp;<a href="mailto:';
echo IN_MAIL;
echo '">';
echo IN_MAIL;
echo '</a></small>
	</div>
	<div class="section packages-cert">
		<div class="cert-header">
			<i class="icon icon-users"></i>
		</div>
		<div class="cret-row-wrap">
			<div class="cert-row">
				<div class="half text-right">
					<div class="cert-item">补签政策</div>
					<ul class="list-unstyled cert-list">
						<li>';
echo IN_RESIGN;
echo ' 次/每月</li>
						<li>密钥叠加使用</li>
					</ul>
				</div>
				<div class="half text-left">
					<div class="cert-item">密钥价格</div>
					<ul class="list-unstyled cert-list">
						<li>';
echo IN_SIGN;
echo ' 元/每月</li>
						<li>签约';
echo IN_PAY > 1 ? '支付宝' : '微信';
echo '支付</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	';
include 'source/index/faq.php';
echo '</div>
<div class="dialog-mask" style="display:none"></div>
<div id="buy-confirm-wx" class="dialog buy-confirm" style="display:none">
	<header class="text-center">微信扫码支付</header>
	<div class="content"><center><img id="qrcode"></center></div>
	<div class="actions text-center">
		<button class="btn btn-default" style="margin-bottom:10px" onclick="$(\'.dialog-mask\').hide(),$(\'#buy-confirm-wx\').hide()">放弃购买</button><button class="btn btn-yellow" style="margin-bottom:10px" onclick="location.reload()">购买成功，立即查看</button>
	</div>
</div>
<div id="buy-confirm-zfb" class="dialog buy-confirm" style="display:none">
	<header class="text-center">支付宝跳转支付</header>
	<div class="actions text-center">
		<button class="btn btn-default" style="margin-bottom:10px" onclick="$(\'.dialog-mask\').hide(),$(\'#buy-confirm-zfb\').hide()">放弃购买</button><button class="btn btn-yellow" style="margin-bottom:10px">立即购买</button>
	</div>
</div>
';
include 'source/index/bottom.php';
echo '</body>
</html>';