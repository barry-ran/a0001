<include file="public:top" />
<script type="text/javascript" src="__STATIC__/tqkpc/js/loimsg.js"></script>
<script type="text/javascript" src="__STATIC__/tqkpc/js/clipboard.min.js" ></script>
<body>
	<include file="public:head" />
	<div class="wrap container cl">
		<!--商品详细-->
		<div class="mains">
			<div class="piece jiu_goods" id="goods_content">
				<div class="piece_box">
					<div class="jiu_bd jiu_top fl">
						<div class="item_containt">
							<div class="jiu_goodsinfo" >
								<div class="goods_con" znid="101z3l">
									<div class="pic">
										<if condition="$item.class eq 'tag_wait' ">
											<a href="javascript:void()">
												<else />
												<a isconvert="1" data-itemid="{$item.num_iid}"  href="{$item.item_url}{$trackurl}"  target="_blank" title="{$item.title}">
												</if>
												<img class="scrollLoading" data-url="{:$item['pic_url']}_400x400" data-original="{:$item['pic_url']}_400x400" src="{:$item['pic_url']}_400x400" width="400px" height="400px">
											</a>
										</div>
										<div class="goods_detail">
											<if condition="$item.class eq 'tag_wait' ">
												<h3><a>{$item.title}</a></h3>
												<else />
												<h3><a>{$item.title}</a></h3>
											</if>
											<div class="desc"></div>

											<div class="item-like">
												<div class="price_tag"><i>￥</i>{$item.coupon_price}<span class="ori_price">￥{$item.price}</span></div>
												<div class="volume_tag fr">已有 <strong>{$item.volume}</strong> 人在抢购该商品</div>
											</div>
											<dl class="item-last-time"> <dt>离优惠券失效还剩：</dt>
												<dd class="timer" id="end_date_0" data-time="{$item.coupon_end_time}"></dd>
											</dl>
											<div class="text-wrap">
												<if condition="$item.isq eq '1'">
													<span class="text-wrap-span">
														已领券<i>{$item.Quan_receive}</i>张，手慢无
													</span>
												</if>
												<span>已有<i>{$item.volume}</i>人购买</span>
											</div>
											<div class="buy-step clearfix">
												<div class="buy-step-text" >购买流程</div>
												<if condition="$item.isq eq '1'">
													<div class="buy-step-first">
														<span>
															<i>领券可省</i>
															<b _hover-ignore="1">{$item.quan}元</b>
														</span>
														<a rel="nofollow" class="coupon-btn" <if condition='$act eq "yes"'> href="{$item.quanurl}" target="_blank" <elseif condition="$item['que'] eq 1 || $item['tk'] eq 0"/>  href="{:U('/out/action/quan/',array('id'=>$item['id']))}" target="_blank"  <else/> id="coupon" href="javascript:;" </if> title="领券后请点击右边按钮下单" _hover-ignore="1">点击领取</a>	
													</div>
													<div class="double-arrow">
														<span style="margin-left: -12px;"></span>
													</div>
												</if>
												<input type="hidden" id="Pid" value="{$item.id}" />
												<input type="hidden" id="up_time" value="{$item.up_time}" />
												<a  class="buy-step-sec buy-btn" rel="nofollow" href="{$item.item_url}" isconvert="1" data-itemid="{$item.num_iid}" target="_blank">去
													<if condition="$item.shop_type eq 'C' ">淘宝
														<else/>天猫</if>下单</a>

														<div id="code" class="code" <if condition="$item['tk'] eq 0 || $item['que'] eq 1 ">style="display: block;"<else/>style="display: none;"</if>>
															<p>手机淘宝扫码领券购买<img src="__STATIC__/tqkpc/images/code.jpg" width="20" height="20"></p>
															<img id="codeimg" src="/index.php?m=item&a=qrcode&dataurl={:urlencode($item['quanurl'])}" width="120" height="120">
														</div>
													</div>

													<div style="width: 100%; clear: both; padding-top: 10px;"></div>
													<div class="shareto" style="clear: both; width: 95%;">
														如果您喜欢此宝贝，记得分享给您的朋友，一起享优惠。 【<label id="copy" data-clipboard-action="copy" data-clipboard-target="#bar" class="blue btn">复制优惠</label>】 【<label id="jubao" rel={$item.num_iid} class="blue">举报违规</label>】
														<div class="sharebaidu">
															<div class="bshare-custom">
																<a title="分享到QQ空间" class="bshare-qzone"></a>
																<a title="分享到新浪微博" class="bshare-sinaminiblog"></a>
																<a title="分享到人人网" class="bshare-renren"></a>
																<a title="分享到腾讯微博" class="bshare-qqmb"></a>
																<a title="分享到网易微博" class="bshare-neteasemb"></a>
																<a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>
															</div>
															<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
															<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
														</div>
														<span class="share_txt">分享到：</span>
													</div>

													<div id="bar" style=" padding-left: 1160px;">
														{$item.title}【包邮】<br/>
														【<if condition="$item.shop_type eq 'C' ">淘宝
														<else/>天猫</if>售价】{$item.price}元<br/> 【券后价】{$item.coupon_price}元 <br/>
														【下单链接】{:C('yh_site_url')}{:U('/item/',array('id'=>$item['id']))}{$trackurl}<br/>
														-----------------
														<br/> 或者复制这条信息，打开【手机淘宝】 {$item.quankouling} 即可领券购买
													</div>

												</div>

												{$item.desc}
											</div>
										</div>

										<div class="jiu_shi jiu_item">
											<h3><img src="__STATIC__/images/jinpintuijian.png" /></h3>
											<div class="goods-list main-container">
												<ul class="clearfix">
													<yh:item type="orlike" cid="$item['cate_id']">
													<volist name="items_list" id="val" key="i" mod="3">
														<li style="margin-right:8px;">
															<a style="display: block;" href="{:U('/item/',array('id'=>$val['id']))}{$trackurl}" class="img cnzzCounter" target="_blank" data-cnzz-type="1" data-cnzz="{$val['id']}">
																<img <if condition="C('yh_site_secret') eq '1'">  class="scrollLoading" data-url="{$val['pic_url']}_400x400" data-original="{$val['pic_url']}_400x400" </if> src="{$val['pic_url']}_400x400" alt="">
																<div class="lq">
																	<div class="lq-t">
																		<p class="lq-t-d1">领优惠券</p>
																		<p class="lq-t-d2">省<span>{:floor($val['quan'])}</span>元</p>
																	</div>
																	<div class="lq-b"></div>
																</div>
															</a>
															<div class="padding">
																<a target="_blank" href="{:U('/item/',array('id'=>$val['id']))}{$trackurl}" class="title clearfix cnzzCounter" data-cnzz-type="1" data-cnzz="{$val['id']}">
																	{$val.title}
																</a>
																<div class="coupon-wrap clearfix" >
																	<p>
																		<span><font style="font-size: 18px;">{$val.coupon_price}</font>元<i class="quanhou"></i></span>
																		<span style="float: right;"><if condition="$val.shop_type eq 'C' ">淘宝</if><if condition="$val.shop_type eq 'B' ">天猫</if><font color="red">{$val.price}</font>元</span>
																	</p>
																	<p>
																		<if condition="$val.shop_type eq 'C' "><i class="taobao"></i></if>
																		<if condition="$val.shop_type eq 'B' "><i class="tmall"></i></if>月销量  <span class="num">{$val.volume}</span>,
																		<span>优惠券<font color="red">{$val.quan}</font>元</span>
																	</p>        
																</div>
															</div>
														</li>

													</volist>
												</yh:item>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				function show_date_time(end,style,id){today=new Date();timeold=((end)*1000-today.getTime());if(timeold<0){return}setTimeout("show_date_time("+end+','+style+','+id+")",100);sectimeold=timeold/1000;secondsold=Math.floor(sectimeold);msPerDay=24*60*60*1000;e_daysold=timeold/msPerDay;daysold=Math.floor(e_daysold);e_hrsold=(e_daysold-daysold)*24;hrsold=Math.floor(e_hrsold);e_minsold=(e_hrsold-hrsold)*60;minsold=Math.floor((e_hrsold-hrsold)*60);e_seconds=(e_minsold-minsold)*60;seconds=Math.floor((e_minsold-minsold)*60);ms=e_seconds-seconds;ms=new String(ms);ms1=ms.substr(2,1);ms2=ms.substr(2,2);hrsold1=daysold*24+hrsold;if(style==1){$("#end_date_"+id).html('<em>'+(hrsold1<10?'0'+hrsold1:hrsold1)+"</em>小时<em>"+(minsold<10?'0'+minsold:minsold)+"</em>分<em>"+(seconds<10?'0'+seconds:seconds)+"</em>秒")}else if(style==2){$("#end_date_"+id).html('<em>'+daysold+"</em>天<em>"+(hrsold<10?'0'+hrsold:hrsold)+"</em>时<em>"+(minsold<10?'0'+minsold:minsold)+"</em>分<em>"+(seconds<10?'0'+seconds:seconds)+"</em>秒")}else if(style==3){$("#end_date_"+id).html("<em>"+(hrsold1<10?'0'+hrsold1:hrsold1)+"</em>小时<em>"+(minsold<10?'0'+minsold:minsold)+"</em>分<em>"+(seconds<10?'0'+seconds:seconds)+"."+ms1+"</em>秒")}else{$("#end_date_"+id).html(daysold+"天"+(hrsold<10?'0'+hrsold:hrsold)+"小 时"+(minsold<10?'0'+minsold:minsold)+"分"+(seconds<10?'0'+seconds:seconds)+"秒."+ms2)}}$(".timer").each(function(){var reg=/^[0-9]+$/;var timer=$(this).attr('data-time');if(reg.test(timer)){show_date_time(timer,3,0)}});var clipboard=new Clipboard('.btn');clipboard.on('success',function(e){console.info('Action:',e.action);console.info('Text:',e.text);console.info('Trigger:',e.trigger);alert("复制成功");e.clearSelection()});clipboard.on('error',function(e){console.error('Action:',e.action);console.error('Trigger:',e.trigger)});
				

				<if condition="$item['tk'] eq 1 && $item['que'] eq 0">
					$("#coupon").click(function(){
						var runcount = 0;
						layer.msg('优惠券生成中，请稍等！', {
							icon: 16
							,shade: 0.01,
							time:10000
						});	
						autoplay = setInterval(function(){
							$.ajax({ 
								url: "/?m=min&a=checkque",  
								type:'get',
								dataType: "json",
								timeout :5000,
								data: { id: {$item.num_iid}, uptime: {:time()} },
								async: true,  
								success: function(data){
									if(data.status=='ok'){
										layer.closeAll('loading');
										clearInterval(autoplay);
										layer.msg('生成成功，现在可以领券下单啦！', {icon: 1,time:2000});
										$(".item_containt").load(location.href+" #goods_content");
									}
									if(data.status=='no'){
										runcount=runcount+1
										if(runcount>0){
											layer.closeAll('loading');
											clearInterval(autoplay);
											layer.msg('生成成功，现在可以领券下单啦！', {icon: 1,time:2000});
											$(".mains").load(location.href+" #goods_content");
										}
									}

								}  
							});	
						},3000);

					});
				</if>

			</script>

			<include file="public:foot" />
		</body>
		</html>