<!DOCTYPE html>  
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no" />
		<meta name="x5-orientation" content="portrait">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<title>超级搜券</title>
		<link rel="stylesheet" href="__STATIC__/tqkwap/css/amazeui.min.css">
		<link rel="stylesheet" href="__STATIC__/tqkwap/css/style.css?111" />
		<link rel="stylesheet" href="__STATIC__/tqkwap/fonts/iconfont.css" />
		<link rel="stylesheet" href="__STATIC__/zhibo/css/reset.css?v=2343" />
		<link rel="stylesheet" href="__STATIC__/zhibo/css/common.css?v=233" />
		<link rel="stylesheet" href="__STATIC__/zhibo/css/live.css?v=3" />
		<link rel="stylesheet" href="__STATIC__/zhibo/css/updown-loading.css?v=233" />
		<link rel="stylesheet" href="__STATIC__/zhibo/css/flexible.css?v=320032" />
		<yh:load type="js" href="__STATIC__/tqkwap/js/jquery.min.js,__STATIC__/zhibo/js/iscroll.js,__STATIC__/zhibo/js/live-updown-loading.js,__STATIC__/zhibo/js/live.js,__STATIC__/zhibo/js/flexible.js" />
	</head>
	<body>
	<div id="full" class="clearfix">
	<div class="header">
	</div>
	<div class="bg-xuhua"></div>
	<div class="viewport">
		<div class="live-box">
			<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">超级搜券</h1>
 		</header>
			
		</div>
		<!--商品内容-->
		<div id="wrapper">
			<div class="live-product-content" id="scroller">
		 <div class="live-main-box" id="content">
		  <div class="pullDownLabel"></div>
			<div class="live-product-box">
			</div>
			<if condition="$status eq 'yes'">
			<div class="live-product-box">
						<div class="live-prod-text">
							<img class="user-icon" src="{$avatar}" />
							<a target="_top" href="javascript:;">
							<div class="lpt-desc">
								<div class="ltxjiao"></div>
						<a href="__STATIC__/tqkwap/images/explain.jpg" alt="如何查找商品优惠券" title="如何查找商品优惠券" style="width: 100%; font-size: 20px;"><p class="lpt-desc-con">如何查找商品优惠券？</p></a> 
							</div>
						</a>
						</div>
					</div>
			</if>
		
				<volist id="val" name="list">
					<div class="live-product-box">
						<div class="live-prod-pic">
							<img class="user-icon" src="{$avatar}" />
							<div class="lpi-desc">
								<div class="ltxjiao"></div>
								<a href="{$mdomain}{$val.Url}">
									<img src="{$val.PicUrl}_220x220.jpg" />
								</a>
							</div>
						</div>

						<div class="live-prod-text">
							<img class="user-icon" src="{$avatar}" />
							<a href="{$mdomain}{$val.Url}{$trackurl}">
							<div class="lpt-desc">
								<div class="ltxjiao"></div>
								<p class="lpt-desc-con">{$val.Title}</p>
								<div class="lpt-desc-buy">
									<div class="lpt-desc-num"><label></label>领券省{$val.coupon}元</div>
										<div class="lpt-desc-buynow"><span>领券购买</span></div>
								</div>
							</div>
						</a>
						</div>
					</div>
				</volist>	 
	
	<if condition="$status eq 'no'">
	    <div class="live-product-box">
						<div class="live-prod-text">
							<img class="user-icon" src="{$avatar}" />
							<a target="_top" href="javascript:;">
							<div class="lpt-desc">
								<div class="ltxjiao"></div>
								<p class="lpt-desc-con">抱歉！没有找到此商品的优惠信息。</p>
								
							</div>
						</a>
						</div>
					</div>
			</if>
				
				
				
					</div>
				</div>
				
				
			</div>
			
	
			
	</div>
	

</div>
	<div class="input-box-bot" id="input-box-bot">
		<form action="{:U('so/index')}"  id="so" method="post">
			<div class="center-input">
				<input type="hidden" name="key" class="barrage-txt" placeholder="粘贴手淘分享内容到这里" id="barrageTxt" required="required"/>
				<div contenteditable="true" class="Input_text" id="msg-text" placeholder="粘贴手淘分享内容到这里"></div> 
			</div>
			<button type="submit" class="input-send-btn barrage-send">搜索</button>
		</form>
	</div>	
<script>
	
$('#msg-text').focus(function(){
   setTimeout(function() {
    scrollToEnd();
    $(".input-box-bot").css("transform","translateY(-30px)")
   }, 200)
 })
var interval
function scrollToEnd(){
 interval = setInterval(function(){
	var top=document.body.scrollTop;	
      $("#input-box-bot").scrollTop(top);
  },500)
}

$('#msg-text').blur(function(){
$('#barrageTxt').val($("#msg-text").html());
  clearInterval(interval);
  $(".input-box-bot").css("transform","translateY(0)")
})

</script>
</body>
</html>