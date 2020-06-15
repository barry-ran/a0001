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
<script type="text/javascript" src="/js/yeepay-1.0.js"></script>
<script type="text/javascript" src="/js/baidu_hm.js"></script>

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
<style>
	.qbgg{
		float:left;
		margin-right: 20px;
	}
	.qbgg a{
		color:#A8A8A8;
		text-decoration:none;
	}
	.ggcon{
		width:400px;
		float:left;
		line-height:30px;
	}
	.news-list {
    float: left;
    width: 350px;
}
.news-list li{
    display: none;
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.news-list .block{
    display: block;
}
.news-list li a{
    color: #ffab09;
}
.dir {
    position: absolute;
    top: 0;
    right: 10px;
}

.dir a , .news-dir a {
    float: left;
    width: 10px;
    height: 10px;
    margin-top: 10px;
    background: url("../images/dir-a.png") no-repeat;
}

.dir .bg1 , .news-dir .bg1 {
    background-position: 0 0;
}

.dir .bg2 , .news-dir .bg2 {
    background-position: -10px 0;
}

.dir span , .news-dir span {
    float: left;
    padding: 0 10px;
}
.close {
	float:right;
	margin-right:10px;
    display: block;
    font-family: Arial;
    color: #b5b5b5;
}
.wzlogo{
	float:left;
	margin-right:100px;
}
.wzlogo img{
	height:32px;
}
.wznav{
	float: left;
    font-size: 14px;
}
.nav {
    float: left;
    font-size: 14px;
}

.nav li {
    position: relative;
    z-index: 10;
    float: left;
}

.nav .nav-child {
    display: block;
    padding: 0 20px;
    line-height: 70px;
}.nav .on{
    color: #fff;
    background: #ffab09;
}
.nav .active a {
    color: #fff;
    background: #ffab09;
}
.clearfix:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    overflow: hidden;
}
.menu-nav {
    position: absolute;
    top: 70px;
    left: 0;
    z-index: 10;
    display: none;
    width: 100%;
    padding-bottom: 10px;
    background: #ffab09;
}
.menu-nav p {
    text-align: center;
	height:40px;
	line-height:40px;
}
.menu-nav a {
    color: #fff;
}
.nav-child:hover{
    color: #fff;
	background:#ffab09;
}
.login-box{
    float: right;
    width: 162px;
    height: 10px;
    margin-top: 19px;
    font-size: 14px;
}
.register{
    float: left;
    width: 60px;
    line-height: 32px;
    text-align: center;
}
.register a{
    color: #ffab09;
}

.login{
    float: left;
    width: 60px;
    height: 32px;
    margin-right: 10px;
    line-height: 32px;
    text-align: center;
    background: #ffab09;
}

.login a{
    color: #fff;
}
.login a:hover{
    color: #fff;
}
.login .login-pull{
    position: absolute;
    top: 51px;
    right: 42px;
    display: none;
    width: 120px;
    background: #52bf63;
    text-align: center;
    overflow: hidden;
}

.login-pull p{
    height: 40px;
    line-height: 40px;
    margin-top: -1px;
    border-top: 1px solid #71ce80;
}

.login-pull p a{
    color: #fff;
}
.polyPay .brand-introduce {
    background-color: #f8f8f8;
    height: 138px;
    text-align: center;
    padding-top: 0px;
    padding-bottom: 0;
}
.layout {
        width: 1170px;
		margin-left:auto;
		margin-right:auto;
    }
.yp-news {
    position: relative;
    height: 30px;
    padding: 0 50px 0 20px;
    line-height: 30px;
    border: 1px solid #f3f3f3;
    overflow: hidden;
}

.yp-news li {
    display: none;
}

.yp-news .block {
    display: block;
}

.yp-news li span {
    padding-left: 20px;
}
.wrapper {
        position: inherit;
        z-index: inherit;
        float: inherit;
        width: 100%;
        height: auto;
        overflow: hidden;
    }
	.w-wrapper {
        position: relative;
        width: 100%;
    }

    .wrapper-box {
        width: 100%;
    }
	
	#index {
    position: absolute;
    left: 30px;
    bottom: 10px;
    z-index: 9;
    height: 20px;
    overflow: hidden;
}

#index li {
    float: left;
    width: 16px;
    height: 16px;
    margin: 2px 10px 0 0;
    background: #fff;
    border-radius: 50%;
    cursor: pointer;
}

#index .cur {
    width: 20px;
    height: 20px;
    margin: 0 10px 0 0;
    background: #ffab09;
}
	.carousel {
    position: relative;
    z-index: 8;
    overflow: hidden;
    height: 320px;
}

.carousel li {
    position: absolute;
    z-index: 8;
    width: 100%;
    height: 320px;
    text-align: center;
}

.carousel li img {
    width: 100%;
    height: 100%;
}
</style>
	<div style="width:100%; height:30px; background:#2F2F2F;" id="header-news">
    	<div style="width:1170px; line-height:30px; height:30px; margin-left:auto; margin-right:auto;">
        	<div class="qbgg">
            	<a href="#">全部公告</a>
            </div>
            <div class="ggcon" align="center">
            	<ul class="news-list" id="news-list">
                	<li class=" block"><a target="_blank" href="http://www.yeepay.com/noticeDetail/449">关于《互联网支付产品价格》《互联网支付特约商户服务协议》服务协议条款</a></li>
                    <li class=""><a target="_blank" href="http://www.yeepay.com/noticeDetail/450">关于《线下特约商户银行卡收单标准费率》《线下特约商户银行卡收单受理协议》服务协议条款</a></li>
                    <li class=""><a target="_blank" href="http://www.yeepay.com/noticeDetail/1194">【北京银行系统升级维护通知】</a></li>
                </ul>
				<div class="news-dir">
					<a class="bg1" href="javascript:void (0)" id="pre"></a>
					<span>|</span>
					<a class="bg2" href="javascript:void (0)" id="next"></a>
				</div>
            </div>
            <a target="_blank" href="javascript:void (0)" class="close" onclick="hide(&#39;header-news&#39;)">X</a>
        </div>
    </div>
<script type="text/javascript" src="/js/indexgd.js"></script>
	<div style="width:1170px; line-height:70px; height:70px; margin-left:auto; margin-right:auto;">
    	<div class="wzlogo">
        	<a target="_blank" href="http://7t1.cn/">
            	<img src="/images/logo.png"/>
            </a>
        </div>
        	<ul class="wznav nav clearfix" id="nav">
			<li class="pull-down">
				<a class="nav-child" onMouseMove="qhxlcdclose('gywm')" onMouseOver="qhxlcd('gywm')">关于我们</a>
				<div id="gywm" class="menu-nav" style="display: none;">
					<p><a target="_blank" href="/article/AboutUs/CompanyIntroduction">公司介绍</a></p>
					<p><a target="_blank" href="/article/AboutUs/FounderIntroduction">创始人简介</a></p>
					<p><a target="_blank" href="/article/AboutUs/MilepostPandect">里程碑</a></p>
					<p><a target="_blank" href="/article/AboutUs/Honner">荣誉资质</a></p>
					<p><a target="_blank" href="/article/AboutUs/Partners">合作伙伴</a></p>
					<!--<p><a target="_blank" href="/article/AboutUs/ContactUs/GroupInfo">联系我们</a></p>-->
					<p><a target="_blank" href="/article/AboutUs/ContactUs/HeadquartersInfo">联系我们</a></p>

				</div>
			</li>
			<li class="pull-down">
				<a class="nav-child">行业方案</a>
				<div class="menu-nav" style="display: none;">
					<p><a target="_blank" href="/article/IndustrySolution/AirTravel">航旅</a></p>
					<p><a target="_blank" href="/article/IndustrySolution/Education">教育</a></p>
					<p><a target="_blank" href="/article/IndustrySolution/Telecom">电信</a></p>
					<p><a target="_blank" href="/article/IndustrySolution/Insurance">保险</a></p>
					<p><a target="_blank" href="/article/IndustrySolution/Game">游戏娱乐</a></p>
					<p><a target="_blank" href="/article/IndustrySolution/OnlineToOffline">O2O</a></p>
				</div>
			</li>
			<li>
				<a target="_blank" href="/productCenter/index" class="nav-child">产品中心</a>
			</li>
			<li>
				<a target="_blank" href="/MarketActivity/hotEvents" class="nav-child">市场活动</a>
			</li>
			<li>
				<a target="_blank" href="/customerService" class="nav-child">客服中心</a>
			</li>
			<li>
				<a target="_blank" href="http://gongyi.yeepay.com/index/1" class="nav-child">聚合通公益圈</a>
			</li>
		</ul>
    <div class="login-box clearfix">
			<div class="register"><a target="_blank" href="/register">注册</a></div>
			<div class="login" id="login">
				<a href="/login">登录</a>
				<div class="login-pull" id="login-pull">
					<p><a id="merchantLogin" target="_blank" href="https://www.yeepay.com/selfservice/login.action">商户登录</a></p>
					<p><a id="serviceProviderLogin" target="_blank" href="https://posagent.yeepay.com/agent_portal/toAgentLogin.action">服务商登录</a></p>
					<!--<p><a id="memberLogin" target="_blank" href="https://member.yeepay.com/member/login/index">个人登录</a></p>-->
				</div>
			</div>
			
	  </div>
</div>
        
        
	<div class="layout">
   	  <div class="wrapper">
		<div class="w-wrapper" id="wrapper">
			<div class="wrapper-box">
				<ul class="carousel" id="carousel">
				<li class=" front" style="opacity: 1; z-index: 1;"><img src="/images/1479707791195_banner20161118v2.jpg"></li>
                <li class="" style="opacity: 1.38778e-16; z-index: -1;"><img src="/images/1504576357328_yinlianyunshanfu.jpg"></li>
                <li class="" style="opacity: 1.38778e-16; z-index: -1;"><img src="/images/1504838869171_gwpujijinrongzhishi.jpg"></li>
                <li class="" style="opacity: 1.38778e-16; z-index: -1;"><img src="/images/1505094280900_nonghangwj.jpg"></li>
                <li class="" style="opacity: 1.38778e-16; z-index: -1;"><img src="/images/1504228333003_yinlianyunshanfu20170901.jpg"></li>
                <li class="" style="opacity: 1.38778e-16; z-index: -1;"><img src="/images/1503389827120_yibaogongyiquan20170822.jpg"></li>
                </ul>
               
			</div>
           
		</div>
		
		<div class="yp-news">
			<ul id="news-box">

			<li class=""><a target="_blank" href="http://ed-china.stnn.cc/finance/2017/0330/416665.shtml">聚合通动态 :[ 星岛环球网 ]聚合通支付余晨谈第三方支付：未来在于思维和业务创新</a><span>2017-03-30</span></li>
            <li class=""><a target="_blank" href="http://news.163.com/16/1130/13/C74EE69F000187VI.html">聚合通动态 :[ 网易 ]聚合通支付协办第三届中国·国际高级工商管理管理峰会</a><span>2016-11-30</span></li>
            <li class=""><a target="_blank" href="http://news.163.com/16/1129/17/C72AC4H6000187V5.html">聚合通动态 :[ 网易 ]聚合通支付余晨：打击电信网络诈骗需协同作战</a><span>2016-11-29</span></li>
            <li class=""><a target="_blank" href="http://news.cnfol.com/it/20170116/24166348.shtml">聚合通动态 :[ 中金在线 ]从支付到支付+ 聚合通支付余晨出席第八届中国移动支付年会</a><span>2017-01-16</span></li>
            <li class=""><a target="_blank" href="http://finance.sina.com.cn/roll/2017-01-05/doc-ifxzkhfx4650753.shtml">聚合通动态 :[ 新浪财经 ]聚合通支付首席技术官陈斌：识破陷阱有六招</a><span>2017-01-05</span></li>
            <li class=""><a target="_blank" href="http://www.ceweekly.cn/2017/0224/181672.shtml">聚合通动态 :[ 经济网 ]聚合通联合创始人余晨:支付最高境界是无场景感知</a><span>2017-02-24</span></li>
            <li class=""><a target="_blank" href="http://finance.sina.com.cn/roll/2017-02-13/doc-ifyameqr7454181.shtml">聚合通动态 :[ 新浪财经 ]从支付向"支付+"转型 访聚合通支付联合创始人、总裁余晨</a><span>2017-02-13</span></li>
            <li class=" block"><a target="_blank" href="http://china.huanqiu.com/hot/2017-01/9984439.html">聚合通动态 :[ 环球网 ]移动支付掘金"新蓝海" 聚合通支付全力布局</a><span>2017-01-19</span></li>
            <li class=""><a target="_blank" href="http://www.jiemian.com/article/1136637.html">聚合通动态 :[ 界面 ]聚合通支付余晨：看好支付在三农领域的深入</a><span>2017-02-27</span></li>
            <li class=""><a target="_blank" href="http://www.yuncaijing.com/news/id_8224996.html">聚合通动态 :[ 云财经 ]315安全日 聚合通支付开展第五个支付安全周活动</a><span>2017-03-15</span></li>
            </ul>
			<div class="dir">
				<a class="bg1" href="javascript:void (0)" onclick="newsTab(&#39;pre&#39;)"></a>
				<span>|</span>
				<a class="bg2" href="javascript:void (0)" onclick="newsTab(&#39;next&#39;)"></a>
			</div>
		</div>
        
	</div>
  <script type="text/javascript" src="/js/index.js"></script>
  <script type="text/javascript" src="/js/wrapper.js"></script>
  
<div class="polyPay product">
	
<div class="brand-introduce" style=" margin-top:20px;">
		<ul>
			<li><span>8</span>种支持终端</li>
			<li><span>16</span>种支付通道</li>
			<li><span>28</span>种支付产品</li>
		</ul>
	</div>
	<div class="mod all-scene">
		<h2>支持全部场景</h2>
		<p>
			提供支付接入方案，可在各种场景中流畅交易
		</p>
		


		<div class="main">
			<ul>
				<li><span>电商</span><br>
				E-Commerce<img data-original="images/index-pic-01.jpg" alt="电商" src="images/index-pic-01.jpg" style="display: inline;"></li>
				<li><span>零售</span><br>
				Retail<img data-original="images/index-pic-04.jpg" alt="零售" src="images/index-pic-04.jpg" style="display: inline;"></li>
				<li><span>票务</span><br>
				Tickets<img data-original="images/index-pic-03.jpg" alt="票务" src="images/index-pic-03.jpg" style="display: inline;"></li>
				<li><span>游戏</span><br>
				Games<img data-original="images/index-pic-02.jpg" alt="游戏" src="images/index-pic-02.jpg" style="display: inline;"></li>
				<li><span>金融</span><br>
				Finance<img data-original="images/index-pic-08.jpg" alt="金融" src="images/index-pic-08.jpg" style="display: inline;"></li>
				<li><span>教育</span><br>
				Education<img data-original="images/index-pic-07.jpg" alt="教育" src="images/index-pic-07.jpg" style="display: inline;"></li>
				<li><span>医疗</span><br>
				Medical<img data-original="images/index-pic-05.jpg" alt="医疗" src="images/index-pic-05.jpg" style="display: inline;"></li>
				<li><span>其他</span><br>
				Others<img data-original="images/index-pic-06.jpg" alt="其他" src="images/index-pic-06.jpg" style="display: inline;"></li>
			</ul>
		</div>






	</div>
	<div class="mod flow">
		<div class="flow-clock">
			<div class="hour">
			</div>
			<div class="minute">
			</div>
			<div class="second">
			</div>
		</div>
		<div class="flow-content">
			<h2>快速接入流程</h2>
			<p>
				只需4个步骤即可成功接入
			</p>
			<ul>
				<li>商户注册</li>
				<li>线上测试</li>
				<li>参数配置</li>
				<li>完成接入</li>
			</ul>
		</div>
	</div>
	<div class="pay_product polyPay_product">
		<div class="main">
			<div class="my_title">
				支付产品
			</div>
			<div class="describe">
				 让您在各个场景下轻松实现收款，涵盖手机APP、移动网页<br>
				 PC网页、微信公众号、手机扫码等场景, <a class="tast_href" href="/demo">立即体验</a>吧~
			</div>
			<div class="pay_list">
				
				<div class="tab_cont">
					<div class="pay_scene active all">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								移动支付
							</div>
							</li>
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								手机网站
							</div>
							</li>
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								即时到帐
							</div>
							</li>
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								当面付
							</div>
							</li>
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								声波支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								APP支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								公众号支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								扫码支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								刷卡支付
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机控件
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机网页
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								APP支付
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								移动网页
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								电脑支付
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								PC端
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								聚合通支付
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								聚合通支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left kq">
							<div class="pro_name">
								快钱
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene app">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								移动支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								APP支付
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机控件
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								APP支付
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								聚合通支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene wap">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								手机网站
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								公众号支付
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机网页
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								移动网页
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								聚合通支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene pcweb">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								即时到帐
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								电脑支付
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								PC端
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								聚合通支付
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
							<li class="pro_item left kq">
							<div class="pro_name">
								快钱
							</div>
							<div class="pro_type">
								网银支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene wxpub">
						<ul class="clearfix">
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								公众号支付
							</div>
							</li>
							<li class="pro_item left yl">
							<div class="pro_name">
								银联支付
							</div>
							<div class="pro_type">
								手机网页
							</div>
							</li>
							<li class="pro_item left bd">
							<div class="pro_name">
								百度钱包
							</div>
							<div class="pro_type">
								移动网页
							</div>
							</li>
							<li class="pro_item left jd">
							<div class="pro_name">
								京东支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
							<li class="pro_item left yb">
							<div class="pro_name">
								聚合通支付
							</div>
							<div class="pro_type">
								H5、APP支付
							</div>
							</li>
						</ul>
					</div>
					<div class="pay_scene scancode">
						<ul class="clearfix">
							<li class="pro_item left zfb">
							<div class="pro_name">
								支付宝
							</div>
							<div class="pro_type">
								当面付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								扫码支付
							</div>
							</li>
							<li class="pro_item left wx">
							<div class="pro_name">
								微信支付
							</div>
							<div class="pro_type">
								刷卡支付
							</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="deal">
		<div class="container clearfix">
			<div class="pic left">
				<img src="http://fuqianla.net/css/img/product-deal-pic-1.png?990c9c1882a882757cd1142c64a03c36">
			</div>
			<div class="deal_info right">
				<div class="title">
					交易管理
				</div>
				<div class="describe">
					强大的管理后台<br>
					让您轻松管理交易数据
				</div>
				<a href="/login" class="btn-taste experience">我要体验</a>
			</div>
		</div>
	</div>
	
	<div class="free-registration">
		<span class="des">科技让金融更简单</span><a href="/register" class="btn">免费注册</a>
	</div>

<div class="footer">
	<div class="main clearfix">



		<dl>
			<dt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;©2017 四川聚合通网络科技有限公司&nbsp;&nbsp;&nbsp;&nbsp;鲁ICP备15020510号&nbsp;&nbsp;<img style="position:relative;margin-top:-4px;" src="http://www1.pconline.com.cn/footer/images/ft-ghs.png" alt="图片说明" /></dt>
			
		

		
	</div>
	
</div>






</div>

<script type="text/javascript" src="/js/common.js?46d2f15adcb9adda01d7"></script>
<script type="text/javascript" src="/js/polyPay.js?46d2f15adcb9adda01d7"></script>

</body>
</html>