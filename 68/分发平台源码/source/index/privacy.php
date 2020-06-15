<!doctype html>
<html lang="zh">
<head>
<title>隐私政策-<?php echo IN_NAME; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="renderer" content="webkit">
<meta name="keywords" content="">
<meta property="og:url" content="<?php echo IN_NAME; ?>">
<meta property="og:title" content="<?php echo IN_NAME; ?>">
<meta name="baidu-site-verification" content="WDULFadCJ9" />
<meta name="description" content="">
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
<a href="user/cishu" title="">分发套餐</a>
</li>
<li class="">
<a href="user/qianming" title="">签名套餐</a>
</li>
 <li class="">
<a href="user/webview" title="">一键封装</a>
</li>
<li class="">
<a href="jc.mp4" title="">自助在线签名教程</a>
</li>
<!--<li class="">
<a href="user/docs" title="">文档中心</a>-->
</li>
</ul>
<?php if($GLOBALS['userlogined']){ ?>
                                  <!--登录后-->
                <div class="login-in clearfix">
                                            <a class="name-certified fl" href="<?php echo IN_PATH.'user/home'; ?>">应用管理</a>
                                        <div class="login-user clearfix fl">
                                          
                        <span class="fl">
                           <?php echo $GLOBALS['erduo_in_username']; ?></span>
                        <span class="iconfont icon-arrow-bottom fl"></span>
                        <div class="user-wrap">
                            <dl>
                                <dd><a href="<?php echo IN_PATH.'user/home'; ?>">应用管理</a></dd>
                                <dd><a href="<?php echo IN_PATH.'user/profile_info'; ?>">账号设置</a></dd>
                                <!--<dd><a href="<?php echo IN_PATH.'user/profile_verify'; ?>">实名认证</a></dd>
								<dd><a href="<?php echo IN_PATH.'user/myorder'; ?>">我的订单</a></dd>-->
                                <dt><a href="<?php echo IN_PATH.'user/logout'; ?>"><span class="iconfont icon-sign-out"></span>退出</a></dt>
                            </dl>
                        </div>
                    </div>
                </div>
                <!--/登录后-->
		<?php }else{ ?>
		<!--登录前-->
				   <ul class="login clearfix fr"> 
			  <li><a href="<?php echo IN_PATH.'user/login'; ?>" class="ms-btn ms-btn-default">登录</a></li> 
			  <li><a href="<?php echo IN_PATH.'user/reg'; ?>" class="ms-btn ms-btn-primary ml10">注册</a></li>
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
<h1>隐私政策</h1>
</div>
</div>
</div>
<div class="about-tab-wrap">
<div class="container">
<div class="about-tab clearfix">
<div class="about-tab clearfix">
<a href="us" class=""><span class="iconfont icon-msg1"></span>关于我们
</a><a href="log" class=""><span class="iconfont icon-time1"></span>免责声明
</a><a href="privacy" class="router-link-exact-active router-link-active"><span class="iconfont icon-pwd1"></span>隐私政策
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
<div class="tab-3">
<div class="service_content">

<p class="">欢迎使用<?php echo IN_NAME; ?>，这是一款面向企业和个人的应用内测平台。</p>
<p><?php echo IN_NAME; ?>认可并尊重用户的隐私。因此，<?php echo IN_NAME; ?>致力于确保用户了解其个人信息的使用方式，并且保证这 些信息的安全。此隐私策略适用于<?php echo IN_NAME; ?>通过显示此隐私策略的网站、移动应用、产品和服务（包括可能 由<?php echo IN_NAME; ?>离线提供的产品和服务）收集的信息。此隐私策略适用于<?php echo IN_NAME; ?>当前提供的所有<?php echo IN_NAME; ?>产品和服务。</p>
<p>除非此隐私策略第 2 节、第 6 节、第 7 节和第 16 节另有规定，否则未经您同意， <?php echo IN_NAME; ?>不会与第三方共享您的任何与个人、团队和项目有关的信息。</p>
<p>访问<?php echo IN_NAME; ?>的网站，或者使用或购买<?php echo IN_NAME; ?>提供的产品和服务，即表示您接受此隐私策略所述惯例，并同意<?php echo IN_NAME; ?>按照此隐私策略所述方式使用您的信息。</p>
<h3>第一条：<?php echo IN_NAME; ?>收集的信息</h3><p><?php echo IN_NAME; ?>可能向您收集有关您的身份、您在<?php echo IN_NAME; ?>上创建/加入的团队信息，以及您对<?php echo IN_NAME; ?>产品的个人 喜好方面的信息。我们通常可能收集的个人信息包括：姓名、电子邮件地址、电话号码、IP 地址；团队信息包括：公司/团队名称、Logo（或商标、企业标识）、公司/团队介绍、公司/团队通讯地址、电话 号码、服务使用状态的相关信息，以及您在购买过程中可能会涉及到的帐户信息。</p>
<p><?php echo IN_NAME; ?>可能会采用多种不同方式来接收和收集您的个人信息。这些方式可能包括：</p>
<p class="font-18 color-333">1. 来自您的信件</p>
<p class="height-24">您给我们发送电子邮件或写信时，可能会在邮件中提供您的公司/团队信息、您的姓名、联系详细信息以及其他个人信息。</p>
<p class="font-18 color-333">2. 用户支持</p>
<p class="height-24">您在打电话或发电子邮件给我们请求产品方面的技术帮助或索取有关我们产品的信息时，可能向我们提供企业/团队和个人信息。</p>
<p class="font-18 color-333">3. 产品注册</p>
<p class="height-24">注册<?php echo IN_NAME; ?>产品时，系统会要求您提供信息，以便我们将您记录为<?php echo IN_NAME; ?>产品的所有者，从而有助于我们为您提供服务和信息。</p>
<p class="font-18 color-333">4. 购买</p>
<p class="height-24">如果您希望通过我们的在线支付系统订购<?php echo IN_NAME; ?>产品，我们将需要足够的信息才能完成您的订购， 这些信息包括您企业/团队的银行账户信息或个人的信用卡信息。</p>
<h3>第二条：<?php echo IN_NAME; ?>收集信息的用途</h3><p><?php echo IN_NAME; ?>可能将您的个人信息用于以下用途：</p>
<p class="font-18 color-333">1. 产品注册</p>
<p class="height-24">您注册时所提供的信息将用于创建您的<?php echo IN_NAME; ?>团队和项目，并且在您联系<?php echo IN_NAME; ?>用户服务部门时， 这些信息还将协助<?php echo IN_NAME; ?>为您提供支持。<?php echo IN_NAME; ?> 还将使用这些信息来通知您有关您可能感兴趣的任何升级、新产品、促销或其他信息。</p>
<p class="font-18 color-333">2. 产品的使用</p>
<p class="height-24"><?php echo IN_NAME; ?>可能将产品使用中收集的信息用于：定期验证您对产品的使用权利； 向您发送新产品/新功能升级的通知前，确认您是否正在使用该产品/功能的较早版本或者是否会对您使用<?php echo IN_NAME; ?>有所帮助； 以及，从<?php echo IN_NAME; ?>接收您请求获取的产品内部消息。</p>
<p class="font-18 color-333">3. 产品购买</p>
<p class="height-24">如果您通过<?php echo IN_NAME; ?>的在线支付系统购买产品，<?php echo IN_NAME; ?> 将使用您的信息来处理付款并将产品购买信息发送给您。</p>
<p class="font-18 color-333">4. 内部分析</p>
<p class="height-24">我们可能会使用您提供给我们的信息进行内部统计和分析，从而评估并增强您对<?php echo IN_NAME; ?>网站的体验， 包括通过识别您的喜好和购买意向，进行营销以及与运营和开发相关的活动。</p>
<h3>第三条：自动收集的信息</h3><p>无论何时，只要您通过<?php echo IN_NAME; ?>进入我们的网站或访问任何在线信息，我们的 Web 服务器就会自动收集和汇总有关您的访问的信息 （以下简称“自动信息”）。自动信息可能包括相关网站的 URL 或域、浏览器类型、操作系统、您所访问的页面以及访问日期和时间。</p>
<h3>第四条：用户文件</h3><p><?php echo IN_NAME; ?>允许您存储、发送、接收、编辑、同步、共享或者以其他方式组织或管理文件和文件夹 （包括这些文件夹中存储的任何信息或数据）（以下统称“用户文件”）。 我们可能获得您在<?php echo IN_NAME; ?>上储存的所有用户文件的大小，因为我们需要了解您对<?php echo IN_NAME; ?>的实际使用情况， 但我们绝不会获取、储存、共享您的任何用户文件。</p>
<h3>第五条：与第三方共享信息</h3>
<p> 除非第 5 条、第 6 条另有特别规定，否则未经您同意，<?php echo IN_NAME; ?> 不会与第三方共享任何个人信息（例如，通过登录您的用户帐户并选择某选项）。 </p>
<p class="font-18 color-333">1. 内部运营</p>
<p class="height-24">我们可能与独立审计师共享您向我们提供的信息，实现与我们的内部业务运营相关的收入审计目的，前提是此类审计公司必须遵守此隐私策略。</p>
<p class="font-18 color-333">2. 服务提供商</p>
<p class="height-24">我们有时会雇用其他公司代表我们提供服务，比如处理交易、邮件的处理和寄送、提供用户支持、 托管网站或者针对我们的产品或服务进行统计分析。我们有时需要将您企业/团队和个人的信息与其他公司共享， 以便这些公司能够提供适用的服务。我们仅向这些公司提供其向您提供服务所需的信息， 但未授权这些公司将您的信息用于<?php echo IN_NAME; ?>之外的任何其他用途。</p>
<h3>第六条：法定披露</h3><p>虽然我们会尽最大努力保护用户隐私，但当我们有理由相信只有公开个人信息才能遵循现行司法程序、 法院指令或其他法律程序或者保护<?php echo IN_NAME; ?>、<?php echo IN_NAME; ?>用户或第三方的权利、财产或安全时，我们可能披露个人信息。</p>
<h3>第七条：安全</h3><p>我们会采取合理的实际及电子手段以及规程保障措施来保护您的企业/团队和个人信息。 虽然通过因特网信息传输数据并非100% 安全，但我们已经采取并将继续采取商业范畴内合理的努力来确保您的个人信息得到保护。</p>
<h3>第八条：加密</h3><p><?php echo IN_NAME; ?>所有的数据都基于SSL/HTTPs传输，保证数据畅通且安全。严格的数据备份制度， 保证每小时、每天和每周都会执行严格的数据备份工作。</p>
<h3>第九条：COOKIE</h3><p>Cookie是仅限文本的信息字符串，网站会将这些字符串传输到计算机硬盘上浏览器的 Cookie 文件中， 以便网站能够记住您的身份信息以及其他详细信息。Cookie 可能由网站设置或来源自第三方，比如广告商。Cookie 本身不用于或意图用于从用户的计算机读取任何信息 （Cookie 本身的内容除外）。Cookie 只是网站所使用的最初将其放置在您硬盘上的标识符。同一台服务器可以检索到 Cookie 信息的实际内容， 从而标识计算机并进而根据主服务器上存储的信息自定义、跟踪或控制站点的使用情况。</p>
<p>我们可能会在<?php echo IN_NAME; ?>网站上使用 Cookie。使用 Cookie，我们便能进行自动访问和使用我们网站的数据输入功能，以及在网站（如果有）上根据您的喜好或兴趣定制网站， 或者自定义促销或营销活动时，关联您所进行的购买活动的在线订购信息。此外，我们还可以通过 Cookie 跟踪我们网站的使用情况，从而确定哪些功能有用或受欢迎，哪些功能并不能帮助我们有效地改进和更新我们的服务。 大多数网络浏览器都会向您发出有关使用 Cookie 的提醒，或者完全拒绝接受 Cookie。您可以通过修改浏览器设置， 接受或拒绝 Cookie。但是，如果禁用 Cookie，您就不能使用此网站的各项交互功能。</p>
<h3>第十条：链接</h3><p>我们网站上可能会提供某些链接， 这些链接可能指向我们选择提供共同品牌产品的第三方或者我们认为有助于您更好的使用<?php echo IN_NAME; ?>服务的其他网站。 第三方网站不受此隐私策略的约束，<?php echo IN_NAME; ?> 不对这些网站处理您的个人信息的相关做法进行任何说明。建议您在开始访问这些网站之前查阅其隐私策略，确定其隐私保护惯例。</p>
<h3>第十一条：有害信息的过滤和删除</h3><p><?php echo IN_NAME; ?>禁止用户创建和储存一切有害信息，包括：</p>
<p>1. 违反中国宪法确定的基本原则的；</p><p>2. 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；</p><p>3. 损害国家荣誉和利益，攻击党和政府的；</p><p>4. 煽动民族仇恨、民族歧视，破坏民族团结的；</p><p>5. 破坏国家、地区间友好关系的；</p><p>6. 违背中华民族传统美德、社会公德、论理道德、以及社会主义精神文明的；</p><p>7. 破坏国家宗教政策，宣扬邪教和封建迷信的；</p><p>8. 散布谣言或不实消息，扰乱社会秩序 ，破坏社会稳定的；</p><p>9. 煽动、组织、教唆恐怖活动、非法集会、结社、游行、示威、聚众扰乱社会秩序的；</p><p>10. 散布淫秽、色情、赌博、暴力、恐怖或者教唆犯罪的；</p><p>11. 侮辱或诽谤他人，侵害他人合法权益的；</p><p>12. 侵犯他人肖像权、姓名权、名誉权、隐私权或其他人身权利的；</p><p>13. 使用漫骂、辱骂、中伤、恐吓、诅咒等不文明语言的；</p><p>14. 以非法民间组织名义活动的；</p><p>15. 侵犯他人著作权、信息网络传播权等合法权益的；</p><p>16. 含有法律、行政法规禁止的其他内容的。</p>
<p><?php echo IN_NAME; ?>将针对以上信息制定过滤和屏蔽机制，如用户在<?php echo IN_NAME; ?>创建项目或储存文件时不能履行和遵守协议中的规定， <?php echo IN_NAME; ?>有权对违反协议的用户做出关闭帐户处理，同时保留依法追究当事人法律责任的权利。 此外，<?php echo IN_NAME; ?>在采取移除等相应措施后不为此向原发布人承担违约责任或其他法律责任。 <?php echo IN_NAME; ?>依据本协议约定获得处理违法违规内容的权利，该权利不构成<?php echo IN_NAME; ?>的义务或承诺， <?php echo IN_NAME; ?>不能保证及时发现违法行为或进行相应处理。</p>
<h3>第十二条：信息的访问、修改和准确性</h3><p>我们采取了一些合理步骤来确保我们从您那里收到的信息正确无误且始终为最新。您有权访问您的公司/团队和个人信息， 来验证其准确性，并纠正不准确的信息。您可以使用电子邮件地址和密码通过<?php echo IN_NAME; ?>网站登录您的帐户并单击个人设置”， 随时更改您的信息。您也可以通过<?php echo IN_MAIL; ?>与我们联系，访问并纠正个人信息中的错误。 如果您不想获得有关产品、服务或营销计划的信息，或者希望从任何直接营销计划、企业调查、电话营销、直邮或电子邮件列表中删除您的信息， 或者想限制我们对您的个人信息的使用或披露，请通过<?php echo IN_MAIL; ?>与我们联系。</p>
<h3>第十三条：业务转让</h3><p><?php echo IN_NAME; ?>收集的信息将被视作一项资产。如果<?php echo IN_NAME; ?>、任何附属公司、部门或部分资产被另一家公司收购， 则此类信息可能成为被转让资产之一。如果情况如此，收购方公司只能按照此隐私策略（或者向您收集信息时有效的任何后续策略）使用您的信息。 请注意，转让后提交或收集的信息可能必须遵守收购方公司所采用的新隐私策略。</p>
<h3>第十四条：国际传输</h3><p>您的信息可能被传送到或存储在您所在国家/地区、省/市/自治区或其他政府管辖区域以外的地方， 这些地方的隐私法律对您的个人信息的保护程度可能低于您所在的管辖区域。如果您位于中华人民共和国以外， 您应知悉，<?php echo IN_NAME; ?>可能将您的个人信息传输到中国并在中国进行处理。提交此类信息，即表示您同意此隐私策略， 进而表示您同意进行此类传输。</p>
<p>我们始终致力于改善我们的业务和运营。因此，我们的策略将不断完善。 鉴于此，<?php echo IN_NAME; ?>保留不时修改此隐私策略的权利。对此策略的更改将发布在<?php echo IN_NAME; ?>网站上。 我们欢迎您不时访问我们的隐私策略页面，来查看最新隐私策略。如果我们对此隐私策略进行实质性更改， 扩展了我们使用您的公司/团队和个人信息的权利，我们将通过电子邮件或者在我们网站上的显著位置告知您并征求您的同意。</p>
<h3>第十五条：与我们联系</h3><p>请将您对您的信息的任何访问请求、信息修改请求或有关此策略的问题发送至以下电子邮件地址：<?php echo IN_MAIL; ?></p> </div>
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