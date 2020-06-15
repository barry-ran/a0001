
<?php
if(!defined('IN_ROOT'))
{
	exit('Access denied');
}
?>
<!DOCTYPE html>
<html lang="zh">
 <head> 
  <title>企业签名 - <?php echo IN_NAME; ?>免费应用内测托管平台|iOS应用Beta测试分发|Android应用内测分发</title> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, index.php-scalable=no" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
  <meta name="renderer" content="webkit" /> 
  <meta name="keywords" content="<?php echo IN_KEYWORDS; ?>" /> 
  <meta property="og:url" content="https://<?php echo $_SERVER['HTTP_HOST']; ?>/" /> 
  <meta property="og:title" content="<?php echo IN_NAME; ?>" /> 
  <meta name="description" content="<?php echo IN_DESCRIPTION; ?>" /> 
  <link rel="stylesheet" href="/statics/default/css/bootstrap.min.css" /> 
  <link rel="stylesheet" href="/statics/default/css/swiper.min.css" /> 
  <link rel="stylesheet" href="/statics/default/css/base.css" /> 
  <link rel="stylesheet" href="/statics/default/css/main.css" /> 
  <link rel="stylesheet" href="/staticss/css/main.css" />
  <link rel="stylesheet" href="/statics/default/css/h5.css" />
  <link rel="stylesheet" href="/statics/default/css/boot.css" />
  <link rel="stylesheet" href="//at.alicdn.com/t/font_780494_jbelo9fsxsk.css" />
  <script src="/statics/default/js/jquery.min.js"></script> 
  <script src="/statics/default/js/bootstrap.min.js"></script> 
  <script src="/statics/default/js/swiper.min.js"></script> 
  <script src="/statics/default/js/jquery.dotdotdot.js"></script> 
  <script src="/statics/default/js/js.js"></script>
<link rel="stylesheet" href="/statics/css/bootstrap.min.css" />
<link rel="stylesheet" href="/statics/css/swiper.min.css" />
<link rel="stylesheet" href="/statics/css/font.css" />
<link rel="stylesheet" href="/statics/css/spectrum.css">
<link rel="stylesheet" href="/statics/css/jquery.datetimepicker.css">
<link rel="stylesheet" href="/statics/css/base.css" />
<link rel="stylesheet" href="/statics/css/main.css" />
<link rel="stylesheet" href="/statics/css/h5.css" />
<link rel="shortcut icon" href="/statics/css/favicon.ico" type="img/x-icon" />
<script src="/statics/js/fundebug.1.5.1.min.js" apikey="366273526a484dab7a5373fb1288ef3a8d567f391c68f618d3968cacd4de5f71"></script>
<script src="/statics/js/jquery.min.js"></script>
<script src="/statics/js/jquery.datetimepicker.js"></script>
<script src="/statics/js/spectrum.js"></script>
<script src="/statics/js/jquery.lazyload.js"></script>
<script src="/statics/js/bootstrap.min.js"></script>
<script src="/statics/js/swiper.min.js"></script>
<script src="/statics/js/jquery.dotdotdot.js"></script>
<script src="/statics/js/vue.js"></script>
<script src="/statics/js/vue-countup.min.js"></script>
<script src="/statics/js/vue-router.js"></script>
<script src="/statics/js/js.js"></script>
<script>
<script type="text/javascript" src="/statics/pack/layer/jquery.js"></script>
<script type="text/javascript" src="/statics/pack/layer/lib.js"></script>
<script type="text/javascript" src="/statics/index/lib.js"></script>
<script type="text/javascript">
  var in_path = '<?php echo IN_PATH; ?>';
  var in_pay = '<?php echo IN_PAY; ?>';
   </script>
  <script>
	isHideFooter = false;
  </script>
</head>
<body>
<header>
<div class="container">
<div class="header clearfix">
<a class="header-left block fl" href="/">
<img src="/statics/img/logo-top.png" class="img-responsive hidden-xs">
<img src="/statics/img/phone-logo.png" class="img-responsive visible-xs">
</a>
<div class="phone-nav-wrap">
<a class="header-left block fl" href="/">
<img src="/statics/img/phone-logo.png" class="img-responsive visible-xs">
</a>
<ul class="ms-nav fl clearfix">
<li class=" active">
<a href="/" title="">首页</a>
</li>
<li class="">
<a href="/index.php/home" title="">上传应用</a>
</li>
<li class="">
<a href="/index.php/price" title="">分发价格</a>
</li>
<li class="">
<a href="/index.php/webview" title="">封装价格</a>
</li>
<li class="">
<a href="/index.php/qm" title="">签名视频教程</a>
</li>
</ul>
<?php if($GLOBALS['userlogined']){ ?>
                                  <!--登录后-->
                <div class="login-in clearfix">
                                            <a class="name-certified fl" href="<?php echo IN_PATH.'index.php/home'; ?>">应用管理</a>
                                        <div class="login-user clearfix fl">
                                          
                        <span class="fl">
                           <?php echo $GLOBALS['erduo_in_username']; ?></span>
                        <span class="iconfont icon-arrow-bottom fl"></span>
                        <div class="user-wrap">
                            <dl>
                                <dd><a href="<?php echo IN_PATH.'index.php/home'; ?>">应用管理</a></dd>
                                <dd><a href="<?php echo IN_PATH.'index.php/profile_info'; ?>">我的资料</a></dd>
                                <dd><a href="<?php echo IN_PATH.'index.php/profile_verify'; ?>">实名认证</a></dd>
								<dd><a href="<?php echo IN_PATH.'index.php/myorder'; ?>">我的订单</a></dd>
                                <dt><a href="<?php echo IN_PATH.'index.php/logout'; ?>"><span class="iconfont icon-sign-out"></span>退出</a></dt>
                            </dl>
                        </div>
                    </div>
                </div>
                <!--/登录后-->
		<?php }else{ ?>
		<!--登录前-->
				   <ul class="login clearfix fr"> 
			  <li><a href="<?php echo IN_PATH.'index.php/login'; ?>" class="ms-btn ms-btn-default">登录</a></li> 
			  <li><a href="<?php echo IN_PATH.'index.php/reg'; ?>" class="ms-btn ms-btn-primary ml10">注册</a></li>
					</ul>
		<!--/登录前-->
		<?php } ?>
<span class="icon-menu iconfont phone-menu visible-xs"></span>
<div class="phone-shadow"></div>
</div>
</div>
</header><div id="app">
<About-us></About-us>
</div>
<template id="aboutUs">
<div>
<img src="/statics/img/about/0.jpg" style="display: none;">
<img src="/statics/img/about/1.jpg" style="display: none;">
<img src="/statics/img/about/2.jpg" style="display: none;">
<div class="about-banner-wrap" :style="'background-image: url(/statics/img/'+ indexImg + '.jpg)'">
<div class="container">
<div class="about-banner">
<h1>关于我们</h1>
</div>
</div>
</div>
<div class="about-tab-wrap">
<div class="container">
<div class="about-tab clearfix">
<div class="about-tab clearfix">
<a href="us" class="router-link-exact-active router-link-active"><span class="iconfont icon-msg1"></span>关于我们
</a><a href="log" class=""><span class="iconfont icon-time1"></span>免责声明
</a><a href="privacy" class=""><span class="iconfont icon-pwd1"></span>隐私政策
</a><a href="agreements" class=""><span class="iconfont icon-doc1"></span>服务协议
</a><a href="specification" class=""><span class="iconfont icon-doc2"></span>应用审核规范
</a></div>
</div>
</div>
</div>
</div>
</template>
<div class="container">
<div class="about-us">
<div class="tab-1">
<div class="common">
<h1>公司介绍</h1>
<p class="p2">
<?php echo IN_NAME; ?>（<?php echo $_SERVER['HTTP_HOST'];?>）<br>
目前业务主要为开发者提供iOS APP、Android APP的开发、打包、封装、测试、分发等一系列的效率工具，<br>
秉承着“让开发更高效、更简单”的使命，<br>
将一系列的效率工具协同集成，免除繁杂的开发环境部署，降低开发和部署的成本，提升开发者开发效率，提高开发生产力。
</p>
<img class="img-responsive" src="/statics/img/about-1.jpg">
</div>
<div class="common contact-us">
<h1>联系我们</h1>
<div class="contact-con">
<div class="row">
<div class="col-sm-4">
<div class="ms-thumbnail">
<img src="/statics/img/about-2.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">技术支持</div>
<p>使用疑问与解决方案咨询</p>
<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo QQHAO; ?>&site=qq&menu=yes" class="hidden-xs p1">
<span class="iconfont icon-qq"></span>
<span>QQ：<?php echo QQHAO; ?></span>
</a>
<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo QQHAO; ?>&site=qq&menu=yes" class="visible-xs p1">
<span class="iconfont icon-qq"></span>
<span>QQ：<?php echo QQHAO; ?></span>
</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="ms-thumbnail">
<img src="/statics/img/about-3.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">反馈意见</div>
<p>您的建议是我们产品不断改进的动力</p>
<div class="p1 clearfix">
<span class="iconfont icon-feedback"></span>
<span>有问题有建议</span>
<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo QQHAO; ?>&site=qq&menu=yes" target="_blank" class="ms-btn-default ms-btn feedback1">马上反馈</a>
</div>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="ms-thumbnail">
<img src="/statics/img/about-4.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">商务合作</div>
<p>商务合作 欢迎联系</p>
<a class="p1" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo QQHAO; ?>&site=qq&menu=yes">
<span class="iconfont icon-youjian"></span>
<span><span class="__cf_email__" data-cfemail="adcfc9edc9c4cfccdcd883cec2c0"><?php echo IN_MAIL; ?></span></span>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
    // 1.定义路由组件
    var Us = {
        template: "#us"
    };
    var Log = {
        template: "#log"
    };
    var Privacy = {
        template: "#privacy"
    };
    var Agreement = {
        template: "#agreement"
    };
    var Specification = {
        template: "#specification"
    };

    // 2.定义路由
    var routes = [
        // {path: '/', redirect: "/about"}, //history模式下，不再起作用
        {path: '/about/us', component: Us},
        {path: '/about/log', component: Log},
        {path: '/about/privacy', component: Privacy},
        {path: '/about/agreement', component: Agreement},
        {path: '/about/specification', component: Specification}
    ];

    // 3.创建 router 实例，然后传 `routes` 配置
    var router = new VueRouter({
        mode: 'history',
        scrollBehavior: function () {
            return {y: 0}
        },
        // base: __dirname,
        routes: routes
    });

    var AboutUs = {
        template: "#aboutUs",
        data: function () {
            return {
                index: 0,
                indexImg: 0,
                msg: [
                    {"class": "icon-msg1", "text": "关于我们", "router": "us"},
                    {"class": "icon-time1", "text": "免责声明", "router": "log"},
                    {"class": "icon-pwd1", "text": "隐私政策", "router": "privacy"},
                    {"class": "icon-doc1", "text": "服务协议", "router": "agreement"},
                    {"class": "icon-doc2", "text": "应用审核规范", "router": "specification"}
                ]
            }
        },
        components: {
            Us: Us
        },
        methods: {
            tab: function () {
                var This = this;
                $(".about-tab>a").click(function () {
                    var i = $(this).index();
                    // console.log(i);
                    This.index = i;
                    i >= 2 ? This.indexImg = 2 : This.indexImg = i;
                });
            },
        },
        mounted: function () {
            this.tab();
        }
    };
    vm = new Vue({
        el: "#app",
        components: {
            "AboutUs": AboutUs
        },
        router: router
    })
</script>
<!--底部-->
<footer>
    <div class="container">
        <div class="footer hidden-xs">
            <div class="clearfix">
                <div class="fl left clearfix">
                    <dl class="fl">
                        <dt>产品服务</dt>


<dd>&nbsp&nbsp&nbsp<a href="/index.php/signs">企业签名</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="/index.php/price">点数充值</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="/index.php/webview">封装打包</a></dd>
</dl>
<dl class="fl">
<dt>关于我们</dt>
<dd>&nbsp&nbsp&nbsp<a href="/index.php/us">公司简介</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="/index.php/privacy">隐私政策</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="/index.php/log">更新日志</a></dd>
</dl>
<dl class="fl">
<dt>平台协议</dt>
<dd>&nbsp&nbsp&nbsp<a href="/index.php/agreements">服务协议</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="/index.php/specification">审核规范</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="/index.php/agreement">分发协议</a></dd>
</dl>
<dl class="fl">
<dt>联系我们</dt>

<dd>
<a href="javascript:;" target="_blank" class="chatQQ">QQ：<?php echo QQHAO; ?></a>
</dd>

<dd><a href="mailto:<?php echo IN_MAIL; ?>">邮箱：<?php echo IN_MAIL; ?></a></dd>

</dl>
</div>
<div class="right fr clearfix">
<a href="/">
<img src="https://suduwa.com/statics/img/logo-top.png" class="img-responsive visible-xs">
</a>
<div class="clearfix"></div>
<div class="wechat clearfix fr hidden-xs">
<img src="https://suduwa.com//statics/img/shouji.png" alt="" class="fr">
</div>
<div class="clearfix"></div>
<p class="hidden-xs">手机扫描打开本站</p>
<div style="text-align: left; color: #fff; line-height: 28px;" class="visible-xs">
<a href="/user" target="_blank" class="color-white">公司简介</a>
</div>
</div>
</div>
<div class="record">
<div class="inline-block">
<span class="fl">Copyright © 2018-2019 蛙速度分发   <?php echo $_SERVER['HTTP_HOST'];?>   <?php echo IN_ICP; ?></span>
<a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=3500885" style="text-decoration:none; height:20px; line-height:20px; float: left; margin-left: 10px;">


</a>
</div>
</div>
</div>
<div class="footer visible-xs">
<div class="con">
</div>
<p class="p1">Copyright © 2018-2019 <?php echo IN_NAME; ?> 【<?php echo IN_ICP; ?>】</p>
</div>
</div>
</footer>
<!--底部-->

<!--右侧悬浮-->
<ul class="fixed-right right-float-window" style="display: none">
<li>
<a href="javascript:;" target="_blank">
<span class="iconfont icon-qq chatQQ"></span>
</a>
</li>
<li>
<a href="javascript:;">
<span class="iconfont icon-weixin1"></span>
<div class="wechat">
<img src="https://suduwa.com/statics/img/weixin.png" alt="">
            </div>
        </a>
    </li>
    <li class="go-top">
        <a href="javascript:;"><span class="iconfont icon-go-top"></span></a>
    </li>
</ul>
<!--右侧悬浮-->


<!--弹窗-->

<div class="modal fade ms-modal" id="myModalPay" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">购买</h4>
            </div>
            <div class="modal-body">
                <div class="font18 color-333">是否完成了购买？</div>
                <p class="mt15">请在新打开的页面中完成购买，购买完成后，请根据购买结果点击下面的按钮 </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="order_sn" value="">
                <button type="button" class="ms-btn ms-btn-primary complete-pay">支付成功</button>
                <button type="button" class="ms-btn ms-btn-default fail-pay" data-dismiss="modal">支付遇到问题</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade ms-modal" id="paySuccessModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div><span class="icon icon-modal-success1"></span></div>
                    <p class="color-333 bold font16 mt5">购买成功</p>
                    <p class="color-333 mt5"></p>
                    <div class="mt15">
                        <a type="button" class="ms-btn ms-btn-default w90" href="#">确定（3）</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade ms-modal auto-hide-modal" id="submitLoading" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="auto-hide">
                        <span class="icon icon-modal-success3"></span>
                        <div class="mt5">已提交，请稍后...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/弹窗-->

<script src="//pic.dibaqu.com/static/js/clipboard.js?20190903"></script>
<script src="//pic.dibaqu.com/static/js/common.min.js?20190903"></script>
<script>
    if (!isHideFooter) {
        $('.right-float-window').show();
    }

    $(function () {

        $("body").on('click', '.fail-pay', function () {
            $(".pay-money a:last").removeClass("disabled");
            $(".pay-money a:last").addClass("toPay");
        });
        $("body").on('click', '.complete-pay', function () {
            $(".toPay").removeClass('disabled');
            order_sn = $('#myModalPay').find('input[name="order_sn"]').val();
            if (!order_sn) {
                $('#myModalPay').modal('hide');
                return;
            }

            $.post('/order/check-pay', {order_sn: order_sn}, function (result) {
                if (result.code != 200) {
                    $('#myModalPay').modal('hide');
                } else {
                    if (result.data.service_type == 3 || result.data.service_type == 4) {
                        window.location.href = '/publish';
                    } else if (result.data.service_type == 2) {
                        window.location.href = '/sign/upload?step=4&sign_id=' + result.data.goods_id;
                    } else if (result.data.service_type == 1) {
                        window.location.href = '/pack?step=5&id=' + result.data.goods_id;
                    } else if (result.data.service_type == 5) {
                        window.location.href = '/user/order';
                    }

                }
            })

        });

        var windowWidth = $(window).width();
        $("body").on('click', '.chatQQ', function () {
            console.info(windowWidth);
            if (windowWidth <= 750) {
                /*1234567对应的就是需要聊天的客服*/
				window.location.href = "mqqwpa://im/chat?chat_type=wpa&uin=<?php echo QQHAO; ?>&version=1&src_type=web&web_src=oicqzone.com";
			} else {
				window.location.href = "http://wpa.qq.com/msgrd?v=3&uin=<?php echo QQHAO; ?>&site=qq&menu=yes";
            }
        });

        var source_login = 0;
        if (windowWidth <= 750 && source_login) {
            Modal.templateModal({
                imgName: "modal-bg-3.jpg",
                title1: '提示',
                title2: '',
                p: '建议您：<br>尽快<span class="color-danger">电脑</span>登录蛙速度网站，即可享受<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>免费试用封装打包APP<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>每天免费赠送<span class="color-danger">1000</span>次分发下载次数',
                align: 'left', // 居左 left, 居中 center, 居右 right
                btnText: '知道了',
                btnClass: "modal-btn2"
            });
        }

        var num = 3;
        var linkTime = null;
        clearInterval(linkTime);

        function linkfun() {
            if ($("#paySuccessModal").is(":visible")) {
                $("#paySuccessModal a").text('确定（' + num + ')');
                num--;
                if (num <= 0) {
                    var href = $("#paySuccessModal a").attr('href');
                    window.location.href = href;
                }
            }
        }

        linkTime = setInterval(linkfun, 1000);

        $.post("/user/messages/dialog", function (data) {
            if(data.code == 200 && data.data) {
                console.log(data.data.message);
                Modal.generalModal({
                    backdrop: false, // 点击阴影是否关闭弹窗， // true 开启； false 关闭
                    iconClass: "",  // success: icon-modal-success1,  error: icon-modal-error2
                    title: data.data.subject,  // 弹窗标题
                    p: data.data.message, // 弹窗内容
                    align: 'left', // 弹窗内容排列顺序 left center right
                    cancelBtnText: '关闭',    // 取消按钮文字
                    successBtnText: '知道了',  // 确定按钮文字
                    successBtnModal: true, // 点击确定按钮是否关闭弹窗 true 关闭 false 不关闭
                    cancelBtnModal: true, // 点击取消按钮是否关闭弹窗 true 关闭 false 不关闭
                    style:'width:528px',
                    successCallback: function () {

                    },
                    cancelCallback: function () {

                    }
                });
            }
        })
    });


    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?932e6e061f7d4ac477e82f20fd3778c6";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
    //var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    //document.write(unescape("%3Cspan style='display:none' id='cnzz_stat_icon_1275094025'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/z_stat.php%3Fid%3D1275094025' type='text/javascript'%3E%3C/script%3E"));
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128185075-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-128185075-1');
</script>

<!-- Google Analytics -->
<script>
    window.ga = window.ga || function () {
        (ga.q = ga.q || []).push(arguments)
    };
    ga.l = +new Date;
    ga('create', 'UA-128185075-1', 'auto');
    ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<!-- End Google Analytics -->

<!--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
<!--<script>-->
<!--  (adsbygoogle = window.adsbygoogle || []).push({-->
<!--      google_ad_client: "ca-pub-3859964528859854",-->
<!--      enable_page_level_ads: true-->
<!--  });-->
<!--</script>-->

<script>

    function alert(msg, callback, cancelCallback, align, successBtn, cancelBtn) {
        if (!align) align = 'center';
        if (!successBtn) successBtn = '确定';
        Modal.generalModal({
            backdrop: true, // 点击阴影是否关闭弹窗， // true 开启； false 关闭
            iconClass: "",  // success: icon-modal-success1,  error: icon-modal-error2
            title: '',  // 弹窗标题
            p: msg, // 弹窗内容
            align: align, // 弹窗内容排列顺序 left center right
            cancelBtnText: cancelBtn,    // 取消按钮文字
            successBtnText: successBtn,  // 确定按钮文字
            successBtnModal: true, // 点击确定按钮是否关闭弹窗 true 关闭 false 不关闭
            cancelBtnModal: true, // 点击取消按钮是否关闭弹窗 true 关闭 false 不关闭
            successCallback: callback,
            cancelCallback: cancelCallback
        });
    }

    /*(function () {
        var dw = document.createElement("script");
        dw.src = "https://develop.dibaqu.com/webclip-min.js?932e6e061f7d4ac477e82f20fd3778c6";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(dw, s);
    })();*/
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?4d25821e74393774501b6c02f03d2aea";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
    </body>
</html>