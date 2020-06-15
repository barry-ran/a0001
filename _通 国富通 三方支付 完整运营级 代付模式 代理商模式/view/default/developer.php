<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $this->config['sitename']?></title>

<meta name="keywords" content="<?php echo $this->config['keyword']?>" />
<meta name="description" content="<?php echo $this->config['description']?>" />

<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link href="css/common.css?46d2f15adcb9adda01d7" rel="stylesheet">
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/home.css">
<link href="css/download.css" rel="stylesheet">
</head>
<body>
 <script type="text/javascript">

        if (!window.jQuery) {
            document.write('<script type="text/javascript" src="/script/jquery.js"><' + '/script>');
        }
        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            window.location.href = "/mobile";
        }

 </script>

<div class="header pinned">
	<div class="header-main clearfix">
		<h1 id="logo"><a href="/main"><img src="/images/logo.png"></a></h1>
		<div class="nav-box">
			<ul class="nav" id="nav">
				<li class="more"><a href="/main">首页</a>
				<li class="more"><a href="/product">产品介绍</a>
				<div class="nav-line">
				</div>
			
				</li>
				<li> <a  href="/demo">在线体验</a> <div class="nav-line"></div> </li>
				<li><a  href="/developer">开发者中心</a> <div class="nav-line"></div></li>
				<!--<li> <a  href="javascript:void(0);">帮助中心</a> <div class="nav-line"></div> </li>-->

				
			</ul>
		</div>
		<div class="login-box">
			<div  class="phone-400">
				<a href="http://dft.zoosnet.net/LR/Chatpre.aspx?id=DFT46714299&lng=cn">7X24 在线客服</a>
			</div>
			<div class="no_login" style="display: block;">
				<a class="login-btn" href="/login">登录</a><a class="reg-btn" href="/register" onclick="sa.track(&quot;registerBtnClicks&quot;,{platformType:&quot;pc&quot;,position:&quot;头部右上角&quot;,pageUrl:location.href})">注册</a>
			</div>
			<div class="has_login clearfix" style="display: none;">
				<a class="app-btn" alt="应用中心" href="/appcenter">应用中心</a><a id="quit" class="quit-btn" alt="退出" href="javascript:void(0)">退出</a>
			</div>
		</div>
	</div>
</div>


<div class=download>
	<h2>SDK下载</h2> 
	<ul class="sdk-list clearfix"> 
		<li class="sdk-item android"> 
			<div class=item-title>Android</div>
			<a href="#" class="tishi" onclick='sa.track("download",{name:"下载SDK",platformType:"pc",pageUrl:location.href,fileName:"fuqianla_android.zip"})'>立即下载</a> 
		</li> 
		<li class="sdk-item ios"> 
			<div class=item-title>iOS</div> 
			<a href="#" class="tishi" onclick='sa.track("download",{name:"下载SDK",platformType:"pc",pageUrl:location.href,fileName:"fuqianla_ios.zip"})'>立即下载</a> 
		</li> 
		<li class="sdk-item h5"> 
			<div class=item-title>H5</div> 
			<a href="#" class="tishi" onclick='sa.track("download",{name:"下载SDK",platformType:"pc",pageUrl:location.href,fileName:"fuqianla_h5.zip"})'>立即下载</a> 
		</li> 
		<li class="sdk-item pc"> 
			<div class=item-title>PC</div> 
			<a href="#" class="tishi" onclick='sa.track("download",{name:"下载SDK",platformType:"pc",pageUrl:location.href,fileName:"fuqianla_pc.zip"})'>立即下载</a> 
		</li> 
	</ul> 
	<h2>代码样例demo</h2> 
	<ul class="demo-list clearfix"> 
		<li class="demo-item net">
			<div class=item-title>.net</div>
			<a href="#" class="tishi" onclick='sa.track("download",{name:"下载SDK代码样例demo",platformType:"pc",pageUrl:location.href,fileName:"fql-.net-demo.zip"})'>立即下载</a> 
		</li> 
		<li class="demo-item node"> 
			<div class=item-title>node.js</div>
			<a href="#" class="tishi" onclick='sa.track("download",{name:"下载SDK代码样例demo",platformType:"pc",pageUrl:location.href,fileName:"fql-node-demo.zip"})'>立即下载</a> 
		</li> 
		<li class="demo-item python"> 
			<div class=item-title>python</div> 
			<a href="#" class="tishi" onclick='sa.track("download",{name:"下载SDK代码样例demo",platformType:"pc",pageUrl:location.href,fileName:"fql-python-demo.zip"})'>立即下载</a>
		</li>
		<li class="demo-item php"> 
			<div class=item-title>php</div>
			<a href="#" class="tishi" onclick='sa.track("download",{name:"下载SDK代码样例demo",platformType:"pc",pageUrl:location.href,fileName:"fql-php-Demo.zip"})'>立即下载</a> 
		</li> 
	</ul> 
</div>
<script src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(".tishi").click(function(){
	alert('暂无demo');
	return;
});
</script>
<section id="aui-footer">
	<div class="aui-footer">
		<div class="aui-footer-info">
			<div class="aui-container">
				<div class="aui-footer-copy">
					<p>版权所有：聚合通 © 2019 </p>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>