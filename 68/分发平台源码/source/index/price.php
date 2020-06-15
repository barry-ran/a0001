
<!doctype html>
<html lang="zh">
<head>
<title><?php echo IN_NAME; ?>-领先的应用服务平台|免费的app封装打包-IPA签名-苹果企业签名-ios企业账号-内测分发托管</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="renderer" content="webkit">
<meta name="keywords" content="内测分发平台,企业签名,苹果企业签名,ios签名,app自动更新,网页一键封装,app在线生成平台,app打包封装">
<meta property="og:url" content="<?php echo IN_NAME; ?>">
<meta property="og:title" content="<?php echo IN_NAME; ?>">
<meta name="baidu-site-verification" content="WDULFadCJ9" />
<meta name="description" content="<?php echo IN_NAME; ?>提供制作苹果IOS、安卓Android手机APP、内测分发托管、ios企业签名、版本自动更新等功能,是一家高效的移动应用解决方案的服务平台">
<link rel="stylesheet" href="//at.alicdn.com/t/font_780494_fdjuk9baed7.css" />
<script src="https://js.fundebug.cn/fundebug.1.7.3.min.js" apikey="e4aa795e479041a54ee593c7542f363ad85fa50c91d8152f49a318672ed9459f"></script>
<link rel="stylesheet" href="/static/default/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="/static/default/css/base.css" />
<link rel="stylesheet" href="/static/default/css/main.css" />
<link rel="stylesheet" href="/static/default/css/h5.css" />
<script src="/static/default/js/jquery.min.js"></script>
<script src="/static/default/js/bootstrap.min.js"></script>
<script src="/static/default/js/vue.js"></script>
<script src="/static/default/js/js.js"></script>
<link rel="shortcut icon" href="//appjs.ww1994.com/favicon.ico" type="image/x-icon" />
<script>        
	isHideFooter = false;
</script><body>
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
</li>
<li class="">
<a href="/" title="">首页</a>
</li>
<li class="">
<a href="/user/price" title="">签名分发价格</a>
</li>
 <li class="">
<a href="/user/webview" title="">免签封装/标准封装</a>
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
<span class="icon-menu iconfont phone-menu visible-xs"></span>
<div class="phone-shadow"></div>
</div>
</div>
</header><div class="hidden-xs">
<div class="new-price-banner">
<div class="container">
<div class="banner-con">
<h3>零度云价格与服务</h3>
<p>开启高效的移动APP解决方案，全程自助服务</p>
</div>
</div>
</div>
<div class="container">
<div class="price-tab">
<ul class="clearfix">
<li class="active">分发套餐</li>
<li>企业签名套餐</li>
</ul>
</div>
<div class="price-con">
<div class="tab-1" style="display: block;">
<div class="buy-number">
<div class="price-common">
<h1>应用分发套餐</h1>
<p class="p1">不限使用时间，免费每天赠送10次下载</p>
<div class="row clearfix">
<div class="col-sm-4">
<div class="con">
<div class="gradient gradient1">
</div>
<div class="c-top">
<div class="text">充值</div>
<div class="num">2,000<span>点数</span>
</div>
<span class="recommended" style="display: none;"><img src="/static/default/img/icon-17.png"></span>
</div>
<div class="bottom-con">
<dl>
<dd><span class="iconfont icon-gou color-hover"></span>CDN加速下载</dd>
<dd><span class="iconfont icon-gou color-hover"></span>下载页无广告</dd>
<dd><span class="iconfont icon-gou color-hover"></span>APP可以永久保存</dd>
<dd><span class="iconfont icon-gou color-hover"></span>默认模板使用</dd>
</dl>
<div class="b-price">
<span>20</span>元
</div>
</div>
<div class="bottom">
 <a href="/codepay/?user=<?php echo $GLOBALS['erduo_in_username']; ?>&price=20  " onclick="" class="btn btn-buy ms-btn-secondary ms-btn">购买</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="con">
<div class="gradient gradient2">
</div>
<div class="c-top">
<div class="text">充值</div>
<div class="num">10.000<span>点数</div>
<span class="recommended" style="display: block;"><img src="/static/default/img/icon-17.png"></span>
</div>
<div class="bottom-con">
<dl>
<dd><span class="iconfont icon-gou color-hover"></span>CDN加速下载</dd>
<dd><span class="iconfont icon-gou color-hover"></span>下载页无广告</dd>
<dd><span class="iconfont icon-gou color-hover"></span>APP可以永久保存</dd>
<dd><span class="iconfont icon-gou color-hover"></span>默认模板使用</dd>
</dl>
<div class="b-price">
<span>100</span>元
</div>
</div>
<div class="bottom">
 <a href="/codepay/?user=<?php echo $GLOBALS['erduo_in_username']; ?>&price=100  " onclick="" class="btn btn-buy ms-btn-secondary ms-btn">购买</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="con">
<div class="gradient gradient3">
</div>
<div class="c-top">
<div class="text">充值</div>
<div class="num">20,000<span>点数</div>
<span class="recommended" style="display: none;"><img src="/static/default/img/icon-17.png"></span>
</div>
<div class="bottom-con">
<dl>
<dd><span class="iconfont icon-gou color-hover"></span>CDN加速下载</dd>
<dd><span class="iconfont icon-gou color-hover"></span>下载页无广告</dd>
<dd><span class="iconfont icon-gou color-hover"></span>APP可以永久保存</dd>
<dd><span class="iconfont icon-gou color-hover"></span>默认模板使用</dd>
</dl>
<div class="b-price">
<span>200</span>元
</div>
</div>
<div class="bottom">
 <a href="/codepay/?user=<?php echo $GLOBALS['erduo_in_username']; ?>&price=200  " onclick="" class="btn btn-buy ms-btn-secondary ms-btn">购买</a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="price-common">
<h1>常见问题</h1>
<div class="help">
<dl>
<dt class="clearfix">
<span class="left">Q ：</span>
<span class="right">支持安卓和苹果同一个二维码下载吗？</span>
</dt>
<dd class="clearfix">
<span class="left">A ：</span>
<span class="right">支持，上传好IPA和APK包后，在【我的应用】中，选择要合并的APP，点击合并应用即可。</span>
</dd>
</dl>
<dl>
<dt class="clearfix">
<span class="left">Q ：</span>
<span class="right">如何查看剩余点数？</span>
</dt>
<dd class="clearfix">
<span class="left">A ：</span>
<span class="right">登录账号，进入【我的应用】，便能查看剩余点数。</span>
</dd>
</dl>
<dl>
<dt class="clearfix">
<span class="left">Q ：</span>
<span class="right">有时候iOS APP不能下载，是下载链接的问题吗？</span>
</dt>
<dd class="clearfix">
<span class="left">A ：</span>
<span class="right">iOS APP需要做企业签名，才可以安装，如果没有做过企业签名or企业签名失效，则iOS APP会下载失败。安卓APP则不需要做企业签名。</span>
</dd>
</dl>
</div>
</div>
</div>
<div class="tab-3">
<div class="buy-number">
<div class="price-common">
<h1>企业签名（独立稳定版）</h1>
<p class="p1"><td class="lineheight smallfont team"><a href="http://wpa.qq.com/msgrd?v=3&uin=1379898507&site=JIZHI&menu=yes" target="_blank" class="lightlink2 smallfont">苹果签名-点击联系（需要对接自动签名可联系）</a></td></tr></p>
<div class="row clearfix">
<div class="col-sm-4">
<div class="con">
<div class="gradient gradient1">
</div>
<div class="c-top">
<div class="text">包月秘钥</div>
<div class="num"><span><img src="/static/default/img/user_1.png" style="width: 50px;"></span>
</div>
<span class="recommended" style="display: none;"><img src="/static/default/img/icon-17.png"></span>
</div>
<div class="bottom-con">
<dl>
<dd><span class="iconfont icon-gou color-hover"></span>客服签名</dd>
<dd><span class="iconfont icon-gou color-hover"></span>更新次数无限制</dd>
<dd><span class="iconfont icon-gou color-hover"></span>下载app数量无限制</dd>
<dd><span class="iconfont icon-gou color-hover"></span>稳定性佳</dd>
</dl>
<div class="b-price">
<span>200</span>元/月
</div>
</div>
<div class="bottom">
<a href="http://wpa.qq.com/msgrd?v=3&uin=1379898507&site=qq&menu=yes" onclick="" class="btn btn-buy ms-btn-secondary ms-btn">购买</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="con">
<div class="gradient gradient2">
</div>
 <div class="c-top">
<div class="text">包季秘钥</div>
<div class="num"><span><img src="/static/default/img/user_2.png" style="width: 50px;"></span>
</div>
<span class="recommended" style="display: none;"><img src="/static/default/img/icon-17.png"></span>
</div>
<div class="bottom-con">
<dl>
<dd><span class="iconfont icon-gou color-hover"></span>客服签名</dd>
<dd><span class="iconfont icon-gou color-hover"></span>更新次数无限制</dd>
<dd><span class="iconfont icon-gou color-hover"></span>下载app数量无限制</dd>
<dd><span class="iconfont icon-gou color-hover"></span>稳定性佳</dd>
</dl>
<div class="b-price">
<span>500</span>元/季
</div>
</div>
<div class="bottom">
<a href="http://wpa.qq.com/msgrd?v=3&uin=1379898507&site=qq&menu=yes" onclick="" class="btn btn-buy ms-btn-secondary ms-btn">购买</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="con">
<div class="gradient gradient3">
</div>
<div class="c-top">
<div class="text">包年秘钥</div>
<div class="num"><span><img src="/static/default/img/user_3.png" style="width: 50px;"></span>
</div>
<span class="recommended" style="display: none;"><img src="/static/default/img/icon-17.png"></span>
</div>
<div class="bottom-con">
<dl>
<dd><span class="iconfont icon-gou color-hover"></span>客服签名</dd>
<dd><span class="iconfont icon-gou color-hover"></span>更新次数无限制</dd>
<dd><span class="iconfont icon-gou color-hover"></span>下载app数量无限制</dd>
<dd><span class="iconfont icon-gou color-hover"></span>稳定性佳</dd>
</dl>
<div class="b-price">
<span>1800</span>元/年
</div>
</div>
<div class="bottom">
<a href="http://wpa.qq.com/msgrd?v=3&uin=1379898507&site=qq&menu=yes" onclick="" class="btn btn-buy ms-btn-secondary ms-btn">购买</a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="price-common">
<h1>常见问题</h1>
<div class="help">
<dl>
<dt class="clearfix">
<span class="left">Q ：</span>
<span class="right">会员有有效期吗？</span>
</dt>
<dd class="clearfix">
<span class="left">A ：</span>
<span class="right">本站会员，一次开通永久不过期。</span>
<dl>
<dt class="clearfix">
<span class="left">Q ：</span>
<span class="right">Q ： 会不会中途掉包？？</span>
</dt>
<dd class="clearfix">
<span class="left">A ：</span>
<span class="right">掉包闪退就是证书被封停，一张证书签名应用量过多或者签了违规应用，导致使用人数过多，苹果官方封证书，就会导致掉包闪退，我们利用分类限量签名，最大程度的保持了签名的稳定性，为客户提供最优质的服务。</span>
<dl>
<dt class="clearfix">
<span class="left">Q ：</span>
<span class="right">什么叫分类限量签名？</span>
</dt>
<dd class="clearfix">
<span class="left">A ：</span>
<span class="right">常规来说一个证书可以签无数个应用，但是签的越多就越容易封证书（证书封了就是掉线闪退的意思），我们证书一个只签不超过10个应用，并且分类明确，不同类型的APP使用不同的证书来签名,我们证书充足，每一张的签名数量有限，系统自动对APP进行了风险评估归类，最大化的保证客户的APP稳定运营。</span>
<dl>
<dt class="clearfix">
<span class="left">Q ：</span>
<span class="right">个人证书签名和企业证书签名有什么不同？</span>
</dt>
<dd class="clearfix">
<span class="left">A ：</span>
<span class="right">老司机用户都有过掉包闪退的问题，带来的是客户流失，损失惨重，我们保证提供的证书是稳定安全的，建议选用包3个月及以上的套餐，独立证书，使用的人少，自然不掉线。</span>
<dl>
<dt class="clearfix">
<span class="left">Q ：</span>
<span class="right">签名需要多长时间？</span>
</dt>
<dd class="clearfix">
<span class="left">A ：</span>
<span class="right">购买秘钥后在应用管理中，开通签名期限，然后在签名界面点击立即签名，稍等片刻等待签名完成即可上线安装。。</span>
</dd>
</dl>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="visible-xs">
<div class="mobile-price">
<div class="new-price-tab">
<ul class="tab clearfix">
<li class="active"><a href="javascript:;">分发套餐</a></li>
<li><a href="javascript:;">企业签名</a></li>
<li><a href="javascript:;">会员套餐</a></li>
</ul>
</div>
<div class="m-price-banner">
<div class="swiper-container">
<div class="swiper-wrapper">
<div class="swiper-slide" style="background-image: url(/static/default/img/m-price-1.jpg)">
<div class="tit">快鸟云价格与服务</div>
<p>开启高效的移动APP解决方案，全程<br>自助服务</p>
</div>
</div>
</div>
</div>
<div class="container">
<div class="new-price-con">
<div class="tab-4" style="display: block;">
<div class="m-price-common m-publish">
<div class="tit-wrap">
<ul class="tit clearfix">
<li class="left"><img src="/static/default/img/m-price-4.png"></li>
<li class="center">应用分发套餐</li>
<li class="right"><img src="/static/default/img/m-price-5.png"></li>
</ul>
<div class="p2">实名认证后，每天免费赠送<span>20</span>次</div>
<div class="publish-angle">1~1.5G</div>
</div>
<div class="row">
<div class="col-xs-4">
<div class="con con0">
<div class="level">2,500<span>云币</span></div>
<div class="msg">套餐一</div>
<div class="num"><span>50</span>元</div>
</div>
</div>
<div class="col-xs-4">
<div class="con con1">
<div class="level">49,950<span>云币</span></div>
<div class="msg">套餐二</div>
<div class="num"><span>999</span>元</div>
<span class="recommended">推荐</span>
</div>
</div>
<div class="col-xs-4">
<div class="con con2">
<div class="level">7,500<span>云币</span></div>
<div class="msg">套餐三</div>
<div class="num"><span>150</span>元</div>
</div>
</div>
</div>
</div>
<div class="m-publish-buy clearfix">
<a href="/index.php/price_cloud?id=1003" class="small1"><span class="iconfont icon-gouwuche"></span>购买套餐一</a>
<a href="/index.php/price_cloud?id=1004" class="big1"><span class="iconfont icon-gouwuche"></span>购买套餐二</a>
<a href="/index.php/price_cloud?id=1005" class="big2"><span class="iconfont icon-gouwuche"></span>购买套餐三</a>
</div>
</div>
<div class="tab-5">
<div class="m-price-common m-pack-price">
<div class="tit-wrap">
<ul class="tit clearfix">
<li class="left"><img src="/static/default/img/m-price-4.png"></li>
<li class="center">应用签名</li>
<li class="right"><img src="/static/default/img/m-price-5.png"></li>
</ul>
</div>
<div class="row">
<div class="col-xs-4">
<div class="con">
<div class="level">暂未开启</div>
<div class="img-wrap">
<img src="/static/default/img/m-price-7.png">
</div>
<div class="msg">待开启</div>
<div class="num"><span>100</span>元</div>
</div>
</div>
</div>
</div>
</div>
<div class="tab-6">
<div class="m-price-common m-publish">
<div class="tit-wrap">
<ul class="tit clearfix">
<li class="left"><img src="/static/default/img/m-price-4.png"></li>
<li class="center">会员套餐</li>
<li class="right"><img src="/static/default/img/m-price-5.png"></li>
</ul>
<div class="p2">实名认证后，每天免费赠送<span>1000</span>次</div>
<div class="publish-angle">1~300M</div>
</div>
<div class="row">
<div class="col-xs-4">
<div class="con con0">
<div class="level">
初级会员
</div>
<div class="img-wrap">
<img src="/static/default/img/m-price-7.png">
</div>
<div class="msg">&nbsp;&nbsp;&nbsp;500M应用存储容量</div>
<div class="msg">最大可上传100M应用</div>
<div class="msg">下载页有广告</div>
<div class="msg">CDN加速下载</div>
<div class="num">
<span>98元</span>/年
</div>
<span class="recommended" style="display: none;">限时特惠</span>
</div>
</div>
<div class="col-xs-4">
<div class="con con1">
<div class="level">
中级会员
</div>
<div class="img-wrap">
<img src="/static/default/img/m-price-7.png">
</div>
<div class="msg">2000M应用存储容量</div>
<div class="msg">最大可上传500M应用</div>
<div class="msg">下载页无广告</div>
<div class="msg">CDN加速下载</div>
<div class="num">
<span>168元</span>/年
</div>
<span class="recommended" style="display: none;">限时特惠</span>
</div>
</div>
<div class="col-xs-4">
<div class="con con2">
<div class="level">
高级会员
</div>
<div class="img-wrap">
<img src="/static/default/img/m-price-7.png">
</div>
<div class="msg">5000M应用存储容量</div>
<div class="msg">最大可上传1000M应用</div>
<div class="msg">下载页无广告</div>
<div class="msg">CDN加速下载</div>
<div class="num">
<span>268元</span>/年
</div>
<span class="recommended">限时特惠</span>
</div>
</div>
</div>
</div>
 <div class="m-publish-buy clearfix">
<a href="/index.php/price_vip?id=1006" class="small1"><span class="iconfont icon-gouwuche"></span>购买初级会员</a>
<a href="/index.php/price_vip?id=1007" class="big1"><span class="iconfont icon-gouwuche"></span>购买中级会员</a>
<a href="/index.php/price_vip?id=1008" class="big2"><span class="iconfont icon-gouwuche"></span>购买高级会员</a>
</div>
</div>
</div>
</div>
</div>
</div>

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