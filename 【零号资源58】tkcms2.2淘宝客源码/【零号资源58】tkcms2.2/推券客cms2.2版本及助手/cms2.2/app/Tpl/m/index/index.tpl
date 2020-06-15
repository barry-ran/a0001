<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>{$page_seo.title}</title>
		<meta name="keywords" content="{$page_seo.keywords}" />
		<meta name="description" content="{$page_seo.description}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="mip-format-detection" content="telephone=no" />
		<meta name="full-screen" content="yes">
        <meta name="x5-fullscreen" content="true">
		<link rel="stylesheet" href="__STATIC__/tqkwap/fonts/iconfont.css" />
		<link rel="stylesheet" href="__STATIC__/tqkwap/css/amazeui.min.css">
		<link rel="stylesheet" href="__STATIC__/tqkwap/css/index.css" />
	</head>
	<body class="wbg-ef">
		<!--header-->
		<header data-am-widget="header" class="am-header am-header-default am-header-fixed bar-nav">
			<form action="{:U('cate/index')}" id="so" method="get">
	    		<div class="searchtop">
	    			<span class="iconfont icon-search"></span>
				    <input type="text" value="{$key}" onblur="$('#so').submit()" name="k" placeholder="搜搜看您想要的商品优惠券">
	    		</div>
				<button type="submit" class="headsub">搜索</button>
			</form>
			<include file="public:nav" />
	</header>
		<main>
			<div class="banner">
				<div data-am-widget="slider" class="am-slider am-slider-a1" data-am-slider='{directionNav:false}' >
					<ul class="am-slides">
						<volist name="ad_list" id="ad">
					    <li>
					     	<a href="{$ad.url}"><img src="{$ad.img}" width="100%"></a>
					    </li>
					    </volist>
					</ul>
				</div>
			</div>
			<div class="toutiao">
				<a href="{:U('article/index')}{$trackurl}"><img  src="__STATIC__/tqkwap/images/toutiao.png" width="100%" class="am-img-responsive"></a>
				<div class="am-slider am-slider-default notice" data-am-flexslider="{direction: 'vertical',directionNav: false,controlNav: false, slideshowSpeed: 1000}">
					<ul class="am-slides">
						<volist name="article_list" id="article">
							<li>
								<a href="<if condition="C('URL_MODEL') eq 2 and C('APP_SUB_DOMAIN_DEPLOY') eq true">/article/view_{$article.id}{$trackurl}<else/>{:U('/m/article/read',array('id'=>$article['id']))}{$trackurl}</if>">{$article.title}</a>
							</li>
						</volist>
					</ul>
				</div>
			</div>
			<div class="nav wbg">
				<table>
					<tr>
						<td><a href="{:U('jiu/index')}{$trackurl}" class="am-cf"><div><h4>9块9</h4><p>9.9包邮疯抢</p></div><span class="rowimg _9"></span></a></td>
						<td><a href="{:U('jingxuan/index')}{$trackurl}" class="am-cf"><div><h4>大额券</h4><p>巨额优惠超值送</p></div><span class="rowimg daequan"></span></a></td>
					</tr>
					<tr>
						<td><a href="{:U('basklist/index')}{$trackurl}" class="am-cf"><div><h4>晒单赚积分</h4><p>积分兑好礼</p></div><span class="rowimg taoqg"></span></a></td>
						<td><a href="{:U('top100/index')}{$trackurl}" class="am-cf"><div><h4>热销榜</h4><p>千万销量值得信赖</p></div><span class="rowimg rexiao"></span></a></td>
					</tr>
				</table>
			</div>
			<div class="brand">
				<a href="{:U('brand/index')}" class="tit"><h4>品牌券</h4><span>知名品牌大额优惠券</span></a>
				<div class="coupon flexbox">
<volist name='brand' id="vo">
					<div class="coupon-item"><a href="{:U('cate/index',array('k'=>$vo['brand']))}"><img height="45" width="75" alt="{$vo.brand}" src="{$vo.logo}" /><p>{$vo.brand}</p><span class="c-main">{$vo.remark}</span></a></div>
</volist>	
				</div>
			</div>
			
			<form action="/?g=m&m=jump" id="jump" method="post" class="wbg">
				<div class="goods-list am-cf" >
					<volist name='list' id="vo">
						<if condition="$vo['coupon_click_url'] neq '' ">
							<div class="goods-item">
								<div class="tqk_pic">
									<a data-transition="slide" rel="{$vo.quan}" data-cnzz="{$vo.num_iid}" quanurl="{$vo.coupon_click_url}" href="javascript:;" class="img QtkSelfClick jump">
										<div class="lq">
											<div class="lq-t">
												<p class="lq-t-d1">领优惠券</p>
												<p class="lq-t-d2">省{$vo.quan}元</p>
											</div>
											<div class="lq-b"></div>
										</div>
										<img  width="100%" height="auto" src="{$vo.pic_url}_400x400.jpg">
									</a>
								</div>
								<a data-transition="slide" rel="nofollow" href="javascript:;" class="title QtkSelfClick">
									<div class="text">{$vo.title}</div>
								</a>
								<div class="tqkprice"><span>￥{$vo.coupon_price}</span><i class="iquanhou"></i></div>
								<div class="price-wrapper">
									<span class="text tqkico"><if condition="$vo.shop_type eq 'B'">天猫<else/>淘宝</if>在售</span><span class="price">{$vo.price}元</span>
									<div class="sold-wrapper"><span class="sold-num">{$vo.volume}</span><span class="text">人已买</span></div>
								</div>
							</div>
							<else/>
							<div class="goods-item">
								<div class="tqk_pic">
									<a data-transition="slide" href="{$vo.linkurl}{$trackurl}" class="img QtkSelfClick">
										<div class="lq">
											<div class="lq-t">
												<p class="lq-t-d1">领优惠券</p>
												<p class="lq-t-d2">省{$vo.quan}元</p>
											</div>
											<div class="lq-b"></div>
										</div>
										<img  width="100%" height="auto" src="{$vo.pic_url}_400x400.jpg">
									</a> 
								</div>
								<a data-transition="slide" rel="nofollow" href="{$vo.linkurl}" class="title QtkSelfClick">
									<div class="text">{$vo.title}</div>
								</a>
								<div class="tqkprice"><span>￥{$vo.coupon_price}</span><i class="iquanhou"></i></div>
								<div class="price-wrapper">
									<span class="text tqkico"><if condition="$vo.shop_type eq 'B'">天猫<else/>淘宝</if>在售</span><span class="price">{$vo.price}元</span>
									<div class="sold-wrapper"><span class="sold-num">{$vo.volume}</span><span class="text">人已买</span></div>
								</div>
							</div>
						</if>
					</volist>
				</div>
				<div class="am-text-center am-padding">
					<a href="{:U('cate/index',array('p'=>2))}" class="am-btn index-more">查看更多优惠券</a>
				</div>
				<input type="hidden" id="item" name="item" value=""><input type="hidden" id="quan" name="quan" value=""><input type="hidden" id="quanurl" name="quanurl" value="">
			</form>
		</main>
<include file="public:amz_foot" />

<script language="JavaScript">
jQuery(function($){	
	$('.jump').on('click',function(){
		$("#item").val($(this).attr('data-cnzz'));
		$("#quan").val($(this).attr('rel'));
		$("#quanurl").val($(this).attr('quanurl'));
		$("#jump").submit(); 
	})

});
</script>
