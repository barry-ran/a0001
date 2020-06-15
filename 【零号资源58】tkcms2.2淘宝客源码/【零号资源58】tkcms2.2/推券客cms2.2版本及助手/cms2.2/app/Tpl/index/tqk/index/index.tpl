<include file="public:top" />
<body>
<if condition="$topad">
<a href="{$topad.url}" rel="nofollow" target="_blank"><div style="width: 100%; height: 90px; background:url({$topad.img}) no-repeat center;"></div></a>
</if>
<include file="public:head" />
		<!--banner-->
		<div class="banner-wrap">
			<div class="container cl">
				<div class="banner-l">
					<h3>[今日推荐]</h3>
					<div class="recom">
						<div class="pbd">
							<ul>
								<volist name='today_list' id="vo">
									<li>
										<a href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}">
											<img src="{$vo.pic_url}_400x400">
											<p>券后价：<span class="c-main">￥{$vo.coupon_price}</span></p>
											<p class="text-overflow">{$vo.title}</p>
										</a>
									</li>
								</volist>	
							</ul>
						</div>
						<div class="phd"><ul></ul></div>
					</div>
				</div>
				<div class="banner cl">
					<div class="bd">
						<ul>
							<volist name="ad_list" id="ad">   	
								<li _src="{$ad.img}" style="width: 100%;">
									<a href="{$ad.url}{$trackurl}" target="_blank"><img src="{$ad.img}" width="760" height="338"></a>
								</li>
							</volist>
						</ul>
					</div>
					<div class="hd"><ul></ul></div>
				</div>
				<if condition="$visitor">
					<div class="banner-r">
						<div class="login">
							<a href="{:U('user/ucenter')}"><img src="{$visitor.avatar}" class="round"></a>
							<p>欢迎，<a href="{:U('user/ucenter')}" class="c-main">{$visitor.nickname}</a></p>
							<a href="{:U('user/ucenter')}" class="btn btn-pink">个人中心</a>
						</div>
						<div class="jifen flexbox">
						<div class="txt"><span class="title">直播数量</span><span>当前优惠<em>{$total_item}</em>款</span></div></div>
						</div>
					</div>
				<else/>	
					<div class="banner-r">
						<div class="login">
							<img src="__STATIC__/tqkpc/images/default.png" class="round">
							<p>晒单赚积分</p>
							<a href="{:U('login/index')}{$trackurl}" class="btn btn-pink">立即登录</a>
						</div>
						<div class="jifen flexbox">
							<div class="txt"><span class="title">直播数量</span><span>当前优惠<em>{$total_item}</em>款</span></div></div>
						</div>
					</div>
				</if>	
			</div>
		</div>
		<script type="text/javascript">
			jQuery(".banner").slide({
			    titCell: ".hd ul",
			    mainCell: ".bd ul",
			    effect: "fold",
			    autoPlay: true,
			    autoPage: true,
			    trigger: "click",
			    startFun: function(i) {
			        var curLi = jQuery(".banner .bd li").eq(i);
			        if ( !! curLi.attr("_src")) {
			            curLi.css("background", curLi.attr("_src")).removeAttr("_src")
			        }
			    }
			});
			jQuery(".recom").slide({titCell:".phd ul",mainCell:".pbd ul",autoPlay:true,autoPage: true,});
		</script>
		<!--service-->
		<div class="service">
			<div class="container cl">
				<ul class="cl">
					<li>
						<p class="f-l">券</p>
						<div class="f-l">
							<h3 class="c-main">先领券再下单</h3>
							<h4>享现金立减优惠</h4>
						</div>
					</li>
					<li>
						<p class="f-l"><i class="iconfont icon-filter"></i></p>
						<div class="f-l">
							<h3 class="c-main">人工精选</h3>
							<h4>优质、优惠商品</h4>
						</div>
					</li>
					<li>
						<p class="f-l"><i class="iconfont icon-fuwuwuyou"></i></p>
						<div class="f-l">
							<h3 class="c-main">安全无忧</h3>
							<h4>所有交易在淘宝完成安全放心</h4>
						</div>
					</li>
					<li>
						<p class="f-l">24</p>
						<div class="f-l">
							<h3 class="c-main">每日上新</h3>
							<h4>24小时不间断上新</h4>
						</div>
					</li>
					<li>
						<p class="f-l"><i class="iconfont icon-meiyuan"></i></p>
						<div class="f-l">
							<h3 class="c-main">积分兑好礼</h3>
							<h4>晒单就能赚积分</h4>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!--brand-->
		<div class="container cl">
			<div class="brand indexblock">
				<div class="tit"><h4>品牌优惠券</h4><span>好品质和好的生活不期而遇</span></div>
				<div class="hd">
					<ul>
			<volist name="brand" id="bo">
						<li>{$bo.name}</li>
			</volist>
				<li><a href="{:U('brand/index')}">全部</a></li></ul>
				</div>
				<div class="bd">
				<volist name="brand" id="bo">	
					<ul>
						<li>
							<div class="change cl">
								<div class="con">
<ul>
<?php
$brandlist=$bo['brandlist'];	
?>
<volist name="brandlist" offset="0" id="child">	
<li><a target="_blank" href="{:U('cate/index',array('k'=>$child['brand']))}"><img src="{$child.logo}"/></a></li> 
<if condition="$i % 9 eq 0"></li></ul><ul><li></if>										
</volist> 							
								</div>
								<a class="exc"><i class="iconfont icon-qiehuan"></i><span>换一批</span></a>
							</div>
						</li>
					</ul>
				</volist> 
					
				</div>
			</div>
		</div>
		<!--temai-->
		<div class="container cl">
			<div class="indexblock">
				<div class="hottitle">
					<p><i class="iconfont icon-fire"></i>特卖精选</p>
				</div>
				<div class="temai cl">
					<ul>
<volist name='jingxuan' id="vo">
						<li>
							<div class="item">
								<a target="_blank" href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}" class="link">
									<img src="{$vo.pic_url}_400x400.jpg">
									<p class="text-overflow">{$vo.title}</p>
								</a>
								<div class="price">
									<p class="c-main">￥<span>{$vo.coupon_price}</span>(券后价)</p><p><del>￥{$vo.price}</del></p>
								</div>
								<div class="sales cl">
								<if condition="$vo.shop_type eq 'B'"><img src="__STATIC__/tqkpc/images/tmall.png"><else/><img src="__STATIC__/tqkpc/images/taobao.png"></if>
									<p>月销量：<span class="c-primary">{$vo.volume}</span>件</p>
								</div>
								<a target="_blank" href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}" class="coupon">
									<h5>优惠券：<span>{$vo.quan}</span>元</h5>
									<p>立即<br>领券</p>
								</a>
							</div>
						</li>
</volist>
					</ul>
				</div>
			</div>
		</div>
		<!--hot-->
		<div class="container cl">
			<div class="indexblock">
				<div class="hottitle">
					<p><i class="iconfont icon-gift"></i>超级人气榜</p>
				</div>
				<div class="hot cl">
					<ul>
<volist name='top' id="vo">	
						<li>
							<div class="item cl">
								<div class="pic f-l mr-10">
									<a target="_blank" href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}"><img src="{$vo.pic_url}_400x400.jpg"></a>
								</div>
								<div class="txt f-l">
									<div class="tit">
										<if condition="$vo.shop_type eq 'B'"><img src="__STATIC__/tqkpc/images/tmall.png"><else/><img src="__STATIC__/tqkpc/images/taobao.png"></if><a href="{:U('/item/',array('id'=>$vo['id']))}">{$vo.title}</a>
									</div>
									<div class="price cl">
										<p class="f-l c-main">￥<span>{$vo.coupon_price}</span><del>￥{$vo.price}</del></p>
										<p class="f-r">省<span class="c-main">{$vo.quan}</span>元</p>
									</div>
									<a target="_blank" href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}" class="sales">月销量{$vo.volume}件</a>
								</div>
							</div>
						</li>
</volist>
					</ul>
				</div>
			</div>
		</div>
	
	<div class="container cl">
			<div class="new">
				<form action="/jump.html" id="jump" method="post" target="_blank">
					<div class="goods-list2 cl">
						<ul>
							<volist name="products" id="vo">
								<li <if condition="$i%4 eq 0">class="no-right"</if>>
									<a rel="nofollow" href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}" target="_blank" class="img cnzzCounter" data-cnzz-type="1" data-cnzz="557056156750"><img data-original="{$vo.pic_url}" src="{$vo.pic_url}" class="lazy" width="270" height="270" />
										<div class="lq">
											<div class="lq-t">
												<p class="lq-t-d1">领优惠券</p>
												<p class="lq-t-d2">省<span>{$vo.quan}</span>元</p>
											</div>
											<div class="lq-b"></div>
										</div>
										<div class="padding">
											<p class="title cl ellipsis-2 cnzzCounter" data-cnzz-type="1" data-cnzz="557056156750">{$vo.title}</p>
											<div class="coupon-wrap cl">
												<p class="price"><span class="f-28 c-main">{$vo.coupon_price}<i class="quanhou"></i></span><del class="c-999">
													<if condition="$vo.shop_type eq 'B'">天猫<else/>淘宝</if>
													:￥{$vo.price}</del></p>
													<div class="num">
														<p>月销量 <span class="c-main">{$vo.volume}</span></p>
														<span class="lingqu">领取{$vo.quan}元券</span>
													</div>
												</div>
											</div>
										</a>
									</li>
								</volist>

							</ul>
						</div>
						<input type="hidden" id="iid" name="iid" value="" /><input type="hidden" id="quan" name="quan" value="" /><input type="hidden" id="quanurl" name="quanurl" value="" />
					</form>
				</div>
			</div>
	<!--topic-->
		<div class="container cl">
			<div class="indexblock">
				<div class="hottitle">
					<p><i class="iconfont icon-fire"></i>头条资讯</p>
				</div>
				<div class="topic cl">
					<ul>
<volist name='list' id="cateid">
						<li>
							<div class="item cl">
								<div class="pic f-l">
								<a target="_blank" href="{$cateid.linkurl}{$trackurl}" >	<img src="{$cateid.pic}"></a>
								</div>
								<div class="txt f-l">
									<a  target="_blank" href="{$cateid.linkurl}{$trackurl}" class="tit">{$cateid.title}</a>
									<p class="details">
										{$cateid.infocontent}
									</p>
									<p>
										<span class="f-l">{$cateid.add_time}</span>
									</p>
								</div>
							</div>
						</li>
</volist>
					</ul>
				</div>
			</div>
		</div>		

<include file="public:foot" />
		<script type="text/javascript">
			var color=$(".color");
			color.each(function(){
				$(this).slide({titCell:".hd ul",mainCell:".bd ul", autoPlay: true, autoPage: true,});
			})
			jQuery(".brand").slide({trigger:"click"});
			jQuery(".change").each(function(){
				$(this).slide({
					mainCell:".con",prevCell:".exc",trigger:"click"
				});
			}) 
			$(function() {
				$("img.lazy").lazyload({
					threshold: 200,
					effect: "show"
				});
			});
			$('.jump').click(function() {
				$("#iid").val($(this).attr('data-cnzz'));
				$("#quan").val($(this).attr('rel'));
				$("#quanurl").val($(this).attr('quanurl'));
				$("#jump").submit();
			})
		</script>

	</body>
</html>
