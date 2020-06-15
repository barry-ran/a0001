
<!doctype html>
<html lang="zh">
<head>
<title>应用审核规范-<?php echo IN_NAME; ?></title>
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
<h1>应用审核规范</h1>
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
</a><a href="agreements" class=""><span class="iconfont icon-doc1"></span>服务协议
</a><a href="specification" class="router-link-exact-active router-link-active"><span class="iconfont icon-doc2"></span>应用审核规范
</a></div>
</div>
</div>
</div>
</div>
</template>
<div class="container">
<div class="about-us">
<div class="tab-5">
<div class="service_content">

<a name="01"></a>
<p class="item-title">1、介绍（Introduction）</p>
<p>
<?php echo IN_NAME; ?>（<?php echo $_SERVER['HTTP_HOST'];?>）是一个创新的开发者服务平台，为开发者提供测试应用快速发布，提高应用内测分发效率。同时我们为开发者提供iOS App、Android App 的开发、打包、封装、测试、分发上线等一系列效率工具，帮助开发者将精力集中在优化产品本身上。我们致力于打造一个服务于开发者的生态圈！<br>
这个文档会及时更新并完善，每一次的修改都是基于优化用户的体验、公平对待所有开发者出发。我们重视用户体验如同珍视生命一般，希望您也如我们一样。我们期望所有的开发者们要了解，<?php echo IN_NAME; ?>开发中服务平台中发布内测应用的一些原则
</p>
<a name="01"></a>
<p class="item-title">2、条款（Terms and conditions）</p>
<p class="font18">2.1 开发者应该遵守国家的法律法规，同时尊重其他开发者的劳动成果。以下的规则将可以帮助 您的应用<?php echo IN_NAME; ?>尽快内测发布</p>
<p class="font18">2.2 以下审核规范中提及的手机型号对应关系均为最新的系统版本或机型</p>
<a name="03"></a>
<p class="item-title">3、应用功能（Functionality）</p>
<p class="font18">3.1 应用无法正常运行或功能存在问题</p>
<p>3.1.1应用存在功能问题</p>
<p>3.1.2应用无法正常安装或安装时提示解析失败</p>
<p>3.1.3应用无法正常卸载或卸载报错</p>
<p>3.1.4应用在启动时崩溃</p>
<p>3.1.5应用在运行时崩溃</p>
<p>3.1.6应用中内容无法正常显示或无法获取</p>
<p>3.1.7应用内按钮点击无反应或点击报错</p>
<p>3.1.8应用内Tap无法切换或切换报错</p>
<p>3.1.9应用强制或诱导修改系统默认设置</p>
<p>3.1.10应用功能需要依赖于第三方应用才能实现</p>
<p>3.1.11应用描述中介绍的功能在应用内不具备或不一致</p>
<p>3.1.12应用需要登录，但应用内不提供注册通道，请在完善资处填写测试账号。</p>
<p>3.1.13注册账号功能不可用，审核时尝试3次都无法成功注册</p>
<p>3.1.14应用登录账号功能不可用，应用审核时尝试3次都无法成功登录</p>
<p>3.1.15应用界面模糊或拉伸</p>
<p class="font18">3.2应用描述和实际功能不符</p>
<p>3.2.1应用介绍或免责声明中介绍的功能在应用内不具备或不一致</p>
<p>3.2.2应用存在欺骗用户下载使用的行为</p>
<p class="font18">3.3申请危险权限或权限和功能不符</p>
<p>3.3.1应用申请的权限和其实际功能不符</p>
<p>3.3.2应用实际功能不需常驻通知栏却常驻通知栏</p>
<p>3.3.3应用无法关闭常驻通知提示</p>
<p>3.3.4通知栏显示图标与应用ICON不相同</p>
<p>3.3.5应用实际功能不需开机启动却开机启动</p>
<p>3.3.6应用在安装或者运行前提示用户重启设备</p>
<p>3.3.7应用在安装或者运行前强制重启设备</p>
<p class="font18">3.4应用功能存在使用限制</p>
<p>3.4.1应用功能仅供部分用户使用，比如限制用户的地域或仅供组织内部使用等，请在应用介绍内说明具体限制范围</p>
<p class="font18">3.5应用存在恶意行为</p>
<p>3.5.1应用存在恶意行为</p>
<p>3.5.2应用未经用户许可发送短信，建议使用返回验证码等方式</p>
<p>3.5.3应用存在病毒</p>
<p>3.5.4应用存在吸费行为</p>
<p>3.5.5应用消耗过多的网络流量</p>
<p>3.5.6应用未经用户许可拨打电话</p>
<p>3.5.7应用修改主叫号码，主要功能用于欺骗被叫用户</p>
<p>3.5.8应用未运行，但是仍会启动GPS、蓝牙等系统功能</p>
<a name="04"></a>
<p class="item-title">4、应用展示和广告（App Properties &amp; AD）</p>
<p class="font18">4.1应用闪屏界面（或启动引导界面）包含其他应用的图标、水印、文字等</p>
<p class="font18">4.2应用展示内容存在问题</p>
<p>4.2.1应用内容存在侵权行为</p>
<p>4.2.2应用名称+描述语不能超过8个汉字字符或16个英文字符</p>
<p>4.2.3应用名称本身就已经超过8个汉字或16个英文字符，只能使用应用的原名称，不能添加描述语</p>
<p>4.2.4应用名称存在占位符文本、大量空格等非法字符（如：#、*、&amp; 等）</p>
<p>4.2.5应用名称与线上已存在的应用的名称相同，请您修改名称；若拥有相应名称的商标权，请联系客服提交</p>
<p>4.2.6应用在商店中显示的名称和安装到设备中显示的名称差异较大</p>
<p>4.2.7应用名称包含非法内容</p>
<p>4.2.8应用名称存在侵权行为</p>
<p>4.2.9应用名称仅以类别词命名，如以壁纸、标签、电话、桌面、安全助手、wifi等名称做为应用的名称；</p>
<p>4.2.10应用介绍或更新说明包含非法内容</p>
<p> 4.2.11应用介绍或更新说明中包含侵权内容</p>
<p>4.2.12应用介绍或免责声明中存在占位符文本、大量空格空行、非法字符（如：@、#、*、&amp; 等）</p>
<p>4.2.13更新说明和旧版本的免责声明相同，请填写本次更新说明</p>
<p>4.2.14应用更新说明中包含其他应用市场名称或内容</p>
<p>4.2.15更新说明无效，请填写正确的更新说明</p>
<p>4.2.16应用简介中使用了极限词或虚假承诺等违反新广告法的内容（如“最”“第一”“唯一”“NO.1”“必备”“免费送”“100%” “全球”“顶尖”“首”等）；</p>
<p>4.2.17应用简介使用了疑问、反问等句式（请用陈述语句进行描述）</p>
<p>4.2.18应用简介中包含违规内容（如侵权、色情、恐怖暴力、反动等</p>
<p>4.2.19应用简介存在占位符文本、大量空格等非法字符（如：#、*、&amp; 等）</p>
<p class="font18">4.3应用展示的图片资源存在问题</p>
<p>4.3.1应用内容中的图片拉伸或模糊</p>
<p>4.3.2应用截图和应用实际的界面不符</p>
<p>4.3.3应用截图中存在重复</p>
<p>4.3.4应用截图存在黑边</p>
<p>4.3.5应用截图存在压缩</p>
<p>4.3.6应用截图模糊不清，无法分辨截图内容</p>
<p>4.3.7应用截图存在拉伸</p>
<p>4.3.8应用截图内容显示不完整</p>
<p>4.3.9应用截图存在非法内容</p>
<p>4.3.10应用截图存在侵权行为</p>
<p class="font18">4.4广告相关</p>
<p>4.4.1应用未经用户许可或默认勾选创建桌面快捷方式</p>
<p>4.4.2应用未经用户许可默认安装或默认勾选安装第三方应用</p>
<p>4.4.3应用未经用户许可修改系统默认设置</p>
<p>4.4.4应用存在诱导用户点击广告的行为</p>
<p>4.4.5应用内存在诱导用户评价功能，不得出现任何诱导用户进行评分、给应用好评的功能</p>
<p>4.4.6应用介绍中不得包含任何诱导用户进行评分、给应用好评的功能或文字描述</p>
<p>4.4.7应用存在通知栏广告</p>
<p>4.4.8应用多次发现存在通知栏广告行为，将不再收录</p>
<p>4.4.9应用存在强制积分墙，在启动时强制要求换取积分才能使用</p>
<p>4.4.10应用存在强制积分墙，在使用时强制要求换取积分</p>
<p>4.4.11应用具有诱导用户赚取积分兑换货币或奖品的功能</p>
<p>4.4.12暂不收录：赚取积分以兑换话费、现金等奖品的应用</p>
<p>4.4.13应用存在抢占锁屏的行为</p>
<p>4.4.14应用广告存在模仿系统通知或警告的行为</p>
<p>4.4.15应用的主要目的是展示广告或者市场营销</p>
<p>4.4.16应用使用过程中频繁弹出悬浮窗广告，中断用户操作，影响用户体验</p>
<p>4.4.17应用包含空广告栏位</p>
<p>4.4.18应用中的广告不能干扰第三方的应用的广告展示</p>
<p>4.4.19应用广告中包含不良或违法信息</p>
<p>4.4.20通过非正常渠道进行推广安装</p>
<p class="font18">4.5用户使用体验</p>
<p>4.5.1应用打开立即会提示更新，请确认您所上传的是否为最新版本</p>
<p>4.5.3应用功能、界面和应用商店中已收录应用非常类似</p>
<p>4.5.4应用功能、界面和应用商店中已收录应用完全雷同</p>
<p>4.5.5开发者应将当地官方语言的应用描述放在应用描述最前</p>
<p>4.5.6应用部分功能或内容需要访问调用其他应用获取</p>
<p>4.5.7应用内容不完整，部分功能待开发</p>
<p>4.5.8应用的用户界面过于复杂</p>
<a name="05"></a>
<p class="item-title">5、应用内容（Contents of App）</p>
<p class="font18">5.1应用存在暴力内容</p>
<p>5.1.1任何带有诽谤、人身攻击或者侮辱个人或者团体的应用</p>
<p>5.1.2应用存在人类或动物被杀、被虐待、被伤害等图片或内容</p>
<p>5.1.3应用过分描述暴力或虐待儿童</p>
<p>5.1.4应用对武器进行过于逼真的表述（如不能涉及武器的制造工艺和参数等），并鼓励违法或滥用武器</p>
<p class="font18">5.2应用存在色情内容</p>
<p>5.2.1应用包含色情内容或者过分展现性器官，但又不是旨在艺术审美或情感</p>
<p>5.2.2应用中存在允许用户提交色情内容，如允许用户发布色情照片、文字等</p>
<p>5.2.3情趣用品商城类应用禁止存在社区、论坛等允许用户发布帖子、信息和评论帖子等功能和模块</p>
<p>5.2.4应用介绍、应用截图、描述语等含有色情内容，详情如下：</p>
<p class="font18">5.3应用存在非法金钱交易或内容</p>
<p>5.3.1应用具有现金或者流通货币赌博功能</p>
<p class="font18">5.4政治问题</p>
<p>5.4.1应用不能包含对国家领导人诽谤、人身攻击或者侮辱性的内容</p>
<p>5.4.2应用包含反政府、反社会内容</p>
<p>5.4.3存在政治错误的应用，如VPN、翻墙、涉恐涉暴等</p>
<p class="font18">5.5用户使用感受</p>
<p>5.5.1<?php echo IN_NAME; ?>暂不收录：品类单一的主题、壁纸、锁屏类应用</p>
<p>5.5.2<?php echo IN_NAME; ?>暂不收录：短信收取服务费的应用</p>
<p>5.5.3<?php echo IN_NAME; ?>暂不收录：主要功能需要获取Root权限后才可使用的应用</p>
<p>5.5.4应用设计的功能主要是令用户厌恶、恐惧</p>
<p>5.5.5应用具有易引起用户不适或者比较粗俗的内容，如对血腥和色情场面的过分展现</p>
<p>5.5.6应用中所有的“敌人”角色，都不能针对任何一个现实的种族、文化、政府或公司，以及任何一个真实的个体</p>
<p>5.5.7应用中涉及的宗教内容都应该是翻译准确和使用恰当的，并且不存在误导行为。使用这些内容的目的应该是教育意义的而不是煽动性的</p>
<p>5.5.8存在针对某一宗教、文化或种族的诽谤、侮辱或攻击的内容，或有可能让这部分群体人们造成情感伤害的内容</p>
<p class="font18">5.6应用内抽奖、彩票相关功能及内容</p>
<p>5.6.1应用中的竞赛和抽奖活动必须由该应用开发者来发起</p>
<p>5.6.2竞赛和抽奖活动必须在应用的用户协议中有清晰详细的描述，且这些竞赛或抽奖活动<?php echo IN_NAME; ?>无关，不承担任何相关法律责任</p>
<p>5.6.3彩票类软件都必须符合国家的相关法律条款</p>
<p>5.6.4理财/彩票类软件请根据要求提交相关资质证明发送至1316662815@qq.com</p>
<p>5.6.5理财应用提交的应用一句话简介，应用描述，免责声明，截图等需符合理财APP内容审核要求</p>
<p class="font18">5.7开发者行为不当</p>
<p>5.7.1开发者重复提交结构、功能、内容相似的应用，重复提交的应用将被驳回或下架,情节严重者将被封禁开发者账号</p>
<p>5.7.2开发者对已经明确版权归属的应用私自进行破解、汉化、反编译或重新打包，应用将被驳回且开发者将被封禁开发者账号</p>
<p>5.7.3开发者提交的应用存在问题或开发者自身原因，开发者主动申请驳回、删除或下架</p>
<a name="06"></a>
<p class="item-title">6、损坏设备（Damage to Device）</p>
<p class="font18">6.1 用户运行该应用有可能损坏设备</p>
<p class="font18">6.2 应用会迅速消耗电量或者造成设备过热</p>
<p> 6.2.1 应用未启动，但不断使用GPS等功能导致用户电量迅速消耗</p>
<p>6.2.2 应用未启动，但会长时间占用CPU、内存等导致设备过热</p>
<a name="07"></a>
<p class="item-title">7、法律要求（Legal Requirements）</p>
<p class="font18">7.1 违反国家法律法规</p>
<p class="font18">7.2 应用允许共享违法的文件或内容</p>
<p>7.2.1 应用怂恿或鼓励犯罪或暴力行为</p>
<p>7.2.2 应用鼓励酒驾或公布没有经过交通管理部门允许的酒驾检测点数据</p>
<p>7.2.3 应用过度宣传酒精或者危险物品（如毒药、爆炸物等），或者鼓励未成年人消费香烟和酒精饮料</p>
<p class="font18">7.3 应用存在侵犯版权行为</p>
<p>7.3.1 应用为破解、盗版或未获得版权所有者授权的应用</p>
<p>7.3.2 单本图书类应未提供版权证明 ，书城类应用未提供免责声明</p>
<p class="font18">7.4 应用存在欺诈行为</p>
<p>7.4.1 应用存在欺骗、伪造或者误导用户的行为</p>
<p class="font18">7.5 隐私保护</p>
<p>7.5.1 应用未提示用户或未经用户授权情况下搜集、传输或者使用用户的位置信息</p>
<p>7.5.2 应用未经用户许可且在用户不知情的情况下传输和使用用户的隐私数据，如通讯录、照片和短信记录等</p>
<p>7.5.3 应用强制要求用户共享其个人信息，如邮件地址或生日等信息</p>
<p>7.5.4 应用搜集未成年人信息数据</p>
<p>7.5.5 开发者的应用会窃取用户密码或者其他用户个人数据的将被封禁<?php echo IN_NAME; ?>账户</p>
</div>
</div>
</div>
</div>
</template>
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