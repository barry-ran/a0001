<?php if($_SERVER['SERVER_NAME']=='pay.gzspkp.cn')die;?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $this->config['sitename']?></title>

<meta name="keywords" content="<?php echo $this->config['keyword']?>" />
<meta name="description" content="<?php echo $this->config['description']?>" />

<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link href="css/common.css?46d2f15adcb9adda01d7" rel="stylesheet">
<link href="css/polyPay.css?46d2f15adcb9adda01d7" rel="stylesheet">
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/home.css">
</head>
<body>
 <!-- header begin 
		 <header id="aui-header">
			<div class="aui-head-box top">
				<div class="aui-container">
					<div class="aui-head-logo">
						<a href="/main" title="聚合通"><img src="/images/logo.png" alt="聚合通"></a>
					</div>
					<div class="aui-head-menu">
						<ul>
							<li><a href="/main">首页</a>
							<li><a href="/product">产品与服务</a></li>
							<li><a  href="/demo">在线体验</a> <div class="nav-line"></div></li>
							<li> <a  href="javascript:void(0);">帮助中心</a> <div class="nav-line"></div> </li>
						</ul>
					</div>
					<div class="aui-head-login">
						<ul>
							<li><a href="/register" class="aui-head-register">注册</a></li>
							<li><a href="/login">登录</a></li>
						</ul>
					</div>
				</div>
			</div>
		</header> 
	 header end -->
	<div class="header pinned">
	<div class="header-main clearfix">
		<h1 id="logo"><a href="/main"><img src="/images/logo.png"></a></h1>
		<div class="nav-box">
			<ul class="nav" id="nav">
				<li class="more"><a href="/main">官网首页</a>
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
	<!-- banner begin -->
		<section id="aui-banner">
			<div id="banner_tabs" class="flexslider">
				<ul class="slides">
					<li class="active">
						<a title=""  href="#">
							<img width="1920" height="482" alt="" style="background: url(images/banner1.jpg) no-repeat center; background-size:cover;" src="images/alpha.png">
						</a>
					</li>
					<li>
						<a title="" href="#">
							<img width="1920" height="482" alt="" style="background: url(images/banner2.jpg) no-repeat center; background-size:cover;" src="images/alpha.png">
						</a>
					</li>
					<li>
						<a title="" href="#">
							<img width="1920" height="482" alt="" style="background: url(images/banner3.jpg) no-repeat center; background-size:cover;" src="images/alpha.png">
						</a>
					</li>
				</ul>
				<ul class="flex-direction-nav">
					<li><a class="flex-prev" href="javascript:;">Previous</a></li>
					<li><a class="flex-next" href="javascript:;">Next</a></li>
				</ul>
				<ol id="bannerCtrl" class="flex-control-nav flex-control-paging">
					<li><a>1</a></li>
					<li><a>2</a></li>
					<li><a>2</a></li>
				</ol>
			</div>
		</section>
	<!-- banner end -->

	<!-- content begin-->
		<section id="aui-content">
			<div class="aui-container">
				<div class="aui-firstBox-title">
					<h1>为企业提供云计算的平台</h1>
					<p>提供最新的云计算应用工能实时更新您的服务云计算的平台</p>
				</div>
				<div class="aui-firstBox-list clearfix">
					<div class="aui-firstBox-list-service">
						<div class="aui-service-img"><img src="img/icon/icon-s1.png" alt=""></div>
						<h2>聚合支付</h2>
						<p>全支付场景覆盖，主流支付通道支持</p>
					</div>
					<div class="aui-firstBox-list-service">
						<div class="aui-service-img"><img src="img/icon/icon-s2.png" alt=""></div>
						<h2>扫码支付</h2>
						<p>专业电商收款工具，线下商户经营必备</p>
					</div>
					<div class="aui-firstBox-list-service">
						<div class="aui-service-img"><img src="img/icon/icon-s3.png" alt=""></div>
						<h2>自动运维</h2>
						<p>以应用为中心，简化管理，提升运维效率</p>
					</div>
						<!--<div class="aui-firstBox-list-service">
						<div class="aui-service-img"><img src="img/icon/icon-s4.png" alt=""></div>
						<h2>一键部署</h2>
						<p>应用为中心，简化应用管理，提升运维效率，支持负载均衡、弹性伸缩、高可靠等。</p>
					</div>
					<div class="aui-firstBox-list-service">
						<div class="aui-service-img"><img src="img/icon/icon-s5.png" alt=""></div>
						<h2>智能管理</h2>
						<p>应用为中心，简化应用管理，提升运维效率，支持负载均衡、弹性伸缩、高可靠等。</p>
					</div>
					<div class="aui-firstBox-list-service">
						<div class="aui-service-img"><img src="img/icon/icon-s6.png" alt=""></div>
						<h2>资源丰富</h2>
						<p>应用为中心，简化应用管理，提升运维效率，支持负载均衡、弹性伸缩、高可靠等。</p>-->
					</div>
				</div>
			</div>
		</section>
	<!-- content end-->

	<!-- second begin-->
		<section>
			<div class="aui-second-box">
				<div class="aui-container">
					<div class="aui-firstBox-title">
						<h1>为什么选择聚合通计算平台</h1>
						<p>经大规模生产环境验证的企业级容器云平台</p>
					</div>
					<div class="aui-second-info">
						<div class="aui-second-info-fl">
							<div class="aui-info-fl-top">
								<h3>极简使用</h3>
								<p>对接文档，极速完成支付接入</p>
							</div>
							<div class="aui-info-fl-top">
								<h3>灵活便利</h3>
								<p>产品服务灵活组合，满足企业多元化需求</p>
							</div>
							<div class="aui-info-fl-top">
								<h3>快速结算</h3>
								<p>商家在线提交，提款快速到达，资金0风</p>
							</div>
						</div>
						<div class="aui-second-info-ce"><img src="img/icon/icon-edn.png" alt=""></div>
						<div class="aui-second-info-fr">
							<div class="aui-info-fl-top">
								<h3>稳定可靠</h3>
								<p>标准化的智能监控系统,基础设施稳定可靠</p>
							</div>
							<div class="aui-info-fl-top">
								<h3>安全保证</h3>
								<p>金融级安全系统，智能监控系统，多重加密</p>
							</div>
							<div class="aui-info-fl-top">
								<h3>增值服务</h3>
								<p>提供产品及技术服务,帮助企业整合互联网资源</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- second end-->

	<!-- web begin -->
		<section id="aui-web">
			<div class="aui-firstBox-title">
				<h1>逾十个行业已在聚合通计算平台</h1>
				<p>助力企业通过聚合通计算实现互联网</p>
			</div>
			<div class="web clearfix">
				<div class="con clearfix">
					<ul>
						<li>
							<img src="images/class1.jpg"/>
							<div class="txt">
								<h3>互联网</h3>
								<p>让互联网在路上走得更远</p>
							</div>
						</li>
						<li>
							<img src="images/class2.jpg"/>
							<div class="txt">
								<h3>教育行业</h3>
								<p>提供各个教育下的解决方案</p>
							</div>
						</li>
						<li>
							<img src="images/class3.jpg"/>
							<div class="txt">
								<h3>金融行业</h3>
								<p>为金融提供云计算</p>
							</div>
						</li>
						<li>
							<img src="images/class4.jpg"/>
							<div class="txt">
								<h3>汽车行业</h3>
								<p>为汽车行业提供一站式服务</p>
							</div>
						</li>
						<li>
							<img src="images/class5.jpg"/>
							<div class="txt">
								<h3>人工智能</h3>
								<p>AI的时代来了</p>
							</div>
						</li>
						<li>
							<img src="images/class6.jpg"/>
							<div class="txt">
								<h3>移动互联</h3>
								<p>提供移动app</p>
							</div>
						</li>
						<li>
							<img src="images/class7.jpg"/>
							<div class="txt">
								<h3>新能源</h3>
								<p>新能源的趋势让世界更美好</p>
							</div>
						</li>
						<li>
							<img src="images/class8.jpg"/>
							<div class="txt">
								<h3>物联网</h3>
								<p>现在是物联网的时代</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>
	<!-- web end -->

	<!-- second begin-->
		<section id="second-box">
			<div class="aui-second-box" style="height:630px;">
				<div class="aui-container">
					<div class="aui-firstBox-title">
						<h1>50,000+ 企业一起使用聚合通</h1>
						<p>目前聚合通服务多家企业，分布在银行、保险、电力、互联网、制造业、教育等领域</p>
					</div>
					<div class="aui-partner clearfix">
						<ul>
							<li><a href="#" target="_blank"><img src="img/icon/ad1.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad2.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad3.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad4.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad5.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad6.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad7.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad8.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad9.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad10.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad11.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad12.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad13.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad14.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad15.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad16.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad17.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad18.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad19.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad20.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad21.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad22.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad23.png" alt=""></a></li>
							<li><a href="#"  target="_blank"><img src="img/icon/ad24.png" alt=""></a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	<!-- second end-->

	<!-- footer begin -->
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
	<!-- footer end -->

</body>
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/slider.js"></script>
	<script type="text/javascript">
	    $(function() {
	        var bannerSlider = new Slider($('#banner_tabs'), {
	            time: 5000,
	            delay: 400,
	            event: 'hover',
	            auto: true,
	            mode: 'fade',
	            controller: $('#bannerCtrl'),
	            activeControllerCls: 'active'
	        });
	        $('#banner_tabs .flex-prev').click(function() {
	            bannerSlider.prev()
	        });
	        $('#banner_tabs .flex-next').click(function() {
	            bannerSlider.next()
	        });
	    });

	    //头部浮动效果
	    var head=$(".head").height();
	    $(window).scroll(function(){
	        var topScr=$(window).scrollTop();
	        if (topScr>head) {
	            $(".top").addClass("fixed");
	        }else{
	            $(".top").removeClass("fixed");
	        }
	    });

	    // 服务行业内容 切换
        $(".con ul li").hover(function(){
            $(this).find(".txt").stop().animate({height:"198px"},400);
            $(this).find(".txt h3").stop().animate({paddingTop:"60px"},400);
        },function(){
            $(this).find(".txt").stop().animate({height:"45px"},400);
            $(this).find(".txt h3").stop().animate({paddingTop:"0px"},400);
        })
	</script>

</body>
</html>