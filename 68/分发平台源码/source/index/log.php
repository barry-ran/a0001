
<!doctype html>
<html lang="zh">
<head>
<title>免责声明-<?php echo IN_NAME; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="renderer" content="webkit">
<meta name="keywords" content="">
<meta property="og:url" content="<?php echo IN_NAME; ?>">
<meta property="og:title" content="<?php echo IN_NAME; ?>">
<meta name="baidu-site-verification" content="WDULFadCJ9" />
<meta name="description" content="">
<link rel="stylesheet" href="/statics/css/bootstrap.min.css" />
<link rel="stylesheet" href="/statics/css/swiper.min.css" />
<link rel="stylesheet" href="/statics/css/font.css" />
<link rel="stylesheet" href="/statics/css/spectrum.css">
<link rel="stylesheet" href="/statics/css/jquery.datetimepicker.css">
<link rel="stylesheet" href="/statics/css/base.css" />
<link rel="stylesheet" href="/statics/css/main.css" />
<link rel="stylesheet" href="/statics/css/h5.css" />
<link rel="shortcut icon" href="/statics/css/favicon.ico" type="image/x-icon" />
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
        isHideFooter = false;
        var static_version = 201903191305;
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
<a href="jc" title="">签名视频教程</a>
</li>
<li class="">
<a href="sign" title="">企业签名</a>
</li>
<li class="">
<a href="docs" title="">文档中心</a>
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
<h1>免责声明</h1>
</div>
</div>
</div>
<div class="about-tab-wrap">
<div class="container">
<div class="about-tab clearfix">
<div class="about-tab clearfix">
<a href="us" class=""><span class="iconfont icon-msg1"></span>关于我们
</a><a href="log" class="router-link-exact-active router-link-active"><span class="iconfont icon-time1"></span>免责声明
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
<div class="tab-2">
<div class="update-log-wrap">
<div class="update-log">
<div class="con clearfix">
<div class="u-left fl">
<dl>
</dl>
</div>
<div class="u-right fl clearfix">
<span></span>
</span>
<dl>
</dl>
</div>
</div>
<div class="con clearfix">
<div class="u-left fl">
<dl>
<dt>免责声明</dt>
<dd>郑重声明</dd>
</dl>
</div>
<div class="u-right fl clearfix">
<span class="u-icon fl">
<span></span>
</span>
<dl>
<dt>免责声明</dt>
<dd>在您使用速度哇分发平台之前，请仔细阅读本声明的所有条款，您一旦选择使用本平台下载链接，即表明您无条件地接受本声明，您应遵守本声明和相关法律的规定。</dd>
<dd>　　　　</dd>
<dd>第一条：速度哇分发平台为第三方应用提供应用反馈收集等服务。应用内容均来源于第三方产品，速度哇分发仅为用户提供下载支持，不涉及任何人工编辑和整理，也不对任何来源于第三方的内容（包括但不限于安装包安全、信息描述、应用截图）承担责任，用户可根据描述场景谨慎选择下载试用，并独立承担可能产生的不利后果和责任。</dd>
<dd>　　　　</dd>
<dd>第二条：应用下载者经由本平台下载的或取得的任何资料，应谨慎判断并风险自担。因该等使用导致用户产生任何形式费用或者电脑、手机系统损坏或资料流失，用户应负完全责任，本平台对直接、间接、偶然、特殊及继起的损害不负责任。 </dd>
<dd>　　　　</dd>
<dd>第三条:速度哇分发平台提供的所有信息任何公司、产品或者个人认为速度哇分发平台涉嫌侵犯您的版权或应用权，您应该及时向我们提供举报声明、书面权利通知，并提供身份证明、权属证明及侵权情况等投诉材料，我们将依法进行处理。  </dd>
<dd>　　　　</dd>
<dd>第四条：若应用下载者与应用上传者发生纠纷，请自行与上传者协商处理，协商无果请到相关部门进行投诉，或者拨打110警方介入，本平台不承担任何责任。 特别提醒：用户在使用本平台下载、浏览、阅读的过程中，应用所有者或者权利人可能需要对应用更新的信息、服务、内容等另行向用户收取费用，此部分费用完全由该应用所有者或者权利人收取，与本平台无关。 </dd>
</dl>
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

<footer>
<div class="container">
<div class="footer hidden-xs">
<div class="clearfix">
<div class="fl left clearfix">
<dl class="fl">
<dt>产品服务</dt>
<dd>&nbsp&nbsp&nbsp<a href="qianming">企业签名</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="cihsu">托管分发</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="webview">免签封装</a></dd>
</dl>
<dl class="fl">
<dt>关于我们</dt>
<dd>&nbsp&nbsp&nbsp<a href="us">公司简介</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="privacy">隐私政策</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="log">免责声明</a></dd>
</dl>
<dl class="fl">
<dt>平台协议</dt>
<dd>&nbsp&nbsp&nbsp<a href="agreements">服务协议</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="specification">审核规范</a></dd>
<dd>&nbsp&nbsp&nbsp<a href="agreement">分发协议</a></dd>
</dl>
<dl class="fl">
<dt>联系我们</dt>

<dd>
<a href="javascript:;" target="_blank" class="chatQQ">QQ：1379898507</a>
</dd>

<dd><a href="mailto:1379898507@qq.com">邮箱：1379898507@qq.com</a></dd>

</dl>
</div>
<div class="right fr clearfix">
<a href="/">
<img src="https://05o.cn/statics/img/logo-top.png" class="img-responsive visible-xs">
</a>
<div class="clearfix"></div>
<div class="wechat clearfix fr hidden-xs">
<img src="/static/weixin.png" alt="" class="fr">
</div>
<div class="clearfix"></div>
<p class="hidden-xs">微信扫描二维码</p>
<div style="text-align: left; color: #fff; line-height: 28px;" class="visible-xs">
<a href="/" target="_blank" class="color-white">公司简介</a>

<div>速度哇云版权所有</span></div>
</div>
</div>
</div>
<div class="record">
<div class="inline-block">
<span class="fl">Copyright © 2018-2019 速度哇分发 bichuse.com 速度哇云分发系统 版权所有 <?php echo IN_ICP; ?></span>
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
<img src="/statics/img/weixin.png" alt="">
</div>
</a>
</li>
<li class="go-top">
<a href="javascript:;"><span class="iconfont icon-go-top"></span></a>
</li>
</ul>


<!--<div class="modal fade ms-modal" id="myModalPay" tabindex="-1" role="dialog">
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
</div>   -->

<script data-cfasync="false" src="/statics/css/email-decode.min.js"></script><script src="/statics/js/clipboard.js"></script>
<script src="/statics/js/common.min.js"></script>
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
                        window.location.href = '//order';
                    }

                }
            })

        });

        var windowWidth = $(window).width();
        $("body").on('click', '.chatQQ', function () {
            console.info(windowWidth);
            if (windowWidth <= 750) {
                /*1234567对应的就是需要聊天的客服*/
                window.location.href = "mqqwpa://im/chat?chat_type=wpa&uin=1379898507&version=1&src_type=web&web_src=oicqzone.com";
            } else {
                window.location.href = "http://wpa.qq.com/msgrd?v=3&uin=1379898507&site=qq&menu=yes";
            }
        });

        var source_login = 0;
        if (windowWidth <= 750 && source_login) {
            Modal.templateModal({
                imgName: "modal-bg-3.jpg",
                title1: '提示',
                title2: '',
                p: '建议您：<br>尽快<span class="color-danger">电脑</span>登录速度哇分发网站，即可享受<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>免费测试签名APP<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>每天免费赠送<span class="color-danger">100</span>次分发下载次数',
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

<script>
    window.ga = window.ga || function () {
        (ga.q = ga.q || []).push(arguments)
    };
    ga.l = +new Date;
    ga('create', 'UA-128185075-1', 'auto');
    ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>








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
    /*(function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();*/

    /*(function () {
        var dw = document.createElement("script");
        dw.src = "https://develop.dibaqu.com/webclip-min.js?932e6e061f7d4ac477e82f20fd3778c6";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(dw, s);
    })();*/
<!-- jQuery -->
<script src=https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js></script>
<!-- Bootstrap Core JavaScript -->
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->
<script src="https://cdn.staticfile.org/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="/index/js/clipboard.js"></script>
<script src="/index/js/swiper.min.js"></script>
<script src="/index/js/js.js?v=1.25"></script>
<!--禁止右键代码-->
<script>
    document.oncontextmenu = new Function("event.returnValue=false;"); //禁止右键功能
    document.onkeydown = MM_KeyPress;
    function MM_KeyPress(num) {
        //防止系统退格键
        var keycode = event.keyCode;
        if (keycode == 8)//屏蔽退格健
        {
            event.keyCode = 0;
            return;
        }
        if (keycode >= 122 && keycode <= 123)//屏蔽f12功能键
        {
            event.keyCode = 0;
            event.returnValue = false;
            return;
        }
    }
</script>
<script>
    function fuckyou() {
        window.close(); //关闭当前窗口(防抽)
        window.location = ":blank"; //将当前窗口跳转置空白页
    }
    function ck() {
        console.profile();
        console.profileEnd();
        //我们判断一下profiles里面有没有东西，如果有，肯定有人按F12了，没错！！
        if (console.clear) {
            console.clear()
        }
        ;
        if (typeof console.profiles == "object") {
            return console.profiles.length > 0;
        }
    }
    function hehe() {
        if ((window.console && (console.firebug || console.table && /firebug/i.test(console.table()) )) || (typeof opera == 'object' && typeof opera.postError == 'function' && console.profile.length > 0)) {
            fuckyou();
        }
        if (typeof console.profiles == "object" && console.profiles.length > 0) {
            fuckyou();
        }
    }
    hehe();
    window.onresize = function () {
        if ((window.outerHeight - window.innerHeight) > 200)
//判断当前窗口内页高度和窗口高度，如果差值大于200，那么呵呵
            fuckyou();
    }
</script>
<script>
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