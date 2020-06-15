
<!doctype html>
<html lang="zh">
<head>
<title><?php echo IN_NAME; ?>-领先的应用服务平台|免费的app封装打包-IPA签名-苹果企业签名-ios企业账号-内测分发托管</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, mini
                               mum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="renderer" content="webkit">
<meta name="keywords" content="内测分发平台,企业签名,苹果企业签名,ios签名,app自动更新,网页一键封装,app在线生成平台,app打包封装">
<meta property="og:url" content="<?php echo IN_NAME; ?>">
<meta property="og:title" content="<?php echo IN_NAME; ?>">
<meta name="baidu-site-verification" content="WDULFadCJ9" />
<meta name="description" content="<?php echo IN_NAME; ?>提供制作苹果IOS、安卓Android手机APP、内测分发托管、ios企业签名、版本自动更新等功能,是一家高效的移动应用解决方案的服务平台">
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
        isHideFooter = false;
        var static_version = 2019032701;
    </script>
</head>
<body>
<header>
<div class="container">
<div class="header clearfix">
<a class="header-left block fl" href="/">
<img src="/statics/img/logo-top.png" class="img-responsive hidden-xs">
<img src="/statics/img/logo-top.png" class="img-responsive visible-xs">
</a>
<div class="phone-nav-wrap">
<a class="header-left block fl" href="/">
<img src="/statics/img/logo-top.png" class="img-responsive visible-xs">
</a>
<ul class="ms-nav fl clearfix">
<li class=" active">
<a href="/" title="">首页</a>
</li>
<li class="">
<a href="user/price" title="">签名分发价格</a>
</li>
 <li class="">
<a href="user/webview" title="">免签封装/标准封装</a>
</li>
<li class="">
<a href="jc.mp4" title="">自助在线签名教程</a>
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
                            </div>
            <span class="icon-menu iconfont phone-menu visible-xs"></span>
            <div class="phone-shadow"></div>
        </div>
    </div>
</header><script>
    isHideFooter = false;
</script>
<style>
    .ie_dialog {
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: #FAFAFA !important;
        display: none;
    }
    .ie_dialog table{
        margin: 100px auto;
    }
    .ie_notice .logo_osc {
        display: block;
        margin: 0 auto;
        padding-bottom: 24px;
    }

    .ie_notice h2, .ie_notice h4 {
        margin: 0;
        text-align: center;
    }

    .ie_notice .title {
        font-size: 28px;
        color: #4A4A4A;
    }

    .ie_notice .subtitle {
        font-size: 20px;
        color: #9B9B9B;
        font-weight: normal;
    }

    .ie_notice .ie_box {
        width: 560px;
        margin: 24px auto;
        background: #FFFFFF;
        border: 1px solid #E6E6E6;
        box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.10);
        border-radius: 4px;
        display: table !important;
    }

    .ie_notice .ie_box .desc {
        font-size: 14px;
        color: #6D6D6D;
        line-height: 22px;
        padding: 20px;
    }

    .ie_notice .ie_box a {
        display: inline-block;
        width: 30%;
        text-align: center;
    }

    .ie_notice .ie_box .go {
        width: 100%;
        background: #F6F6F6;
        font-size: 16px;
        color: #9B9B9B;
        padding: 16px 0;
        text-align: center;
        border: none;
        margin-top: 20px;
        text-decoration: none;
    }

    .ie_notice .ie_box a img {
        border: none;
    }
</style>
<div id="app">
    <div>
        <!--banner-->
        <div class="index-banner">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <a href="/index.php/home" class="hidden-xs" style="background: url(/statics/img/index-banner-1.jpg?20190108?20190903) no-repeat center;">
                            <div class="container">
                                <div class="banner-con con1 hidden-xs">
                                    <div class="h1">内测发布上传</div>
                                    <div class="h2">
                                        一键上传APP至蛙速度平台，生成下载链接和二维码，支持安卓苹果应用合并二维码<br>
                                        每天赠送<i>1000</i>次下载<span><i>CDN</i>高速下载</span><span>最大支持<i>1.5G</i>的APP</span>
                                    </div>
                                    <button href="index.php/home" class="ms-btn">立即发布</button>
                                </div>
                            </div>
                        </a>
                        <a href="/publish" class="visible-xs" style="background: url(/statics/img/index-banner-1-1.jpg?20190108?20190903) no-repeat center;">
                            <div class="container">
                                <div class="banner-con con1 visible-xs">
                                    <div class="h1">内测发布上传</div>
                                    <div class="h2">
                                        每天赠送<i>1000</i>次下载<span style="margin-left: 10px !important;"><i>CDN</i>高速下载</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="/zhizuo" class="visible-xs" style="background: url(/statics/img/index-banner-3-1.jpg?20180108?20190903) no-repeat center;" class="clearfix">
                            <div class="container">
                                <div class="banner-con con3">
                                    <div class="h1">在线封装APP</div>
                                    <div class="h2">
                                        只需一个网站链接，即可生成APP
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide" id="sign-div">
                        <a href="/index.php/signs" class="hidden-xs" style="background: url(/statics/img/index-banner-sign.jpg?2019.329?20190903) no-repeat center;">
                            <div class="container">
                                <div class="banner-con con2">
                                    <div class="h1">企业证书 APP签名</div>
                                    <div class="h2">
                                        使用企业签名后，APP可以免于提交商店审核，直接安装到手机和平板上<br>
                                        24小时自助在线签名，无限制安装<br>
                                        1天免费试用
                                    </div>
                                    <button href="/index.php/signs" class="ms-btn">立即签名</button>
                                </div>
                            </div>
                        </a>
                        <a href="/index.php/signs" class="visible-xs" style="background: url(/statics/img/index-banner-2-1.jpg) no-repeat center;">
                            <div class="container">
                                <div class="banner-con con2 visible-xs">
                                    <div class="h1">iOS企业证书签名</div>
                                    <div class="h2">
                                        7*24小时在线自助签名，无限制安装
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide" id="pack-div">
                        <a href="/index.php/webview" class="hidden-xs" style="background: url(/statics/img/index-banner-4.jpg?20190903) no-repeat center;" class="clearfix">
                            <div class="container">
                                <div class="banner-con con4 hidden-xs">
                                    <div class="h1">永不闪退版苹果APP在线封装</div>
                                    <div class="h2">
                                        蛙速度全球首创技术，永久解决苹果APP签名闪退的问题<br>
                                        在线打包苹果APP，不用企业签名，无需上架，直接安装<br>
                                        100%完美适配移动端
                                    </div>
                                    <button href="index.php/webview" class="ms-btn">立即封装</button>
                                </div>
                            </div>
                        </a>
                        <a href="/index.php/webview" class="visible-xs" style="background: url(/statics/img/index-banner-4-1.jpg?20190903) no-repeat center;" class="clearfix">
                            <div class="container">
                                <div class="banner-con con4">
                                    <div class="h1">永不闪退版苹果APP在线封装</div>
                                    <div class="h2">永久解决苹果APP签名闪退的问题</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <!--
                        <div class="swiper-button-next"><span class="iconfont icon-arrow-right"></span></div>
                        <div class="swiper-button-prev"><span class="iconfont icon-arrow-left"></span></div>
                -->
            </div>
        </div>
        <!--/banner-->

        <!--publicity-->
        <div class="publicity-wrap">
            <div class="container">
                <ul class="publicity clearfix">
                    <li class="clearfix" id="pack-li">
                        <a href="/zhizuo">
                            <div class="img-wrap"><img src="/statics/img/index-1.png?20190903" class="img-responsive"></div>
                            <div class="p-right">
                                <div class="tit">封装APP</div>
                                <div class="blue-line"></div>
                                <p>自助式操作，功能齐全，2分钟，网站快速变成APP </p>
                            </div>
                        </a>
                    </li>
                    <li class="clearfix" id="publish-li" style="display: none;">
                        <a href="/publish">
                            <div class="img-wrap"><img src="/statics/img/index-2.png?20190903" class="img-responsive"></div>
                            <div class="p-right">
                                <div class="tit">超大应用内测分发</div>
                                <div class="blue-line"></div>
                                <p>支持超大APP上传，生成下载链接和二维码</p>
                            </div>
                        </a>
                    </li>
                    <li class="clearfix" id="sign-li">
                        <a href="/sign">
                            <div class="img-wrap"><img src="/statics/img/index-2.png?20190903" class="img-responsive"></div>
                            <div class="p-right">
                                <div class="tit">企业签名</div>
                                <div class="blue-line"></div>
                                <p>免越狱无限制安装，无需上架苹果商店，长久稳定</p>
                            </div>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="/publish">
                            <div class="img-wrap"><img src="/statics/img/index-3.png?20190903" class="img-responsive"></div>
                            <div class="p-right">
                                <div class="tit">内测分发</div>
                                <div class="blue-line"></div>
                                <p>一键上传安装包，生成下载链接和二维码，每日免费赠送1000次</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--publicity-->

        <!--打包封装APP-->
        <div class="container">
            <div class="index-encapsulation index-common">
<h1>在线签名APP</h1>
<h4>只要一个ipa文件，5分钟极速签名APPP</h4>
<ul class="clearfix e-list">
<li>
<div class="ms-thumbnail">
<img src="/statics/img/index-4.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">快速</div>
<p>腾讯云CND极速上传<br>国外G口极速下载</p>
</div>
</div>
</li>
<li>
<div class="ms-thumbnail">
<img src="/statics/img/index-5.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">免费试用</div>
<p>任何一款APP都可测试签名<br>方便用户测试</p>
</div>
</div>
</li>
<li>
<div class="ms-thumbnail">
<img src="/statics/img/index-6.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">自助式</div>
<p>在线自助操作点点鼠标<br>即可在线签名APP</p>
</div>
</div>
</li>
<li>
<div class="ms-thumbnail">
<img src="/statics/img/index-7.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">证书多</div>
<p>提供3个独立证书签名<br>备用5个证书替换</p>
</div>
</div>
</li>
<li>
<div class="ms-thumbnail">
<img src="/statics/img/index-8.png?201901" class="img-responsive">
<div class="ms-caption">
<div class="tit">主动适配</div>
<p>适配安卓和苹果的主流机型<br>均可在线内测分发</p>
</div>
</div>
</li>
</ul>
<a class="ms-btn ms-btn-secondary ms-btn-lg" href="/index.php/signs">立即签名</a>
            </div>
        </div>
        <!--/打包封装APP-->

        <!--iOS苹果企业证书签名-->
        <div class="index-signature-wrap">
            <div class="container">
                <div class="index-signature index-common">
                    <h1>iOS企业证书签名</h1>
                    <h4>无需上架，免越狱安装，不限制iOS设备，无限制安装</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="con clearfix">
                                <div class="img-wrap fl"><img src="/statics/img/index-9.png?20190903"></div>
                                <dl>
                                    <dt>24小时全自动签名</dt>
                                    <dd>7*24小时全自动企业证书签名，随时随地上传APP，即可签名</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="con clearfix">
                                <div class="img-wrap fl"><img src="/statics/img/index-10.png?20190903"></div>
                                <dl>
                                    <dt>有效期内免费重签</dt>
                                    <dd>只要在有效期内，APP企业签名更新，均为免费</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="con clearfix">
                                <div class="img-wrap fl"><img src="/statics/img/index-11.png?20190903"></div>
                                <dl>
                                    <dt>消息推送</dt>
                                    <dd>给已安装APP的用户推送消息或通知，提高APP的活跃</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="con clearfix">
                                <div class="img-wrap fl"><img src="/statics/img/index-12.png?20190903"></div>
                                <dl>
                                    <dt>官方证书，安全稳定</dt>
                                    <dd>拥有国内外官方企业签名证书，专业的开发团队，分类签名，将保证APP企业签名的安全稳定</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <a class="ms-btn ms-btn-lg more" href="/index.php/signs">了解更多</a>
                </div>
            </div>
        </div>
        <!--/iOS苹果企业证书签名-->

        <!--内测分发-->
        <div class="container">
            <div class="index-releas index-common">
                <h1>内测发布上传</h1>
                <h4>一键上传APP安装包，提供短链接和下载二维码，方便用户下载测试</h4>
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <div class="ms-thumbnail">
                            <img src="/statics/img/index-13.png?20190903" class="img-responsive">
                            <div class="ms-caption">
                                <div class="tit">实名认证后<br>每天免费赠送1000次</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="ms-thumbnail">
                            <img src="/statics/img/index-14.png?20190903" class="img-responsive">
                            <div class="ms-caption">
                                <div class="tit">1.5G以内大包<br>且支持一包多传</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="ms-thumbnail">
                            <img src="/statics/img/index-15.png?20190903" class="img-responsive">
                            <div class="ms-caption">
                                <div class="tit">一码二用<br>自动识别不同机型</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="ms-thumbnail">
                            <img src="/statics/img/index-16.png?20190903" class="img-responsive">
                            <div class="ms-caption">
                                <div class="tit">提供多套下载模板<br>以及APP官网模板</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="ms-btn ms-btn-secondary ms-btn-lg" href="/index.php/home">立即发布</a>
            </div>
        </div>
        <!--/内测分发-->

        <!--功能累计数-->
        <index></index>
        <!--/功能累计数-->

        <!--合作伙伴-->
        <div class="container">
            <div class="index-common index-partners">
                <h1>合作伙伴</h1>
                <ul class="p-list clearfix">
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-17.png?20190107?20190903">
                            <p>巨人网络是一家集研发、运营发行于一体的综合性娱乐互动企业。</p>
                        </div>
                    </li>
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-18.png?20190903">
                            <p>比格云提供新一代高性能云主机的服务商。</p>
                        </div>
                    </li>
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-19.png?20190903">
                            <p>游久网为用户提供完整庞大和专业游戏资讯的社区网络服务。</p>
                        </div>
                    </li>
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-20.png?20190903">
                            <p>中青宝是一家具有自主研发、运营和代理能力专业化网络游戏公司。</p>
                        </div>
                    </li>
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-21.png?20190903">
                            <p>盛大游戏是中国领先的互动娱乐内容运营平台。</p>
                        </div>
                    </li>

                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-22.png?20190903">
                            <p>触控科技专注于苹果iOS产品和手游开发运营。</p>
                        </div>
                    </li>
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-23.png?20190903">
                            <p>4399是中国最早和领先的在线休闲小游戏平台。</p>
                        </div>
                    </li>
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-24.png?20190903">
                            <p>昆仑游戏是手游、页游、端游的研发与发行平台。</p>
                        </div>
                    </li>
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-25.png?20190903">
                            <p>七牛云-企业级云服务商，专注于以视觉智能和数据智能为核心的云计算业务。</p>
                        </div>
                    </li>
                    <li>
                        <div class="con">
                            <img class="img-responsive" src="/statics/img/index-26.png?20190903">
                            <p>游族网络是中国互动娱乐供应商，提供游戏研发与发行、大数据与智能化服务。</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--/合作伙伴-->
    </div>
</div>

<template id="index">
    <div class="cumulative-wrap">
        <div class="container">
            <div class="index-cumulative index-common">
                <h1>6年产品技术积累，成就非凡品质</h1>
<div class="row">
<div class="col-sm-4 col-xs-4">
<div class="num">
<span>42,387</span></div>
<div class="text text0">累计在线签名APP</div></div>
<div class="col-sm-4 col-xs-4">
<div class="num">
<span>167,441</span></div>
<div class="text text">累计内测分发APP</div></div>
<div class="col-sm-4 col-xs-4">
<div class="num">
<span>231,591</span></div>
<div class="text text02">累计内测下载APP</div></div>
                        <!--                            <div class="num" v-if="scroll">{{value}}</div>-->
                        <div class="text" :class="'text' + index">{{msg[index]}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<div class="ie_dialog" id="incompatible_tip">
    <div>
        <br>
        <table class="ie_notice" style="border:0">
            <tr>
                <td style="text-align: center;">
                    <img class="logo_osc" src="/statics/img/logo-top.png?20190903" alt="蛙速度"/>
                </td>
            </tr>
            <tr>
                <td><h2 class="title">我们不支持 IE 10 及以下版本浏览器</h2></td>
            </tr>
            <tr>
                <td><h4 class="subtitle">It appears you’re using an unsupported browser</h4></td>
            </tr>
            <tr>
                <td>
                    <div class="ie_box">
                        <div class="desc">为了获得更好的浏览体验，我们强烈建议您使用较新版本的 Chrome、 Firefox、 Safari、360 等，或者升级到最新版本的IE浏览器。 如果您使用的是
                            IE 11 或以上版本，请关闭“兼容性视图”。
                        </div>
                        <div class="logos">
                            <a href="http://www.google.cn/chrome/browser/desktop/index.html" target="_blank"
                               title="下载Chrome浏览器">
                                <img src="//pic.dibaqu.com/static/images/logo_chrome.png?20190903" width="200px"/>
                            </a>
                            <a href="http://www.firefox.com.cn" target="_blank" title="下载Firefox浏览器">
                                <img src="//pic.dibaqu.com/static/images/logo_firefox.png?20190903" width="100px"/>
                            </a>
                            <a href="http://browser.360.cn/" target="_blank"
                               title="下载360浏览器">
                                <img src="//pic.dibaqu.com/static/images/logo_360.png?20190903" width="100px"/>
                            </a>
                        </div>
                        <div>
                            <a href="javascript:void(0);"
                               onclick="document.getElementById('incompatible_tip').style.cssText = 'display:none;';"
                               class="go">继续访问</a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="modal fade ms-modal" id="showModalNotice" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">零度分发公告</h4>
            </div>
            <div class="modal-body">
                <p class="mt15">
                    通知：本站支持在线自动签名对接，支持域名分发预览替换，支持按照大小包扣点，支持绿标验证（全网唯一修复完善）！！
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="ms-btn ms-btn-primary contactQQ">联系客服</button>
                <button type="button" class="ms-btn ms-btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="//pic.dibaqu.com/static/js/jquery.cookie.js?20191008298"></script>
<script>
    var isIE = (function () {
        var browser = {};
        return function (ver, c) {
            var key = ver ? ( c ? "is" + c + "IE" + ver : "isIE" + ver ) : "isIE";
            var v = browser[key];
            if (typeof(v) != "undefined") {
                return v;
            }
            if (!ver) {
                v = (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0);
            } else {
                var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:|Edge\/)(\d+)/);
                if (match) {
                    var v1 = parseInt(match[1]);
                    v = c ? ( c == 'lt' ? v1 < ver : ( c == 'gt' ? v1 > ver : undefined ) ) : v1 == ver;
                } else if (ver <= 9) {
                    var b = document.createElement('b')
                    var s = '<!--[if ' + (c ? c : '') + ' IE ' + ver + ']><i></i><![endif]-->';
                    b.innerHTML = s;
                    v = b.getElementsByTagName('i').length === 1;
                } else {
                    v = undefined;
                }
            }
            browser[key] = v;
            return v;
        };
    }());

    if (isIE()) {
        document.getElementById('incompatible_tip').style.cssText = 'display:block;';
    }

</script>
<script>
    Vue.use(VueCountUp);
    var host = window.location.host;
    if (host == "/" || host == "/") {
        var _title = '累计服务APP';
    } else {
        var _title = '累计在线签名APP';
    }
    var index = {
        template: "#index",
        data: function () {
            return {
                "start": "",
                "end": "",
                "scroll": false,
                "msg": ["累计在线封装打包", _title, "累计已发布上传APP"],
                "num": {},
                "shanqing": false
            }
        },
        methods: {
            scrollFun: function () {
                var This = this;
                $(window).scroll(function () {
                    var scrollTop = $(document).scrollTop();
                    // console.log(scrollTop);
                    if (This.shanqing) {
                        if (scrollTop > 800) {
                            This.scroll = true;
                        };
                    } else {
                        if (scrollTop > 1700) {
                            This.scroll = true;
                        } else {
                            // This.scroll = false;
                        }
                    }
                });
            },
            ajaxFun: function () {
                var This = this;
                $.ajax({
                    type: "get",
                    url: "/api/statistics/service-usage-amount",
                    dataType: "json",
                    success: function (res) {
                        This.num = res.data || {};
                        console.log(res.data);
                    },
                    error: function () {
                        console.log("error");
                    }
                });
                /*
                                this.axios.get('/api/statistics/service-usage-amount').then(function (res) {
                                    This.num = res.data.data || {};
                                    console.log(res.data.data);
                                }).catch(function (error) {
                                    console.log(error);
                                });
                */
            }
        },
        created: function () {
            this.ajaxFun();
        },
        mounted: function () {
            this.scrollFun();
        }
    };
    var vm = new Vue({
        el: "#app",
        components: {
            index: index
        }
    });
    $(function () {
        if (!$.cookie('contactQQ')) {
            $("#showModalNotice").modal("show");
            $.cookie('contactQQ', '1', {expires: 1});
        }
        $(".contactQQ").on('click', function () {
            $.cookie('contactQQ', '1', {expires: 1});
            $(".chatQQ").trigger('click');
            $("#showModalNotice").modal("hide");
        });
        var host = window.location.host;
        if (host == "/" || host == "/") {
            $('#sign-div').remove();
            $('#publish-li').show();
            $('#sign-li').hide();
            $('.index-signature-wrap').hide();
            $('#pack-div').remove();

        }

        var mySwiper = new Swiper('.index-banner .swiper-container', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            loop: true,
            speed: 800,
            autoplay: {
                delay: 4000,
                stopOnLastSlide: false,
                disableOnInteraction: true
            }
        });
    })
    console.log("风影");
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