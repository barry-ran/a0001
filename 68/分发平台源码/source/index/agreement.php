<?php
if(!defined('IN_ROOT'))
{
	exit('Access denied');
}
?>
<!DOCTYPE html>
<html lang="zh">
 <head> 
  <title>分发协议 - <?php echo IN_NAME; ?></title> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
  <meta name="renderer" content="webkit" /> 
  <meta name="keywords" content="<?php echo IN_KEYWORDS; ?>" /> 
  <meta property="og:url" content="https://<?php echo $_SERVER['HTTP_HOST']; ?>/" /> 
  <meta property="og:title" content="<?php echo IN_NAME; ?>" /> 
  <meta name="description" content="<?php echo IN_DESCRIPTION; ?>" /> 
  <link rel="stylesheet" href="/static/default/css/bootstrap.min.css" /> 
  <link rel="stylesheet" href="/static/default/css/swiper.min.css" /> 
  <link rel="stylesheet" href="/static/default/css/base.css" /> 
  <link rel="stylesheet" href="/static/default/css/main.css" /> 
  <link rel="stylesheet" href="/static/default/css/h5.css" />
  <link rel="stylesheet" href="//at.alicdn.com/t/font_780494_jbelo9fsxsk.css" />
  <script src="/static/default/js/jquery.min.js"></script> 
  <script src="/static/default/js/bootstrap.min.js"></script> 
  <script src="/static/default/js/swiper.min.js"></script> 
  <script src="/static/default/js/jquery.dotdotdot.js"></script> 
  <script src="/static/default/js/js.js"></script>
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
    </div> 
   </div>
  </header>
  <div class="container">
    <div class="service_content">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <h1 class="text-center mb60 color-333 font-36"><?php echo IN_NAME; ?>分发协议</h1>

<p><?php echo IN_NAME; ?> 用户协议已于2019年3月1日更新。</p>
<p><?php echo IN_NAME; ?>（除非特别说明，本服务协议所提及的 <?php echo IN_NAME; ?> 同时包括 <?php echo IN_NAME; ?> 网站）系由芜湖市九鸟网络科技有限公司（以下简称“本公司”或“我们”）搭建并运营的为使用主体（以下简称“用户”或“您”）提供测试应用极速发布等一系列极速开发测试功能的服务平台，我们将通过 <?php echo IN_NAME; ?> 为您提供内测托管、应用合并、命令行工具、权限控制、开放 API、Web Hooks 等服务（以下简称“<?php echo IN_NAME; ?> 服务”或“服务”），服务内容将完全按照 <?php echo IN_NAME; ?> 不时发布或修订的用户协议、隐私政策等规则（以下统称“<?php echo IN_NAME; ?> 服务规则”）严格执行。</p>
<p>本协议是用户与本公司就 <?php echo IN_NAME; ?> 服务所达成的协议，本公司对服务发布的单项条款、活动规则及公告、声明等，均为本协议不可分割的组成部分。如您拒绝接受本协议条款，将无法访问或使用 <?php echo IN_NAME; ?>。如您点击接受本协议或访问、使用 <?php echo IN_NAME; ?> 的全部或部分功能（无论该等访问是通过 <?php echo IN_NAME; ?> 还是通过其他第三方媒介包括但不限于微信、QQ、GitHub 等渠道，下同），即表示您同意并接受本协议的所有条件和条款。如您点击接受本协议或访问、使用 <?php echo IN_NAME; ?> 的全部或部分功能时是代表某一法人、非法人组织等实体，请确保该实体同意接受本协议的所有条件和条款且您已取得该实体的有效授权。</p>
<p>我们将不时对本协议进行修订或重新发布，本协议之修订稿或更新版本一经公布即有效并替代原有协议。用户可随时查阅最新协议，如您不同意相关变更，应立即停止使用 <?php echo IN_NAME; ?> 的各项服务。</p>
<h3 id="-">一、服务适用条件</h3>
<p>1.1 我们只在法律允许的国家与地区提供 <?php echo IN_NAME; ?> 服务，且发布或提供的信息、产品及服务无意提供给受法律限制的国家的人士或居民使用，也不构成对上述主体的任何邀请。</p>
<p>1.2 注册用户应满足下列条件：</p>
<ul>
<li><p>1.2.1 系具有完全民事行为能力的自然人；或系依据中国法律成立并合法存续的法人或非法人组织。</p>
</li>
<li><p>1.2.2 了解并接受本协议及本公司、<?php echo IN_NAME; ?> 发布的一切相关规则，且履行前述协议与规则将不会违反您所属、所居住或开展经营活动或其他业务所在的国家或地区的法律。</p>
</li>
<li><p>1.2.3 按注册页要求提交真实有效的身份信息（法人、非法人组织等实体应提供真实有效的工商资料）与联系方式，并经实名认证审核通过。</p>
</li>
</ul>
<p>1.3 用户在使用发布、应用合并、应用开放下载、命令行工具、权限控制、开放 API、Web Hooks 等功能（以下简称“开发者功能”）时即为“开发者”，用户在使用浏览、下载功能（以下简称“一般功能”）时为“接收者”。任何用户均可使用 <?php echo IN_NAME; ?> 服务中的一般功能，但根据中国相关法律法规的规定，开发者必须经过实名认证方可正常使用 <?php echo IN_NAME; ?> 服务，特别是 <?php echo IN_NAME; ?> 服务中所包含的开发者功能。您接受并理解我们仅为完成登录验证的注册用户提供 <?php echo IN_NAME; ?> 服务中的开发者功能。</p>
<p>1.4 非符合本协议约定条件者不得使用对应的 <?php echo IN_NAME; ?> 服务，一经发现，我们有权立即终止对该用户的服务，并追究其相关责任。</p>
<h3 id="-fir-im-">二、<?php echo IN_NAME; ?> 服务</h3>
<h4 id="2-1-">2.1 服务范围</h4>
<p>2.1.1 我们将通过 <?php echo IN_NAME; ?> 为您提供内测托管、应用合并、命令行工具、权限控制、开放 API、Web Hooks 等 <?php echo IN_NAME; ?> 服务，具体服务内容详见 <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/review-rules.html">https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/review-rules.html</a>。</p>
<h4 id="2-2-">2.2 服务相关注意事项</h4>
<p>2.2.1 <?php echo IN_NAME; ?> 旨在为 iOS 开发、Android 开发、测试工程师、产品经理等专业人士提供更高效的开发测试体验，平台上发布的应用程序均为非公开版本的测试阶段程序，不具备面向不特定公众发布的条件，我们对该等程序仅可进行初步的形式审查，无法详细分析每一应用程序的运行后果及风险。请您审慎地甄别应用程序的质量，切勿因为垃圾短信、邮件、文字说明等内容随意下载来源不可靠的应用程序，请根据应用下载链接的来源自行判断并下载可信任的应用程序。如您非专业人士，请至各应用程序商店搜索并下载特定应用程序的公开版本。对于通过 <?php echo IN_NAME; ?> 发布的应用程序或 <?php echo IN_NAME; ?> 上展示的其他站点的链接，<?php echo IN_NAME; ?> 不对该程序或站点的规则、政策或具体内容负责。</p>
<p>2.2.2 我们有权根据用户类别、使用习惯等实际情况自行决定对该用户数据的最长储存期限，并在服务器上为其分配数据最大存储空间。<?php echo IN_NAME; ?> 对于免费用户数据保存时间为30日，付费用户数据保存时间为次数包消耗完毕后30日。如您采用注销账号、连续365日未登录等形式停止使用 <?php echo IN_NAME; ?> 服务，或被取消 <?php echo IN_NAME; ?> 用户资格、终止服务的，我们有权自您停用或被取消资格满7日后永久删除您储存于本公司服务器上的全部数据，而不负有向您返还前述数据的义务。如您确需前述数据，请务必提前完成数据备份工作。</p>
<p>2.2.3 用户在接受 <?php echo IN_NAME; ?> 各项服务的同时，同意接受我们提供的各类信息服务。用户在此授权本公司通过 <?php echo IN_NAME; ?> 向其电子邮件、手机、通信地址等发送通知及商业信息。用户有权选择不接受 <?php echo IN_NAME; ?> 提供的各类信息服务，可进入 <?php echo IN_NAME; ?> 相关页面进行更改或按照相应联系方式中提示进行操作。</p>
<h4 id="2-3-">2.3 下载次数与付费充值</h4>
<p>2.3.1 请您谅解，<?php echo IN_NAME; ?> 在为您提供更高效的开发测试体验的同时，必须控制某些可能涉嫌违规的应用在未被发现时造成的影响范围，因此 <?php echo IN_NAME; ?> 不得不限制开发者所发布应用的下载次数。</p>
<p>2.3.2 您作为开发者发布的应用程序，每一应用程序经接收者下载一次即消耗管理员账户中的一次下载次数。每一用户每日免费下载次数限制为100次，超过限制后，该用户发布的应用程序将不能下载，如需额外下载次数，请根据实际测试需求提前充值购买下载次数包。下载次数包的类别及收费标准详见 <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/points">https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/points</a>，您认可我们对 <?php echo IN_NAME; ?> 享有费用调整之权利。如您需要包年方案或私有定制方案，欢迎联系 <a href="mailto:<?php echo IN_MAIL; ?>"><?php echo IN_MAIL; ?></a>。</p>
<p>2.3.3 下载次数统一从应用的管理员账户扣除，充值时请注意在管理员账户购买下载次数包，请勿在测试成员的账户下购买，否则，购买的下载次数包只能用户该测试成员的账户所发布的应用程序下载。</p>
<p>2.3.4 本协议终止后，本公司在协议有效期内因提供服务而已经收取的费用不因协议终止而返还。</p>
<h4 id="2-4-">2.4 服务的变更与终止</h4>
<p>2.4.1 <?php echo IN_NAME; ?> 有权行使修改或中断服务的权利，不需对用户或任何无直接关系的第三方负责。如该修改或中断为 <?php echo IN_NAME; ?> 主动发起的，<?php echo IN_NAME; ?> 将于该修改或中断发生前3日将相应通知发布于网站应用管理页面的站内通知位置。如该修改或中断系由不可抗力、意外事件等原因所致而非 <?php echo IN_NAME; ?> 主动发起，则 <?php echo IN_NAME; ?> 将于该修改或中断恢复后1日将相应通知发布于网站应用管理页面的站内通知位置。</p>
<p>2.4.2 为确保用户体验、维护网络安全，您同意我们有权选择是否提供服务，并有权对 <?php echo IN_NAME; ?> 功能、用户权限等进行调整。如您对本协议的修改或我们提供的服务有异议，可以行使如下权利：</p>
<ul>
<li><p>2.4.2.1 停止使用 <?php echo IN_NAME; ?> 服务；</p>
</li>
<li><p>2.4.2.1 将您的建议通过应用管理页面右下角的客服聊天对话框提交给我们，我们感谢并将认真对待您的宝贵建议。</p>
</li>
</ul>
<p>2.4.3 如用户有下列行为之一，我们有权立即解除本协议，并要求用户赔偿本公司因此所致的全部损失：</p>
<ul>
<li><p>2.4.3.1 违反本协议或其他 <?php echo IN_NAME; ?> 服务规则的；</p>
</li>
<li><p>2.4.3.2 利用 <?php echo IN_NAME; ?> 服务进行包括但不限于危害计算机信息网络安全、侵犯知识产权、洗钱、赌博、诈骗、传销、非法集资、淫秽色情、恐怖融资等违法、犯罪活动的，或因涉嫌参与前述活动被公安机关、检察机关决定立案侦查满60日而未撤销案件的；</p>
</li>
<li><p>2.4.3.3 利用 <?php echo IN_NAME; ?> 服务进行包括损害公共秩序、善良风俗或社会道德的行为在内的任何不当行为的；</p>
</li>
<li><p>2.4.3.4 发布不实言论故意诋毁或损害本公司声誉的；</p>
</li>
<li><p>2.4.3.5 无理由拒绝受理用户或客户使用 <?php echo IN_NAME; ?> 进行交易的；</p>
</li>
</ul>
<p>2.4.4 用户出现下列情形之一，本协议自该情形发生之日起即告终止：</p>
<ul>
<li><p>2.4.4.1 自然人用户死亡、成为限制民事行为能力人或成为无民事行为能力人等丧失继续履行本协议能力的；</p>
</li>
<li><p>2.4.4.2 自然人以外的其他用户出现无法继续经营、停业、或进入破产清算程序、解散、注销、被取缔或吊销营业执照等不具备履行本协议的资质及能力的；</p>
</li>
<li><p>2.4.4.3 用户注销账号，或连续未登录 <?php echo IN_NAME; ?> 满365日等形式停止使用 <?php echo IN_NAME; ?> 服务的。</p>
</li>
</ul>
<h3 id="-">三、隐私政策</h3>
<p>用户在使用 <?php echo IN_NAME; ?> 服务过程中应遵守 <?php echo IN_NAME; ?> 不时发布并修订的隐私政策，并受到该政策的保护，详见 <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/privacy">https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/privacy</a>。</p>
<h3 id="-">四、用户权责</h3>
<p>4.1 您在 <?php echo IN_NAME; ?> 注册时，须提供真实身份信息并进行实名认证。如您在完成实名认证后变更任何身份信息，应在变更发生后三个工作日内书面通知 <?php echo IN_NAME; ?> 进行变更认证，否则 <?php echo IN_NAME; ?> 有权随时单方面终止提供服务，因此造成的全部后果，由您自行承担。</p>
<p>注册时，您应向我们提供合法、真实、准确、有效的实名认证资料：</p>
<ul>
<li><p>4.1.1 自然人提供的实名认证资料包括但不限于姓名、身份证号（或其他身份识别号）、本人电话、联系地址、电子邮箱、身份证正面及反面照片、本人手持身份证照片（不能遮挡个人头像）；</p>
</li>
<li><p>4.1.2 法人或非法人组织提供的实名认证资料包括但不限于名称、社会统一信用代码（或其他主体身份识别号）、营业执照副本（或其他主体资质证照）扫描件；公司授权代理人姓名及身份证正面及反面照片、本人手持身份证照片（不能遮挡个人头像）、本人电话、联系地址、电子邮箱（至少提供其一）。</p>
</li>
</ul>
<p>4.2 经我们审核通过后如有信息变更，您应在变更后7日内书面通知我们并通过系统提交资料变更申请。如果您提供的注册资料不合法、不真实、不准确，或有隐瞒的，应承担因此引起的相应责任及后果，并且我们保留中止或终止前述用户使用 <?php echo IN_NAME; ?> 各项服务的权利。</p>
<p>4.3 用户的账户、密码和安全性：</p>
<ul>
<li><p>4.3.1 您选择成为 <?php echo IN_NAME; ?> 注册用户的，可自行创建账户与昵称。账户和昵称的命名及使用应遵守相关法律法规并符合社会道德，不能含有任何侮辱、威胁、淫秽、谩骂等侵害他人合法权益的文字。</p>
</li>
<li><p>4.3.2 用户账户密码遗失的，可以通过注册电子邮箱发送的链接重置密码，如您发现任何非法使用账户或存在其他安全漏洞的情况，请立即告知我们。</p>
</li>
<li><p>4.3.3 您需自行负责维护您的账户、密码 API token 的机密性，您的账号利用 <?php echo IN_NAME; ?> 服务进行的包括但不限于点击同意各类协议与规则、提交或变更身份信息、上传和发布应用程序、信息查询、指令发送等全部操作、直接或间接利用 <?php echo IN_NAME; ?> 服务发送的全部指令，均视为您本人所为的操作、发出的指令，凡行为流程符合 <?php echo IN_NAME; ?> 服务要求，即不可撤销，相应后果将由您承担。任何用户通过您的 API token 所进行的上传应用、获取对应账号下全部应用的下载权限、更改应用信息、下载等操作、指令，都将被视为经您授权所进行的操作、指令，凡行为流程符合 <?php echo IN_NAME; ?> 服务要求，即不可撤销，相应后果将由您承担。</p>
</li>
<li><p>4.3.4 服务中，为确保您账户的安全性，我们将不时验证您的用户身份与资格。验证形式可能包括密码、验证码、账户绑定手机、账户绑定邮箱等，如未能通过相应验证，将可能导致服务的临时性中断，由此所致的损失由您自行承担。</p>
</li>
</ul>
<p>4.4 您应定期备份您账号在我们平台系统中的数据并妥善保管，因未定期备份导致的损失或因此导致的扩大损失应由您自行承担相应后果。如您随应用程序提供免责声明、应用描述，则您可以复制和使用前述内容，但仅供您个人参考之用。</p>
<p>4.5 如在使用 <?php echo IN_NAME; ?> 服务过程中发现异常，请在72小时内联系我们，完整、准确记录当前故障现象后向我们提供故障记录。</p>
<p>4.6 您依据本协议所享有的权利及义务不可转让，亦不得在未经本公司书面同意的情况下以任何方式令第三方使用 <?php echo IN_NAME; ?> 服务或令第三方通过 <?php echo IN_NAME; ?> 发出任何指令信息。</p>
<p>4.7 任何用户不得利用 <?php echo IN_NAME; ?> 服务危害网络安全，不得危害国家安全、荣誉和利益，不得煽动颠覆国家政权、推翻社会主义制度，不得煽动分裂国家、破坏国家统一，不得宣扬恐怖主义、极端主义、民族仇恨、民族歧视，不得传播暴力、淫秽色情信息，不得编造、传播虚假信息扰乱经济秩序和社会秩序，不得侵害他人名誉、隐私、知识产权和其他合法权益。</p>
<p>4.8 任何用户不得利用 <?php echo IN_NAME; ?> 服务制作、复制、发布、传播含有下列内容的信息：</p>
<ul>
<li><p>4.8.1 反对宪法所确定的基本原则的；</p>
</li>
<li><p>4.8.2 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；</p>
</li>
<li><p>4.8.3 损害国家荣誉和利益的；</p>
</li>
<li><p>4.8.4 煽动民族仇恨、民族歧视，破坏民族团结的；</p>
</li>
<li><p>4.8.5 破坏国家宗教政策，宣扬邪教和封建迷信的；</p>
</li>
<li><p>4.8.6 散布谣言，扰乱社会秩序，破坏社会稳定的；</p>
</li>
<li><p>4.8.7 散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；</p>
</li>
<li><p>4.8.8 侮辱或者诽谤他人，侵害他人合法权益的；</p>
</li>
<li><p>4.8.9 含有法律、行政法规禁止的其他内容的。</p>
</li>
</ul>
<p>4.9 用户不得通过任何手段恶意注册 <?php echo IN_NAME; ?> 账户，亦不得盗用其他用户账户。禁止用户将 <?php echo IN_NAME; ?> 以任何形式作为从事各种非法活动的场所、平台或媒介。我们严禁用户（不论是否完成实名认证）利用 <?php echo IN_NAME; ?> 服务对开发者发布的应用程序进行恶意的多次重复下载。如您作为开发者发布的应用程序受到任何第三方恶意的多次重复下载的，请在应用管理页面通过线上客服沟通工具与客服联系。</p>
<p>4.10 用户不得以任何形式破坏或规避 <?php echo IN_NAME; ?> 服务中的任何技术限制，亦不得以任何形式破坏或规避其他用户发布的应用程序中的任何技术限制，不得在未取得权利人明确书面授权的情况下对 <?php echo IN_NAME; ?> 或应用程序进行复制、发布、出租、出借、反向工程、反向编译或反汇编等操作。</p>
<p>4.11 开发者特殊规则</p>
<ul>
<li><p>4.11.1 发布前，对于您通过 <?php echo IN_NAME; ?> 所要发布的应用程序所包含的全部内容，请确认您均系其合法权利人或已经取得权利人的依法授权，前述应用程序不得包含任何恶意代码，不应侵犯任何第三方的合法权益。</p>
</li>
<li><p>4.11.2 您通过 <?php echo IN_NAME; ?> 发布的应用程序如需收集任何他人个人信息，该等信息应为您提供服务所必须收集的信息，否则不得收集。收集该等信息前必须经过被收集者同意。您同意接受并承诺您的应用程序对被收集者信息的保护力度不低于 <?php echo IN_NAME; ?> 对外公布的最新隐私政策 <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/privacy">https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/privacy</a>。</p>
</li>
<li><p>4.11.3 您通过 <?php echo IN_NAME; ?> 发布的应用程序不得在未经未成年人法定代理人同意的情况下收集或发布任何未成年人的身份信息和地理位置、指纹、声纹、面部识别、使用偏好等隐私信息。</p>
</li>
<li><p>4.11.4 您通过 <?php echo IN_NAME; ?> 发布的应用程序不得未经接收者同意而向其发送任何商业信息，经接收者同意而发送的商业信息中应包含您的真实身份和联系方式，并向接收者提供拒绝继续接收的方式。</p>
</li>
<li><p>4.11.5 您应当保障接收者在安装或使用您发布的应用程序过程中的知情权和选择权，未向接收者明示并经其同意，不得开启收集地理位置、读取通讯录、使用摄像头、启用录音等功能，不得开启与服务无关的功能，不得捆绑安装无关应用程序。</p>
</li>
<li><p>4.11.6 您发布的应用程序不得采取任何方式诱导接收者，令其误以为该应用程序存在由 <?php echo IN_NAME; ?> 发布、由 <?php echo IN_NAME; ?> 提供服务、与 <?php echo IN_NAME; ?> 发生款项往来或由 <?php echo IN_NAME; ?> 承担任何责任等情形。</p>
</li>
</ul>
<p>4.12 未经本公司的授权或许可，任何主体不得借用本公司或 <?php echo IN_NAME; ?> 的名义从事任何商业活动，也不得以任何形式将 <?php echo IN_NAME; ?> 作为从事商业活动的场所、平台或媒介。</p>
<p>4.13 用户违反本协议规定，则 <?php echo IN_NAME; ?> 有权直接采取一切必要的措施，包括但不限于警告、临时性或永久性冻结单一用户账户、临时性或永久性冻结同一邮箱或同一手机号码对应的全部用户账户查询账户交易信息、强制注销账户、临时性或永久性冻结应用程序下载功能、向有关机关提供包括实名认证信息、交易记录在内的账户信息，甚至于通过司法途径追究用户相应法律责任等。用户违反本用户协议之行为给本公司、其他用户或其他第三方造成损失的，应对受害方进行赔偿。</p>
<h3 id="-">五、知识产权及其他权利</h3>
<p>5.1 如无其他声明，我们提供本协议项下服务所涉及的全部产品、技术、软件、程序、数据及其他信息（包括但不限于文字、图形、徽标、按钮图标、图像、音频、视频、图表、色彩、版面设计、电子文档、数据编译、软件及内容汇编称一体的连贯的网站）的所有权利（包括但不限于著作权、商标权、专利权、商业秘密及其他所有相关权利）均归本公司所有。未经本公司书面许可，您不得以任何形式擅自使用（包括但不限于通过任何程序或设备监视、复制、传播、展示、镜像、上传、下载任何内容）或许可他人使用。</p>
<p>5.2 本公司的 Logo、“<?php echo IN_NAME; ?>”、<?php echo IN_NAME; ?> 标识等文字、图形及其组合，以及 <?php echo IN_NAME; ?> 的其他图形、徽标、产品和服务名称均由本公司享有完全的权利，未经我们书面授权，您不得以任何方式进行展示、使用、创造相关衍生作品或作其他处理，也不得向任何第三方表明您有权展示、使用、创造相关衍生作品或作其他处理。</p>
<p>5.3 用户如有违反前款约定，因侵犯权利所得收益归本公司所有，并应赔偿本公司因此所受到的损失。</p>
<h3 id="-">六、拒绝担保与免责</h3>
<p>6.1 <?php echo IN_NAME; ?> 作为提供极速开发测试的服务平台，基于互联网的特殊性及现有技术的局限性，我们仅可按照 <?php echo IN_NAME; ?> 现状提供服务，无法担保 <?php echo IN_NAME; ?> 上的信息及服务能充分满足用户的需求，亦无法就服务的及时、安全、无中断、无缺陷、无错误作任何保证。您应自行承担服务 <?php echo IN_NAME; ?> 的使用风险，请确认在使用服务前您已经充分了解 <?php echo IN_NAME; ?> 现状。</p>
<p>6.2 在我们通过 <?php echo IN_NAME; ?> 向您提供服务的过程中如发生“不可抗力”，即发生无法预见、无法避免或合理控制的事件，且该等事件对遭遇不可抗力的一方履行本协议的行为发生实质性妨碍，包括但不限于地震、台风、洪水、战争、暴动、罢工、火灾、政府政策变更、政府或政府委托的单位或机构作出的行政及司法行为、黑客攻击、电脑病毒、网络故障、电信/联通管制、带宽或其他网络设备或通讯运营商服务延迟及技术故障等类似事件，致使我们无法全部或部分履行本协议的，本公司不因此而承担任何责任，但我们将采取一切必要措施减少损失，并在事件消除后尽最大努力恢复服务。</p>
<p>6.3 由于电信运营商等服务所依赖的第三方服务提供商之系统、线路的故障、调整、升级，或电力中断/终断，或黑客攻击、木马、病毒、技术或网络故障、系统升级、电信/联通管制、带宽或其他网络设备或通讯运营商服务延迟等原因造成服务无法正常提供的，本公司不因此而承担任何责任。</p>
<p>6.4 在任何情况下，对于您使用我们服务过程中涉及由第三方提供相关服务的责任由该第三方承担，本公司不承担相应责任：</p>
<ul>
<li><p>6.4.1 因 <?php echo IN_NAME; ?> 服务所依赖的第三方之违法、不当行为致使用户受损的；</p>
</li>
<li><p>6.4.2 因 <?php echo IN_NAME; ?> 其他用户违法、不当行为致使用户受损的；</p>
</li>
<li><p>6.4.3 因其他 <?php echo IN_NAME; ?> 不可控的原因导致的任何损失或责任。</p>
</li>
</ul>
<p>6.5 因您自身原因导致的任何损失或责任，由用户自行负责，包括但不限于：</p>
<ul>
<li><p>6.5.1 未按照本协议或我们发布的任何规则进行操作导致的任何损失或责任；</p>
</li>
<li><p>6.5.2 发送的电子指令信息不明、存在乱码、不完整等；</p>
</li>
<li><p>6.5.3 您未经审慎确认即对任何第三方开放权限、发送信息、支付金钱等；</p>
</li>
<li><p>6.5.4 其他由您所导致的任何损失或责任。</p>
</li>
</ul>
<p>6.6 在我们提供服务过程中，如出现数据误差，我们将与您密切配合查明原因。由于互联网相关之技术服务的特殊性，我们对非因我们过错所致的损失，不承担相应责任。如确因我们过错给您造成损失的，本公司将予以赔偿，赔偿额度以数据误差次数包总额之2倍为限。</p>
<p>6.7 <?php echo IN_NAME; ?> 发给用户的通告，我们都将通过正式的页面公告、站内信、电子邮件、短信或常规的信件送达。对于任何非经 <?php echo IN_NAME; ?> 正规渠道获得的中奖、优惠等活动、通知或信息，本公司不承担相应责任。</p>
<h3 id="-">七、投诉通道</h3>
<p>7.1 如果用户或任何第三方认为并有法律依据和足够的证据证明本公司或 <?php echo IN_NAME; ?> 用户存在以下行为，有权联系我们进行投诉，我们将在审慎地进行调查后，根据自身判断决定是否对相关对象采取删除、冻结、屏蔽、断开连接、诉诸法律手段等必要措施：</p>
<ul>
<li><p>7.1.1 用户从事违法行为、不当行为或违反本协议约定之行为的；</p>
</li>
<li><p>7.1.2 用户被删除、改变了自己管理电子信息权限的；</p>
</li>
<li><p>7.1.3 用户受到来自其他 <?php echo IN_NAME; ?> 账号恶意刷下载量等恶意行为攻击的；</p>
</li>
<li><p>7.1.4 本公司或 <?php echo IN_NAME; ?> 发布的任何信息侵犯您的合法权益的。</p>
</li>
</ul>
<p>7.2 投诉应当以书面形式进行，您可以通过下列方式发送您的书面投诉：</p>
<p>邮箱：<a href="mailto:<?php echo IN_MAIL; ?>"><?php echo IN_MAIL; ?></a></p>
<p>7.3 投诉内容应包括：</p>
<ul>
<li><p>7.3.1 权利人的姓名（名称）、身份证号，手机号；</p>
</li>
<li><p>7.3.2 要求我们采取相应措施的应用被举报的原因；</p>
</li>
<li><p>7.3.3 前述内容违反法律或侵犯您合法权益的初步证明材料。</p>
</li>
</ul>
<p>7.4 我们提请用户注意：</p>
<ul>
<li><p>7.4.1 包含前述各项内容的投诉方为有效投诉。我们的工作人员将在15日内进行回复您的有效投诉。</p>
</li>
<li><p>7.4.2 您应当对前述投诉内容的真实性负责，如果您恶意投诉不实信息，将有可能承担相应的法律责任。</p>
</li>
</ul>
<h3 id="-">八、适用法律和裁判地点</h3>
<p>8.1 因本协议而引起或与之相关的一切争议、权利主张或其它事项，均受中华人民共和国法律（香港、澳门、台湾地区法律除外）的管辖。</p>
<p>8.2 用户和本公司因履行本协议发生争议的，应首先本着诚信原则通过协商加以解决。如果协商不成，则应向本公司所在地人民法院提起诉讼。</p>
<h3 id="-">九、可分性</h3>
<p>如果本协议的任何条款被视为不合法、无效或因任何原因而无法执行，则此等规定应视为可分割，不影响任何其它条款的法律效力。</p>
<h3 id="-">十、冲突选择</h3>
<p>本协议是本公司与用户注册成为 <?php echo IN_NAME; ?> 用户，使用 <?php echo IN_NAME; ?> 服务之间的重要法律文件，此前双方任何非书面意思表示与本协议不一致的，均应当以本协议为准。</p>
<h3 id="-">十一、完整协议</h3>
<p>包括本协议、隐私政策在内的 <?php echo IN_NAME; ?> 规则，及其补充和更新条款共同构成 <?php echo IN_NAME; ?> 完整的服务协议。</p>    </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
<footer>
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