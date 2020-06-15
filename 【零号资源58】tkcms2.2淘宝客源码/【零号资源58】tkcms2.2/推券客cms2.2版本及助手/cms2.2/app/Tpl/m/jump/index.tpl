<include file="public:head_nosearch" />
<main>
	<div class="detail">
		<div class="pic">
			<img src="{$item.pict_url}_480x480.jpg" width="100%">
			<if condition="$itemid neq ''">
				<a class="open_fullimg_btn" href="javascript:void(0)" id="example1">
				<div style="background-color:red;opacity:0.8;border-radius:50%;text-align: center;margin-top: 20px;">分享</div>
				</a>
			</if>
			<a href="javascript:history.go(-1);" class="iconfont icon-left back"></a>
		</div>
		<div class="tit">
			<p class="ellipsis-2">
				<if condition="$item['shop_type'] eq 'B'">
					<img width="20" height="auto" src="__STATIC__/tqkwap/images/tmall.png">
				</if>
				<if condition="$item['shop_type'] eq 'C'">
					<img width="20" height="auto" src="__STATIC__/tqkwap/images/taobao.png">
				</if>	
				{$item.title}<em>(月销 {$item.volume} 件)</em>
			</p>
		</div>
		<div class="price flexbox">
			<div class="txt">
				<h4 class="c-main">￥<span>{$item.coupon_price}</span><i class="iquanhou"></i><em>（包邮）</em></h4>
				<p><if condition="$item['shop_type'] eq 1">天猫</if><if condition="$item['shop_type'] eq 0">淘宝</if>在售:￥{$item.zk_final_price}<em>领券立省{$item.quan}元</em></p>
			</div>
			<div class="tag tag-violet mui-pull-right">
						<p>RMB</p>
						<h4>{$item.quan}元</h4>
						<p>领券立省</p>
					</div>
		</div>
		<div style="height:0;overflow:hidden;">
			<div class="detail canvas hidden">
				<div class="pic flexbox">
					<img width="50%" height="150" class="img_pic flex">
					<div class="tit" style="height: 150px;overflow:hidden;">
						<p style="font-size: 14px;">
							<if condition="$item['shop_type'] eq 'B'">
								<img width="20" height="auto" src="__STATIC__/tqkwap/images/tmall.png">
							</if>
							<if condition="$item['shop_type'] eq 'C'">
								<img width="20" height="auto" src="__STATIC__/tqkwap/images/taobao.png">
							</if>	
							{$item.title}<em>(月销 {$item.volume} 件)</em>
						</p>
					</div>
				</div>
				<div class="price flexbox">
					<div class="tit">
						<span class="c-main">券后价:￥<span>{$item.coupon_price}</span>(包邮)</span>
						<p style="font-size: 1.7rem"><if condition="$item['user_type'] eq 'B'">天猫</if><if condition="$item['user_type'] eq 'C'">淘宝</if>在售:￥{$item.zk_final_price}<br><em>领券立省{$item.quan}元</em></p>
					</div>
					<div class="tag" style="background-size:130px 135px;background-image:url(__STATIC__/tqkwap/images/erweima.png);background-repeat:no-repeat;height: 136px;width: 133px;background-position:50% 50%; ">
						<img src="/index.php?g=m&m=detail&a=qrcode&dataurl=
						{:urlencode($mdomain.'/index.php?g=m&m=jump&item='.$itemid.'&quan='.$item['quan'].'&quanid='.$item['quanid'].'&pid='.$item['pid'].'&trackid='.I('trackid'))}" width="110px" height="110px" style="margin-top:3px ">
					</div>
				</div>
			</div>
		</div>
		<div class="report am-cf">
			<ul>
				<li>
					<a href="/index.php?g=m&m=baoming&a=index"><i class="iconfont icon-jia"></i>卖家报名</a>
				</li>
				<li>
					<a href="/index.php?g=m&m=baoming&a=jubao&num_iid={$item.id}"><i class="iconfont icon-jubao"></i>举报此商品</a>
				</li>
			</ul>
		</div>
	</div>
	<input type="hidden" id="Pid" value="{$item.id}" />
	<input type="hidden" id="up_time" value="{$item.up_time}" />  
	<section data-am-widget="accordion" class="am-accordion am-accordion-gapped accordion" data-am-accordion='{}'>
		<dl class="am-accordion-item">
			<dt class="am-accordion-title">
				<a href="javascript:;" id="showdetail" data-itemid="{$item.num_iid}"><h4>商品图文详情 <span class="am-fr am-text-secondary">(点击展开)</span></h4></a>
			</dt>
			<dd class="am-accordion-bd am-collapse">
				<div class="am-accordion-content">
				</div>
			</dd>
		</dl>
	</section>
	<div class="like">
		<div class="am-text-center"><i class="iconfont icon-heart c-main"></i>猜你喜欢</div>
		<ul class="am-cf">
			<volist name="orlike" id="val">
				<li>
					<a rel="nofollow" href="{:U('detail/index',array('id'=>$val['id']))}{$trackurl}">
						<img src="{$val.pic_url}_300x300.jpg" height="auto" width="100%"/>
						<p class="ellipsis">{$val.title}</p>
						<span class="c-main">券后价：￥{$val.coupon_price}</span>
					</a>
				</li>
			</volist>
		</ul>
	</div>
</main>
<footer class="buy-nav flexbox">
	<a href="{:C('yh_headerm_html')}?wx" class="icon"><i class="iconfont icon-home"></i><span>首页</span></a>
	<a href="javascript:;" class="icon" id="kefu" data-am-modal="{target: '#kefuwc'}"><i class="iconfont icon-tel"></i><span>客服</span></a>
   <if condition="$quan"><a class="mui-col-xs-4 browser"  href="<if condition="C('URL_MODEL') eq 2 and C('APP_SUB_DOMAIN_DEPLOY') eq true">{:U('/jump/out/',array('quanurl'=>$quanurl))}<else/>/index.php?g=m&m=jump&a=out&quanurl={$quanurl} </if>"> 领券下单
    </a> 	
   <else/>
   <a class="mui-col-xs-4 browser"  href="<if condition="C('URL_MODEL') eq 2 and C('APP_SUB_DOMAIN_DEPLOY') eq true">{:U('/jump/out/',array('id'=>$item['num_iid'],'pid'=>$item['pid'],'quanid'=>$item['quanid']))}<else/>
/index.php?g=m&m=jump&a=out&id={$item.num_iid}&pid={$item.pid}&quanid={$item.quanid}
   </if>"> 领券下单
    </a> 
   </if>
<a href="javascript:;" id="kouling" class="mui-col-xs-4 taobao" data-am-modal="{target: '#amoybuy'}">用淘口令下单</a>
</footer>
	
	<div class="am-modal am-modal-no-btn lightbox kefuwc" tabindex="-1" id="kefuwc">
		<div class="am-modal-dialog">
			<div class="am-modal-hd">点击二维码放大后长按关注
				<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
			</div>
			<div class="am-modal-bd">
				<img src="{:C('yh_site_background')}" width="100%"><span>客服微信</span>
			</div>
		</div>
	</div>
	<div class="am-modal am-modal-no-btn lightbox amoybuy" tabindex="-1" id="amoybuy">
		<div class="am-modal-dialog">
			<div class="am-modal-hd">淘口令购买
				<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
			</div>
			<div class="am-modal-bd">
				<div class="fq-goods-border">
					<div class="fq-explain">长按框内 &gt; 拷贝</div>
					<div class="copy_key" id="copy_key_ios">复制这条信息{$item.quankouling}打开【手机淘宝】即可领取优惠券购买！</div>
					<button class="copy" >一键复制</button>
				</div>
				<div class="fq-instructions">
					<span>
						<span>温馨提示：</span>
						手机无【手机淘宝】者，可选择浏览器购买方式哦~
					</span>
				</div>
			</div>
		</div>
	</div>
<yh:load type="js" href="__STATIC__/tqkwap/js/jquery.min.js,__STATIC__/tqkwap/js/amazeui.min.js,__STATIC__/tqkwap/js/clipboard.min.js" />
<script type="text/javascript" src="__STATIC__/tqkwap/layer/layer.js" ></script>
<script type="text/javascript" src="https://cdn.bootcss.com/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript">
	
	var clipboard2 = new Clipboard('.copy', {
        text: function() {
            return '复制这条信息{$item.quankouling}打开【手机淘宝】即可领取优惠券购买！';
        }
    });
	$('.copy').on('click', function(e) {
		layer.msg('复制成功',{time:1000});
	});
	
	
	$(document).ready( function(){
		$("#example1").on("click", function(event) { 
			var index = layer.msg('正在为您生成图片,请稍后！',{time:10000}); 
			var pic_url = "{$item.pict_url}";
			$.ajax({
				url: "/index.php?g=m&m=detail&a=pic_conversion",  
				type:'post',
				dataType: "json",
				data: {pic_url:pic_url},
				async: true,  
				success: function(json){
					$(".img_pic").attr("src",json.save_path);
					event.preventDefault();  
					html2canvas($(".hidden"), {  
						allowTaint: true,  
						taintTest: false,  
						onrendered: function(canvas) {
							canvas.id = "mycanvas";  
							var dataUrl = canvas.toDataURL();  
							var html = 
							'<div class="am-modal-dialog" style="width:100%;">'+
							'<div class="am-modal-bd">'+
							'<img src='+dataUrl+' class="am-img-responsive kele-shared-modal" alt="">'+
							'<p><span class="am-text-primary am-text-xs">长按上方图片发给朋友或保存图片</span></p>'+
							'<button type="button" class="am-btn am-btn-danger  am-round btn-kouling am-btn-xs am-margin-xs">复制文案，分享给朋友'+
							'</button>'+
							'<div class="am-text-xs am-margin-xs am-sm-only-text-left" onfocus="iptNum(this, true);">{$item.title}（包邮）<br>【原价】￥{$item.zk_final_price}元 <br>【券后】￥{$item.coupon_price}元<br>复制这条信息，打开「手机淘宝」即可领劵下单！{$item.quankouling}'+
							//'<input type="button" readonly="readonly" id="keleTkl" style="height:1px;margin-left: -999px;" value="{$item.title}（包邮）<br>【原价】￥{$item.zk_final_price}元 <br>【券后】￥{$item.coupon_price}元<br>复制这条信息，打开「手机淘宝」即可领劵下单！{$item.quankouling}">'+
							'</div>'+
							'</div>'+

							'</div>';
                            layer.close(index);
							layer.open({
								type: 1,
								title: false,
								area: '80%',
								offset:'5%', 
								shadeClose:true,
								closeBtn: 0,
								scrollbar: false,
								content: html
							});
							
	var clipboard = new Clipboard(".btn-kouling", {
        text: function() {
            return '{$item.title}（包邮）\n【原价】{$item.zk_final_price}元 \n【券后】{$item.coupon_price}元 \n 复制这条信息，打开「手机淘宝」即可领劵下单！{$item.quankouling}';
        }
    });

                            $(".btn-kouling").on("click",function(){
								layer.msg('复制成功',{time:1000});
								$(".btn-kouling").addClass("am-btn-success");
								$(".btn-kouling").html('复制成功');
							})
							
							$(".kele-shared-modal").attr("src",dataUrl);
							$.ajax({
								url: "/index.php?g=m&m=detail&a=del_img&address="+json.save_path,  
								type:'get',
								dataType: "json",
								data: '',
								async: true,  
							})
						}  
					});

				}
			})
		});   

	}); 

	<if condition = "$item['tk'] eq 1 && $item['que'] eq 0">
		$("#couponkouling").on("click", function() {
			var runcount = 0;
			layer.msg('优惠券生成中，请稍等！', {
				icon: 16,
				shade: 0.01,
				time: 10000
			});
			autoplay = setInterval(function() {
				$.ajax({
					url: "/index.php?g=m&m=min&a=checkque",
					type: 'get',
					dataType: "json",
					timeout: 5000,
					data: {
						id: {$item.num_iid},
						uptime: {: time()}
					},
					async: true,
					success: function(data) {
						if(data.status == 'ok') {
							layer.closeAll('loading');
							clearInterval(autoplay);
							layer.msg('生成成功，现在可以领券下单啦！');
							setTimeout(function() {
								window.location.reload();
							}, 2000);
						}
						if(data.status == 'no') {
							runcount = runcount + 1
							if(runcount > 0) {
								layer.closeAll('loading');
								clearInterval(autoplay);
								layer.msg('生成成功，现在可以领券下单啦！');
								setTimeout(function() {
									window.location.reload();
								}, 2000);
							}
						}

					}
				});
			}, 3000);

		}); 
	</if>

$("#showdetail").on("click",function(){
$(this).unbind('click');
		$.ajax({
			url: "{:U('detail/productinfo',array('numiid'=>$item['num_iid']))}",
			type: 'get',
			dataType: "json",
			timeout: 5000,
			async: true,
			success: function(data) {
				if(data.status == 'ok') {
					$('.am-accordion-content').html(data.content);
				}
			}
		});

	});

</script>
<div class="foot" style="display: none;">
	{:C('yh_statistics_code')}
</div>
</body>
</html>
