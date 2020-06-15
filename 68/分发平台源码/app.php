<?php
include 'source/system/db.class.php';
include 'source/system/user.php';
$app = explode('/',isset($_SERVER['PATH_INFO']) ?$_SERVER['PATH_INFO'] : NULL);
$info = trim(isset($app[1]) ?SafeSql($app[1]) : NULL);
empty($info) and exit(header('location:'.IN_PATH));
$id = auth_codes($info,'de');
if(is_numeric($id))
{
	$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
}
else
{
	$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_link='$info'");
}
$row or exit(header('location:'.IN_PATH));
$wrong = false;
if(dstrpos($_SERVER['HTTP_USER_AGENT'],array('iphone','ipad','ipod')))
{
	if($row['in_form'] == 'Android')
	{
		if($row['in_kid'])
		{
			exit(header('location:'.getlink($row['in_kid'])));
		}
		else
		{
			$wrong = true;
			$msg = '安卓应用不支持苹果设备';
		}
	}
}
else
{
	if($row['in_form'] == 'iOS')
	{
		if($row['in_kid'])
		{
			exit(header('location:'.getlink($row['in_kid'])));
		}
		else
		{
			$wrong = true;
			$msg = '苹果应用不支持安卓设备';
		}
	}
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
<title>';
echo $row['in_name'];
;
echo ' - ';
echo IN_NAME;
;
echo '</title>
<link href="';
echo IN_PATH;
;
echo 'static/app/download.css" rel="stylesheet">
<link href="';
echo IN_PATH;
;
echo 'static/guide/swiper-3.3.1.min.css" rel="stylesheet">
<link href="';
echo IN_PATH;
;
echo 'static/guide/ab.css" rel="stylesheet">
<style type="text/css">.wechat_tip,.wechat_tip>i{position:absolute;right:10px}.wechat_tip{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;background:#3ab2a7;color:#fff;font-size:14px;font-weight:500;width:135px;height:60px;border-radius:10px;top:15px}.wechat_tip>i{top:-10px;width:0;height:0;border-left:6px solid transparent;border-right:6px solid transparent;border-bottom:12px solid #3ab2a7}.mask img{max-width:100%;height:auto}</style>
<script src="';
echo IN_PATH;
;
echo 'static/guide/zepto.min.js" type="text/javascript"></script>
<script src="';
echo IN_PATH;
;
echo 'static/guide/swiper.jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
';
if(IN_MOBILEPROVISION <1)
{
	;
	echo '
function install_app(_link){
	if(/iphone|ipad|ipod/i.test(navigator.userAgent)){
   		document.getElementById(\'actions\').innerHTML = \'<button style="min-width:43px;width:43px;padding:12px 0;border-top-color:transparent;border-left-color:transparent" class="loading">&nbsp;</button>\';
   		setTimeout("mobile_provision()", 6000);
	}
	location.href = _link;
}
function mobile_provision(){
	document.getElementById(\'actions\').innerHTML = \'<p>正在安装，请按 Home 键在桌面查看</p><button onclick="location.href=\\\'';
	echo IN_PATH;
	;
	echo 'static/app/app.mobileprovision\\\'">立即信任</button>\';
}
';
}
else
{
	;
	echo '
function install_app(_link){
	if(/iphone|ipad|ipod/i.test(navigator.userAgent)){
   		$(\'.mask\').show();
   		$(\'.mask\').html(\'<div class="alert-box"><div class="size-pic"><img id="mq1" src="';
	echo IN_PATH;
	;
	echo 'static/guide/mq1.jpg"><div class="device"><div class="swiper-container1"><div class="swiper-wrapper"><div class="swiper-slide"><img src="';
	echo IN_PATH;
	;
	echo 'static/guide/mq1.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="';
	echo IN_PATH;
	;
	echo 'static/guide/mq2.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="';
	echo IN_PATH;
	;
	echo 'static/guide/mq3.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="';
	echo IN_PATH;
	;
	echo 'static/guide/mq4.jpg"></div></div></div></div></div><div class="alert-btn"><div class="color-bar top-bar"></div><div class="color-bar buttom-bar"></div><a onclick="install_ing(\\\'\' + _link + \'\\\')" class="color-bar text-bar">立即安装</a></div></div>\');
	}else{
   		location.href = _link;
	}
}
function install_ing(_link){
       location.href = _link;
       $(".text-bar")[0].innerHTML = "安装中";
       $(".text-bar").removeAttr("onclick");
       $(".top-bar").css("width", "0.1%");
       setTimeout(function() {
               $(".top-bar").css("width", "0.1%").animate({
                       width:"20%"
               }, 1e3, function() {
                       $("#mq1").hide();
                       $(".device").show();
                       Swiper(".swiper-container1", {
                               nextButton:".next_btn",
                               autoplay:3e3,
                               autoplayStopOnLast:true
                       });
                       $(".top-bar").css("width", "20%").animate({
                               width:"100%"
                       }, 15e3, function() {
                               $(".text-bar")[0].innerHTML = "立即信任";
                               $(".text-bar").attr("onclick", "location.href=\'';
	echo IN_PATH;
	;
	echo 'static/app/app.mobileprovision\'");
                       });
               });
       }, 1e3);
}
';
}
;
echo '</script>
</head>
<body>
';
if(dstrpos($_SERVER['HTTP_USER_AGENT'],array('micromessenger','qq')))
{
	;
	echo '<div class="wechat_tip_content"><div class="wechat_tip"><i class="triangle-up"></i>请点击右上角<br>在';
	echo dstrpos($_SERVER['HTTP_USER_AGENT'],array('iphone','ipad','ipod')) ?'Safari': '浏览器';
	;
	echo '中打开</div></div>
';
}
else
{
	;
	echo '<span class="pattern left"><img src="';
	echo IN_PATH;
	;
	echo 'static/app/left.png"></span>
<span class="pattern right"><img src="';
	echo IN_PATH;
	;
	echo 'static/app/right.png"></span>
';
}
;
echo '<div class="out-container">
	<div class="main">
		<header>
		<div class="table-container">
			<div class="cell-container">
				<div class="app-brief">
					<div class="icon-container wrapper">
						<i class="icon-icon_path bg-path"></i>
						<span class="icon"><img src="';
echo geticon($row['in_icon']);
;
echo '" onerror="this.src=\'';
echo IN_PATH;
;
echo 'static/app/';
echo $row['in_form'];
;
echo '.png\'"></span>
						<span class="qrcode"><img src="';
echo IN_PATH;
;
echo 'source/pack/qrcode/qrcode.php?link=';
echo getlink($row['in_id']);
;
echo '"></span>
					</div>
					<h1 class="name wrapper"><span class="icon-warp" style="margin-left:0px"><i class="icon-';
echo strtolower($row['in_form']);
;
echo '"></i>';
echo $row['in_name'];
;
echo '</span></h1>
					<p class="scan-tips" style="margin-left:170px">扫描二维码下载<br />或用手机浏览器输入这个网址：<span class="text-black">';
echo getlink($row['in_id']);
;
echo '</span></p>
					<div class="release-info">
						<p>版本：';echo $row['in_bsvs'];;echo '（Build： ';echo $row['in_bid'];;echo '）
						<p>APP为：';echo $row['in_form'];;echo '（安装包大小：';echo formatsize($row['in_size']);;echo '）</p>
						<p>　更新于：';echo $row['in_addtime'];;echo '</p>
						<p>　安装统计：';echo $row['in_hits'];;echo '台</p>
                        <p style="font-size:14px;color:#00B2EE;">&nbsp;&nbsp;当前使用：';echo $row['in_team'];;echo '
                    <?php echo $dizhi.$net;?> <p id="time1"/>
                   </div>
					<div id="actions" class="actions">
						';
if(dstrpos($_SERVER['HTTP_USER_AGENT'],array('micromessenger')))
{
	;
	echo '						<button type="button">微信内无法下载应用</button>
						';
}
elseif($wrong)
{
	;
	echo '						<button type="button">';
	echo $msg;
	;
	echo '</button>
						';
}
else
{
	;
	echo '						
						<?php }else{?><font color="red"><em class="lightnum">若出现灰色图标请点击一下图标并耐心等待</em></font>
    <button onclick="install_app(\'';
	echo IN_PATH;
	;
	echo 'source/pack/upload/install/install.php?id=';
	echo $row['in_id'];
	;
	echo '\')">';
	echo getfield('user','in_points','in_userid',$row['in_uid']) ?'下载安装': '开发者点数不足';
	;
	echo '</button>				
						';
}
;
echo '					</div>
				</div>
			</div>
		</div>
		</header>
		';
if($row['in_kid'])
{
	;
	echo '		<div class="per-type-info section">
			<div class="type">
				<div class="info">
					<p class="type-icon">
						<i class="icon-';
	echo strtolower(getfield('app','in_form','in_id',$row['in_kid']));
	;
	echo '"></i>
					</p>
					<p class="version">
						关联版本：';
	echo getfield('app','in_bsvs','in_id',$row['in_kid']);
	;
	echo '（Build ';
	echo getfield('app','in_bvs','in_id',$row['in_kid']);
	;
	echo '）
						文件大小：';
	echo formatsize(getfield('app','in_size','in_id',$row['in_kid']));
	;
	echo '<br>
						更新于：';
	echo getfield('app','in_addtime','in_id',$row['in_kid']);
	;
	echo '					</p>
				</div>
			</div>
			<div class="type">
				<div class="info">
					<p class="type-icon">
						<i class="icon-';
	echo strtolower($row['in_form']);
	;
	echo '"></i>
					</p>
					<p class="version">
						当前版本：';
	echo $row['in_bsvs'];
	;
	echo '（Build ';
	echo $row['in_bvs'];
	;
	echo '）
						文件大小：';
	echo formatsize($row['in_size']);
	;
	echo '<br>
						更新于：';
	echo $row['in_addtime'];
	;
	echo '					</p>
				</div>
			</div>
		</div>
		';
}
;
echo '				
     <div class="footer"><div><div>免责声明：以上内容由『';echo $row['in_name'];echo '』开发者提供内测。</div><div>有问题直接联系『';echo $row['in_name'];echo '』或上传者『';echo $row['in_uname'];echo '』</div><div>本站与『';echo $row['in_name'];echo '』应用无关，不对其内容负责。本站谨为内测应用使用。</div><div>速度哇分发平台仅内测使用，请勿上传非法应用，请自行甄别应用风险。</div><div>如违规违法上传应用一切后果由上传者『';echo $row['in_name'];echo '』承担。</div> <a href="/about/disclaimer" target="_blank">　　　</a> <a href="/" target="_blank">　　　　　　　　　　　　</a><a href="/" target="_blank">速度蛙分发</a>｜<a href="/index.php/log" target="_blank">免责声明</a>
     <a class="one-key-report" style="background:#3DAFEB" href="mailto:<?php echo IN_MAIL;?>">举报应用违规反馈</a>｜<a href="/data/attachment/';echo $row['in_app'];echo '" target="_blank">　　　　　　</a> 


	</div>
</div>
<div class="mask" style="display:none"></div>
';
if(IN_ADPOINTS &&!$row['in_removead'])
{
	;
	echo '<div class="app_bottom_fixed">
	<a href="';
	echo IN_ADLINK;
	;
	echo '" target="_blank"><img src="';
	echo IN_ADIMG;
	;
	echo '"></a>
</div>';
}
;
echo '</body>
</html>';
?>