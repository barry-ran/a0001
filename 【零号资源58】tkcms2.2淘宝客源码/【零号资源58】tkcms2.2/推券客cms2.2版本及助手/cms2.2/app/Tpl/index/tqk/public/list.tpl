			<div id="content">
				<div class="area" id="contentA"><div class="goods-list2 main-container"><ul class="clearfix">
<form action="{:U('/jump')}{$trackurl}" id="jump" method="post" target="_blank">
<volist name='list' id="vo">
<if condition="$vo['coupon_click_url'] neq '' ">
<li <if condition="$i%4 eq 0">class="no-right"</if>>
									<a href="javascript:;" target="_blank" class="img cnzzCounter jump" rel="{$vo.quan}" data-cnzz="{$vo.num_iid}" quanurl="{$vo.coupon_click_url}" ><img data-original="{$vo.pic_url}" src="{$vo.pic_url}" class="lazy" width="270" height="270" />
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
<else/>

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

</if>
</volist>	

<input type="hidden" id="item" name="item" value=""/>
<input type="hidden" id="quan" name="quan" value=""/>
<input type="hidden" id="quanurl" name="quanurl" value=""/>			
		</form>			
				</ul>
				
				<div style="clear:both;"></div></div><div class="mainbody_6" style="margin: 0 auto;margin-bottom: 0px;margin-top: 26px;"><div id="yw0" class="pager">
					
					<if condition="$total_item gt 60">
						{$page}
						</if>
					
				</div></div>
				</div>
			</div>			

<script language="JavaScript">
$('.jump').on('click',function(){
					$("#item").val($(this).attr('data-cnzz'));
					$("#quan").val($(this).attr('rel'));
					$("#quanurl").val($(this).attr('quanurl'));
					$("#jump").submit(); 
})
</script>	