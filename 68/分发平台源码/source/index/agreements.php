
<!doctype html>
<html lang="zh">
<head>
<title>服务协议-<?php echo IN_NAME; ?></title>
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
<h1>服务协议</h1>
</div>
</div>
</div>
<div class="about-tab-wrap">
<div class="container">
<div class="about-tab clearfix">
<div class="about-tab clearfix">
<a href="us" class=""><span class="iconfont icon-msg1"></span>关于我们
</a><a href="log" class=""><span class="iconfont icon-time1"></span>免责声明
</a><a href="privacy" class=""><span class="iconfont icon-pwd1"></span>隐私政策
</a><a href="agreements" class="router-link-exact-active router-link-active"><span class="iconfont icon-doc1"></span>服务协议
</a><a href="specification" class=""><span class="iconfont icon-doc2"></span>应用审核规范
</a></div>
</div>
</div>
</div>
</div>
</template>
<div class="container">
<div class="about-us">
<div class="tab-4">
<div class="service_content">

<p><?php echo IN_NAME; ?>（除非特别说明，本服务协议所提及的<?php echo IN_NAME; ?>同时包括<?php echo IN_NAME; ?>网站、域名下的所有内容。使用<?php echo IN_NAME; ?>, 也就意味着您同意本服务协议及<?php echo IN_NAME; ?>对其不时所做的修订。</p>
<h3>第一条：使用之前提</h3>
<p>1. 通过使用<?php echo IN_NAME; ?>所提供的信息，工具以及其他功能，借助任何<?php echo IN_NAME; ?>的 API，或者经由<?php echo IN_NAME; ?>接口的任何软件、其它网站，或者它的 API（以上统称“服务”），都表示您同意遵守本服务协议，无论您是一个非注册用户还是一个注册用户。</p>
<p>2. 如果您想成为注册用户并使用<?php echo IN_NAME; ?>提供的服务，您必须阅读并接受本服务协议。只要您注册成为<?php echo IN_NAME; ?>的用户（无论是通过<?php echo IN_NAME; ?>还是通过其他第三方媒介，下同）就视为您接受了本服务协议。如果您接受本服务协议，则表示您有能力受其约束，或者，如果您代表了一个公司或实体，您有权使该实体受其约束。</p>
<h3>第二条：行为准则</h3>
<p>1. 一旦您接收了本服务协议项下的条款和条件，即表示您同意在使用服务时遵守以下规则。您理解并同意，如果您违反了以上规则，所出现的任何后果由您自行承担，<?php echo IN_NAME; ?>对此不负有任何责任。</p>
<ul>
<li> 1.1 不得利用<?php echo IN_NAME; ?>提供的服务从事任何非法活动，不发布违反国家相关法律法规及政策规定的内容；</li>
<li> 1.2 不得利用<?php echo IN_NAME; ?>危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一；</li>
<li> 1.3 不得利用<?php echo IN_NAME; ?>损害国家荣誉和利益；</li>
<li> 1.4 不得利用<?php echo IN_NAME; ?>煽动民族仇恨、民族歧视，破坏民族团结；</li>
<li> 1.5 不得利用<?php echo IN_NAME; ?>破坏国家宗教政策，宣扬邪教和封建迷信；</li>
<li> 1.6 不得利用<?php echo IN_NAME; ?>散布谣言，扰乱社会秩序，破坏社会稳定；</li>
<li> 1.7 不得利用<?php echo IN_NAME; ?>散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪；</li>
<li> 1.8 不得利用<?php echo IN_NAME; ?>侮辱或者诽谤他人，侵害他人合法权益；</li>
<li> 1.9 不得利用<?php echo IN_NAME; ?>侵害他人知识产权、商业秘密等合法权益；</li>
<li> 1.10 不得利用<?php echo IN_NAME; ?>恶意虚构事实、隐瞒真相以误导、欺骗他人；</li>
<li> 1.11 不得利用<?php echo IN_NAME; ?>发布、传送、传播垃圾信息；</li>
<li> 1.12 不得向<?php echo IN_NAME; ?>上传任何恶意代码、含有恶意行为的软件；</li>
<li> 1.13 不得滥用<?php echo IN_NAME; ?>所提供的资源或者服务，该等滥用包括但不限于重复应用、谋取不当利益等行为；</li>
<li> 1.14 不得转让或继受、售卖<?php echo IN_NAME; ?>的账号和密码，以谋取不当利益；</li>
<li> 1.15 不得公开展示或使用服务共享不当内容或材料（例如，涉及裸体、兽行、色情、暴力画面或犯罪活动）以及不符合适用法律或法规要求的内容或材料（例如，侵犯知识产权的软件或图片、文字、代码等）；</li>
<li> 1.16 不得传播任何形式的游戏软件作品；</li>
<li> 1.17 不得从事虚假或误导性活动（例如编造虚假理由索要现金，假冒他人，操纵服务）或者中伤或诽谤活动；</li>
<li> 1.18 不得规避服务的任何访问或可用性限制；</li>
<li> 1.19 不得从事对服务或他人有害的活动（例如，传播病毒、跟踪、发布仇恨言论或宣扬针对他人的暴力行为）；</li>
<li> 1.20 不得利用<?php echo IN_NAME; ?>或其服务侵犯他人的合法权利；</li>
<li> 1.21 不得利用<?php echo IN_NAME; ?>从事侵犯他人隐私或数据保护权利的活动；</li>
<li> 1.22 不得利用<?php echo IN_NAME; ?>传播含有违反国家法律的金融、股票、理财、贷款、赌博等软件或App；</li>
<li> 1.22 其他法律法规禁止的行为；</li>
<li> 1.23 不得帮助他人违反上述规则。</li>
</ul>
<p>2. 强制执行。如果您违反本服务协议项下的条款和条件，<?php echo IN_NAME; ?>有权在不提前通知您的情况下采取合理且适当的措施以维护<?php echo IN_NAME; ?>以及其他用户的合法及正当利益，该等措施包括但不限于停止为您提供服务、关闭您的<?php echo IN_NAME; ?>账户、删除您在<?php echo IN_NAME; ?>上发布的内容和信息，并保存相关记录及向有关政府主管部门举报。在对涉嫌违反本服务协议项下条款和条件的行为进行调查时， <?php echo IN_NAME; ?>将保留对您的内容进行审查以便解决问题的权利。</p>
<h3>第三条：版权</h3>
<p>1. <?php echo IN_NAME; ?>包含的所有内容，包括但不限于文本，图形，徽标，按钮图标，图像，音频剪辑，数码下载，数据编译，软件以及内容汇编成一体的连贯的网站都属于<?php echo IN_NAME; ?>所有，并受中国和国际版权法的保护。严禁未经<?php echo IN_NAME; ?>书面允许即对其上述内容进行复制、使用或者进行其他非法利用。</p>
<p>2. <?php echo IN_NAME; ?>的所有注册用户向<?php echo IN_NAME; ?>平台所提供的 App（手机应用程序）应当保证拥有完整独立的知识产权，包括但不限于外观设计，著作权。</p>
<h3>第四条：商标和服务标记</h3>
<p><?php echo IN_NAME; ?> , <?php echo IN_NAME; ?>标志和其他<?php echo IN_NAME; ?>图形、标识、网页标题、按钮图标、脚本和服务名称均为<?php echo IN_NAME; ?>或其子公司及关联公司的商标、证明商标、服务标记或其它商业外观。<?php echo IN_NAME; ?>的商标、证明商标、服务标记和商业外观由于它们的限制使用而具有固有的意义和重大价值。它们不会被用于未经<?php echo IN_NAME; ?>许可的任何有关产品或服务。</p>
<h3>第五条：访问许可</h3>
<p>考虑到访问<?php echo IN_NAME; ?>和其服务，<?php echo IN_NAME; ?>将授予您一个访问<?php echo IN_NAME; ?>和用于个人使用的有限许可。本服务协议禁止您下载 （页面缓存除外）或修改<?php echo IN_NAME; ?>的任何部分，除非得到<?php echo IN_NAME; ?>明确的书面同意。本服务协议不允许转售<?php echo IN_NAME; ?>的服务。在未经<?php echo IN_NAME; ?>明确书面同意的情况下，您不得使用<?php echo IN_NAME; ?>上的任何商标、标识或其它专有的信息(包括但不限于图像、文本、网页布局或表单)。任何未经授权的使用自动终止了<?php echo IN_NAME; ?>授予的允许或许可，并可能产生各种损害赔偿的法律责任。</p>
<h3>第六条：账户、密码、资质材料</h3>
<p>1. 如果您注册成为<?php echo IN_NAME; ?>的用户并因此创建了一个账户，您需自行负责维护您的账户和密码的机密性，并且您同意接受对在您的账户或密码下发生的所有活动负责。<?php echo IN_NAME; ?>无义务且没有办法对非法或未经您授权使用您账号和密码的行为进行识别，因此，<?php echo IN_NAME; ?>对前述行为所引起的一切责任及其他不利后果不承担任何责任。但<?php echo IN_NAME; ?>保留以下权利：自行裁定权、拒绝服务、暂停或终止账户或以其他方式限制访问<?php echo IN_NAME; ?>和接受<?php echo IN_NAME; ?>的其他任何服务。</p>
<p>2. 您保证：您具备使用本服务、接入和运营应用或提供相关服务等行为的相关合法资质或经过了相关政府部门的审核批准；您提供的主体资质材料、相关资质或证明以及其他任何文件等信息真实、准确、完整，并在信息发生变更后，及时进行更新；您具备履行本协议项下之义务、各种行为的能力；您履行相关义务、从事相关行为不违反任何对您有约束力的法律文件。否则，您应不使用<?php echo IN_NAME; ?>提供的相关服务，且应独自承担由此带来的一切责任及给用户、<?php echo IN_NAME; ?>造成的全部损失。</p>
<p>3. 您保证：您会依法及按照<?php echo IN_NAME; ?>要求提交使用本服务所必须的真实、准确的经过您签章确认的主体资质材料以及联系人姓名（名称）、地址、电子邮箱等相关资料。 </p>
<p>4. 您保证：您在<?php echo IN_NAME; ?>上通过您的应用提供的各种服务，依法已经具有相关的合法资质或获得了有关部门的许可或批准，并会向<?php echo IN_NAME; ?>提交相关资质或证明文件。 </p>
<p>5. 您保证：您在<?php echo IN_NAME; ?>上通过您的应用提供的各种服务，符合国家相关法规的规定，不违反任何相关法规及相关协议、规则，也不会侵犯任何人的合法权益， 同时，会依法、依约或按照<?php echo IN_NAME; ?>的要求提供版权、专利权等相关证明文件。</p>
<h3>第七条：隐私及数据信息安全</h3>
<p>1. 使用本服务，即表示您同意<?php echo IN_NAME; ?>合法收集和使用有关您及您所使用本服务的技术性或诊断性信息。收集到的些信息将用于改进网页的内容，提升我们的服务品质。<?php echo IN_NAME; ?>不会将您的信息和内容分享或出售给其他的组织。但以下情况除外：</p>
<ul>
<li> 1.1 您同意让第三方共享资料；</li>
<li> 1.2 <?php echo IN_NAME; ?>需要听从法庭传票、法律命令或遵循法律程序；</li>
<li> 1.3 您违反了本协议。</li>
</ul>
<p>2. <?php echo IN_NAME; ?>会竭力保护您的数据信息安全与隐私，但如发生包括但不限于以下任一状况，<?php echo IN_NAME; ?>将不承担任何法律责任：</p>
<ul>
<li> 2.1 因<?php echo IN_NAME; ?>无法对非法的或未经用户授权的使用<?php echo IN_NAME; ?>帐号及密码的行为作出甄别，因此造成您在<?php echo IN_NAME; ?>的帐号及密码被窃取的；</li>
<li> 2.2 您发布的应用程序包括任何可链接到该应用程序的网址或其他在线服务侵犯到第三方知识产权的；</li>
<li> 2.3 您通过<?php echo IN_NAME; ?>收集到的任何用户信息（包括但不限于用户设备信息等），不仅只供内测使用，还提供给任何第三方或另作他用的；</li>
<li> 2.4 因不可抗力，计算机病毒或黑客攻击，系统不稳定，您所在位置无网络信号，关机，GSM网络、互联网络、通信线路原因等造成的服务中断或不能满足您的服务要求、造成您的数据丢失的。</li>
</ul>
<h3>第八条：服务或软件更新以及条款变更</h3>
<p>1. 我们可能会随时变更本服务协议项下的条款和条件。如果您在该等条款和条件变更生效后使用服务，即表示您同意新的条款和条件。如果您不同意新的条款和条件，则必须停止访问<?php echo IN_NAME; ?>并停止使用其服务，并请关闭您的<?php echo IN_NAME; ?>帐户。</p>
<p>2. 有时，您可能需要软件更新，才能继续使用服务。我们会自动检查您的软件版本，并且下载软件更新或配置变更，包括那些可能会阻止您访问服务、或使用未经授权的硬件外围设备的配置变更，还可能要求您更新软件才能继续使用服务。此类更新受上述条款的约束，除非更新附带有其他条款，在这种情况下，其他条款应予适用。尽管有上述约定，<?php echo IN_NAME; ?>没有义务提供任何更新，也不保证<?php echo IN_NAME; ?>将针对您曾对软件进行许可的系统的版本提供支持。这种更新可能与由第三方提供的软件或服务不兼容。</p>
<p>3. 另外，有些时候，我们也许需要删除或更改服务的功能，或者停止提供一项服务，或者访问第三方应用程序和服务。除非适用的法律明确要求，否则我们无义务对已删除或更改之前的任何服务的功能或者服务提供重新下载或恢复。</p>
<h3>第九条：签约实体、法律选择和争议解决地</h3>
<p>1. 当您选择使用<?php echo IN_NAME; ?>服务时，您将与福建喜佳宝网络科技有限公司签订合同；本服务协议项下的条款将受中华人民共和国法律管辖。当您依照本服务协议的条款使用<?php echo IN_NAME; ?>服务时，对于由这些条款或服务引起的或与其相关的任何争议，包括与这些条款的存在、有效性或终止相关的任何问题，均应提交至中国陕西省西安市的仲裁机构仲裁，并按照中华人民共和国的法律进行仲裁。仲裁裁决将为最终裁决，对双方均具有约束力。</p>
<p>2. 本协议签订地为中华人民共和国陕西省西安市。 </p>
<h3>第十条：保证</h3>
<p>1. <?php echo IN_NAME; ?>不提供与您使用服务相关的任何明示或默示的保证、保障或条件。您已了解，您应自行承担服务使用风险，我们按“现状”提供服务，服务可能存在各种缺陷，并且只提供服务的目前可用功能。<?php echo IN_NAME; ?>不保证服务中所提供的信息的准确性或时效性。根据适用法律，您可能享有某些权利，如果适用，本服务协议的条款中的任何规定均无意影响这些权利。您承认，计算机和电信系统可能会出现故障或偶尔会发生停机。我们不保证服务无中断、及时、安全、无错误、不发生内容丢失，也不会对与计算机网络的连接或传输作任何保证。</p>
<p>2. 在适用法律允许的范围内，我们排除有关适销性、质量满意度、特定用途的适用性、无技术问题和不侵权的任何默示保证。</p>
<h3>第十一条：责任限制</h3>
<p>1. <?php echo IN_NAME; ?>仅对本协议中列明的责任承担范围负责。</p>
<p>2. 本协议约定服务之合作单位，所提供之服务品质及内容由该合作单位自行负责。</p>
 <p>3. 在法律允许的情况下，<?php echo IN_NAME; ?>对于与本协议有关或由本协议引起的任何间接的、惩罚性的、特殊的、派生的损失（包括业务损失、收益损失、利润损失、使用数据或其他经济利益的损失），不论是如何产生的，也不论是由对本协议的违约（包括违反保证）还是由侵权造成的，均不负有任何责任，即使事先已被告知此等损失的可能性。另外即使本协议规定的排他性救济没有达到其基本目的，也应排除<?php echo IN_NAME; ?>对上述损失的责任。</p>
<p>4. 对于因超出<?php echo IN_NAME; ?>合理控制范围的情况（例如劳资纠纷、不可抗力、战争或恐怖主义行为、恶意破坏、意外事故或遵守任何适用法律或政府命令）而导致<?php echo IN_NAME; ?>无法履行或延迟履行其义务，<?php echo IN_NAME; ?>对此不承担任何责任或义务。<?php echo IN_NAME; ?>将尽最大努力降低这些事件的影响，并将尽最大努力履行未受影响的义务。</p>
<p>5. <?php echo IN_NAME; ?>的服务是按照现有技术和条件所能达到的现状提供的。<?php echo IN_NAME; ?>会尽最大努力向您提供服务，确保服务的连贯性和安全性；但<?php echo IN_NAME; ?>不能保证其所提供的服务毫无瑕疵，也无法随时预见和防范法律、技术以及其他风险，包括但不限于不可抗力、病毒、木马、黑客攻击、系统不稳定、第三方服务瑕疵、政府行为等原因可能导致的服务中断、数据丢失以及其他的损失和风险。所以您也同意：即使<?php echo IN_NAME; ?>提供的服务存在瑕疵，但上述瑕疵是当时行业技术水平所无法避免的，其将不被视为<?php echo IN_NAME; ?>违约，同时，由此给您造成的数据或信息丢失等损失的，您同意放弃追究<?php echo IN_NAME; ?>的责任。</p>
<p>6. 您承诺您使用本服务及您的任何行为，不得违反任何相关法律法规、本协议及相关协议、规则等，不得侵犯任何主体的合法权益等。若<?php echo IN_NAME; ?>自行发现或根据相关部门的信息、权利人的投诉等发现您可能存在违反前述承诺情形的，<?php echo IN_NAME; ?>有权根据一般人的认识自己独立判断，以认定您是否存在违反前述承诺的情形。若<?php echo IN_NAME; ?>经过判断认为您存在违反前述承诺的情形，<?php echo IN_NAME; ?>有权随时单方采取以下一项或多项措施：</p>
<ul>
<li>6.1 要求您立即更换、修改侵犯他人合法权益的相关内容，在您更正前，暂停向您或您关联公司支付涉嫌违规应用或您以及您关联公司名下其他任何一款应用或全部应用的收益；</li>
<li>6.2 对涉嫌违规应用或您以及您关联公司名下的其他全部应用或任何一款应用采取封闭新用户入口、限制老用户登录等措施；</li>
<li>6.3 对涉嫌违规应用或您以及您关联公司名下的其他全部应用或任何一款应用采取下线措施，即终止应用在开放平台的运营；</li>
<li>6.4 暂停向您或您关联公司支付任何费用；</li>
<li>6.5 从应向您或您关联公司支付的任何款项中直接扣减<?php echo IN_NAME; ?>遭受的损失或者应由您承担的相应金额的违约金；</li>
<li>6.6 禁止您或您关联公司今后将任何新应用接入开放平台；</li>
<li>6.7 中止或终止涉嫌违规应用或您以及您关联公司名下的其他全部应用或任何一款应用，在<?php echo IN_NAME; ?>开放平台之外的平台、网站的宣传、推广、发布行为；</li>
<li>6.8 追究您的法律责任，或同时单方终止本协议；</li>
<li>6.9 将您的行为对外予以公告，向主管机关或投诉人、权利人提供您的有效信息；</li>
<li>6.10 其他<?php echo IN_NAME; ?>认为适合的处理措施。</li>
</ul>
<p>7. 在<?php echo IN_NAME; ?>告知您或您自行得知您存在侵犯他人合法权益情形后，您应根据<?php echo IN_NAME; ?>的审核或客服渠道向<?php echo IN_NAME; ?>提出反通知。但是，无论<?php echo IN_NAME; ?>是否告知您、您是否提出反通知或反通知是否符合相关法规、<?php echo IN_NAME; ?>要求等，均不影响<?php echo IN_NAME; ?>进行自己的独立判断和采取相关措施。</p>
<p>8. 若<?php echo IN_NAME; ?>按照上述条款、本协议的其他相关约定或因您违反相关法律的规定，对您或您的应用采取任何行为或措施，所引起的纠纷、责任等一概由您自行负责，造成您损失的，您应自行全部承担，造成<?php echo IN_NAME; ?>或他人损失的，您也应承担全部责任。</p>
<p>9. 若<?php echo IN_NAME; ?>按照上述条款、本协议的其他相关约定或因您违反相关法律的规定，对您或您的应用采取任何行为或措施后，导致您没有使用到相应服务但已经缴纳相应费用的，对该部分费用，<?php echo IN_NAME; ?>有权不予退还，而作为您违反约定的违约金予以没收。</p>
<p>10. 因您违约导致<?php echo IN_NAME; ?>终止本协议的，尚未结算的应用收益，<?php echo IN_NAME; ?>有权不予结算，而作为违约金归<?php echo IN_NAME; ?>所有。此外，因您违反本协议约定，所引起的纠纷、责任等一概由您自行负责，造成<?php echo IN_NAME; ?>损失的（包括但不限于被主管机关罚款、赔偿权利人损失、律师费、诉讼费等），您应在5个工作日内赔偿<?php echo IN_NAME; ?>全部损失。</p>
<p>11. 您同意并承诺，在您使用<?php echo IN_NAME; ?>所提供服务的过程中，您不得向<?php echo IN_NAME; ?>上传含有违反国家相关法律法规及政策规定内容，包括但不限于代码、软件、图片、视频、文字、App等。否则，出现的所有法律后果由您自行全部承担，<?php echo IN_NAME; ?>对此不负任何责任。</p>
<p>12. <?php echo IN_NAME; ?>作为第三方中立平台，不具有对您上传至<?php echo IN_NAME; ?>的内容进行审查的义务，但<?php echo IN_NAME; ?>在认为有需要时，<?php echo IN_NAME; ?>有权利对您上传至<?php echo IN_NAME; ?>服务的内容进行审查，审查结果及审查后的进一步动作可由<?php echo IN_NAME; ?>进行自行裁定。您对此表示理解并同意，并愿意承担因审查出现的全部后果。</p>
<h3>第十二条：应用程序</h3>
<p>1. 许可范围。</p>
<p><?php echo IN_NAME; ?>提供的应用程序（包含网站、APP、SDK、API接口等，下同）只授予使用许可，而非出售。本协议只授予您使用应用程序的某些权利。除非适用的法律赋予您此项限制之外的更多权利，否则您仅可在本协议明示许可的范围内使用应用程序。为此，您必须遵守应用程序中的任何技术限制，这些限制只允许您以特定的方式使用应用程序。您不得：</p>
<ul>
<li> 1.1 绕过应用程序中的任何技术限制。</li>
<li> 1.2 对应用程序进行反向工程、反向编译或反汇编；尽管有此项限制，但如果适用法律明示允许上述活动，则在且仅在适用法律明示允许的范围内从事上述活动不在此限。</li>
<li> 1.3 制作超过本服务协议所规定或适用的法律所允许数量的应用程序副本。</li>
<li> 1.4 发布或以其他方式提供应用程序以便其他人复制。</li>
<li> 1.5 出租、租赁或出借应用程序。</li>
<li> 1.6 将应用程序或本服务协议转让给任何第三方。</li>
</ul>
<p>2. 下载。应用程序的下载可能会消耗网络流量，因此而产生的费用，将由您自行承担。</p>
<p>3. <?php echo IN_NAME; ?>会随时清理其上含有包括但不限于色情内容、垃圾信息、积分墙、游戏私服、病毒、翻墙、反动、盗版软件、恶意扣费、破解软件等恶意应用程序，但您在下载应用程序前请自行甄别应用程序的质量，请勿因为垃圾短信、邮件内容随意下载来源不可靠的应用程序，请根据应用下载链接的来源自行判断并下载可信任的应用程序。</p>
<p>4. 文档。如果随应用程序提供文档，则您可以复制和使用该文档，但仅供您个人参考之用。</p>
<h3>第十三条：其他</h3>
<p>1. 本服务协议、任何适用的隐私政策、补充和更新条款以及您同意的任何隐私政策，构成<?php echo IN_NAME; ?>服务及其应用程序的完整的服务协议。</p>
<p>2. 本协议的成立、生效、履行、解释及纠纷解决，适用中华人民共和国大陆地区法律（不包括冲突法）。 </p> </div>
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