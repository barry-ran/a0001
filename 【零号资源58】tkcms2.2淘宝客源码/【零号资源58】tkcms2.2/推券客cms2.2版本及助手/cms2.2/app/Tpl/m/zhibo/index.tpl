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
	<title>直播间</title>
	<link rel="stylesheet" href="__STATIC__/tqkwap/css/amazeui.min.css">
	<link rel="stylesheet" href="__STATIC__/tqkwap/css/style.css?111" />
	<link rel="stylesheet" href="__STATIC__/tqkwap/fonts/iconfont.css" />
	<link rel="stylesheet" href="__STATIC__/zhibo/css/reset.css?v=2343" />
	<link rel="stylesheet" href="__STATIC__/zhibo/css/common.css?v=233" />
	<link rel="stylesheet" href="__STATIC__/zhibo/css/live.css?v=204" />
	<link rel="stylesheet" href="__STATIC__/zhibo/css/updown-loading.css?v=233" />
	<link rel="stylesheet" href="__STATIC__/zhibo/css/hongbao.css?v=32" />
	<link rel="stylesheet" href="__STATIC__/zhibo/css/sweet-alert.css?v=2343" />
	<link rel="stylesheet" href="__STATIC__/zhibo/css/flexible.css?v=320032" />
	<yh:load type="js" href="__STATIC__/tqkwap/js/jquery.min.js,__STATIC__/tqkwap/js/mui.js,__STATIC__/zhibo/js/iscroll.js,__STATIC__/zhibo/js/live-updown-loading.js,__STATIC__/zhibo/js/live.js,__STATIC__/zhibo/js/flexible.js" />
	<script src='https://cdn.bootcss.com/socket.io/2.0.4/socket.io.js'></script>
	<style type="text/css">
		.loading{border: none;background: none;}
	</style>
</head>
<body>
	
	<div id="full" class="clearfix">
		<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
			<div class="am-header-left am-header-nav">
				<a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">优惠直播</h1>
		</header>
		<div class="bg-xuhua"></div>
		<div class="viewport">
			<div class="live-box">
			</div>
			<!--商品内容-->
			<div id="wrapper">
				<div class="live-product-content" id="scroller">
					<div class="live-main-box" id="content">
						<div class="pullDownLabel"></div>
						<div class="live-product-box">
						</div>
						<volist id="val" name="list">
							<div class="live-product-box">
								<div class="live-prod-time"><span>{$val.push_time}</span></div>
								<div class="live-prod-pic">
									<img class="user-icon" src="{$avatar}" />
									<div class="lpi-desc">
										<div class="ltxjiao"></div>
										<a target="_top" href="{$mdomain}/?g=m&m=detail&id={$val.id}">
											<img src="{$val.pic_url}_220x220.jpg" />
										</a>
									</div>
								</div>

								<div class="live-prod-text">
									<img class="user-icon" src="{$avatar}" />
									<a target="_top" href="{$mdomain}/?g=m&m=detail&id={$val.id}">
										<div class="lpt-desc">
											<div class="ltxjiao"></div>
											<p class="lpt-desc-con">原价{$val.price}元,【券后只要{$val.coupon_price}元】<br/>{$val.title}</p>
											<div class="lpt-desc-buy">
												<div class="lpt-desc-num"><label></label>领券省{$val.coupon}元</div>
												<div class="lpt-desc-buynow"><span>领券购买</span></div>
											</div>
										</div>
									</a>
								</div>

							</div>


						</volist>	 

					</div>

				</div>
			</div>
		</div>

		<!--hongbao-->

		<div id="petalbox">

		</div>

	</div>
	<script type="text/javascript" src="__STATIC__/zhibo/js/hb.js?v=3330"></script>
	<script language="JavaScript">
		function zhibo(){
			$.ajax({ 
				url: "{:U('zhibo/zhibo_push')}",  
				type:'get',
				dataType: "json",
				timeout :5000,
				async: true,
				success: function(data){
					if(data.state == "yes"){
						var info = data.result;
						var prohtml='<div class="live-product-box"><div class="live-prod-time"><span>'+info[0].push_time+'</span></div><div class="live-prod-pic"><img class="user-icon"src="{$avatar}"/><div class="lpi-desc"><div class="ltxjiao"></div><a target="_top"href="{$mdomain}/?g=m&m=detail&id='+ info[0].id +'"><img src="'+info[0].pic_url+'_220x220.jpg"/></a></div></div><div class="live-prod-text"><img class="user-icon"src="{$avatar}"/><a target="_top"href="{$mdomain}/?g=m&m=detail&id='+info[0].id+'"><div class="lpt-desc"><div class="ltxjiao"></div><p class="lpt-desc-con">原价'+info[0].price+'元,【券后只要'+info[0].coupon_price+'元】<br/>'+info[0].title+'</p><div class="lpt-desc-buy"><div class="lpt-desc-num"><label></label>领券省'+info[0].coupon+'元</div><div class="lpt-desc-buynow"><span>领券购买</span></div></div></div></a></div></div>';
						$('#content .live-product-box:last').after(prohtml);
						myScroll.refresh();
						myScroll.scrollToElement(document.querySelector('#content .live-product-box:last-child'),0);
					}

				}
			});	
		}

		$(document).ready(function() {
			var t2 = window.setInterval("zhibo()",60000);
		});
	</script>

	<include file="public:foot_nav" />
</body>
</html>