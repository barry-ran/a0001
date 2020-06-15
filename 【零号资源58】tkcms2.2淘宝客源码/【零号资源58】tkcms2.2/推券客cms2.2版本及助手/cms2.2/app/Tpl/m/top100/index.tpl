<include file="public:head" />
	<main>
		<div class="white-bar sort" data-am-sticky>
			<div class="am-g">
				<div class="am-u-sm-4 am-text-center">
					<input type="radio" id="syn" name="syn" class="am-hide" <if condition='$txt_sort eq "new"'> checked="checked"</if>/>
					<label for="syn"><a href="{:U("top100/index",array('sort'=>'new','cid'=>$cid,'k'=>urldecode($k)))}">综合排序</a></label>
				</div>
				<div class="am-u-sm-4 am-text-center">
					<input type="radio" id="hots" name="sort" value="" class="am-hide" <if condition='$txt_sort eq "hot"'> checked="checked"</if> />
					<label id="btn_hot" for="sale"><a href="{:U("top100/index",array('sort'=>'hot','cid'=>$cid,'k'=>urldecode($k)))}">销量排序</a></label>
				</div>
				<div class="am-u-sm-4 am-text-center">
					<input type="radio" id="rates" name="sort" value="" class="am-hide" <if condition='$txt_sort eq "rate"'> checked="checked"</if> />
					<label id="btn_rate" for="money"><a href="{:U("top100/index",array('sort'=>'rate','cid'=>$cid,'k'=>urldecode($k)))}">优惠金额</a></label>
				</div>
			</div>			
		</div>
		<form action="/index.php?g=m&m=jump" id="jump" method="post" class="wbg">
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
									<img width="100%" height="auto" src="{$vo.pic_url}_400x400.jpg">
								</a>
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
									<img width="100%" height="auto" src="{$vo.pic_url}_400x400.jpg">
								</a>
								</a>
							</div>
							<a data-transition="slide" rel="nofollow" href="{$vo.linkurl}{$trackurl}" class="title QtkSelfClick">
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
			<div class="page am-margin-bottom-lg">
						<if condition="$total_item gt 60">
						{$page}
						</if>
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

</body></html>