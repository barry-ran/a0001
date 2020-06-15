<include file="public:top" />
	<body>
<include file="public:head" />
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
				<div class="headlines-l white-bar">
					<div class="pd-15">
						<img src="__STATIC__/tqkpc/images/jinritoutiao.png" class="mb-20"/>
						<ul>
							
				<volist name='list' id="cateid">
							
							<li>
								<div class="row cl">
									<div class="col-sm-2 col-xs-2">
										<a href="{$cateid.linkurl}{$trackurl}" ><img src="{$cateid.pic}" alt="" width="140" height="140"></a>
									</div>
									<div class="col-sm-10 col-xs-10 pl-30">
										<a href="{$cateid.linkurl}{$trackurl}"  class="tit">{$cateid.title}</a>
										<div class="f-12 cl">
											<span class="f-l c-red mr-5">{$cateid.catename}</span>
											<span class="f-r c-999">{$cateid.add_time}</span>
										</div>
										<p class="c-666">
											{$cateid.infocontent}
										</p>
										<div class="line mt-15"></div>
									</div>
								</div>
							</li>
	</volist>
						</ul>
					</div>
					
					<div class="mainbody_6" style="margin: 0 auto;margin-bottom: 20px;margin-top: 26px;"><div id="yw0" class="pager">
					
					<if condition="$total_item gt $size">
						{$page}
						</if>
					
				</div></div>
					
				</div>
				<div class="headlines-r white-bar">
					<div class="pd-15">
						<img src="__STATIC__/tqkpc/images/youhaohuo.png" class="mb-20"/>
						<ul>
							
	<volist name="sellers" id="vo">
							<li>
								<div class="row cl">
									<div class="col-sm-4 col-xs-4">
										<a href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}" target="_blank"><img src="{$vo.pic_url}_300x300" alt="" width="90" height="90"/></a>
									</div>
									<div class="col-sm-8 col-xs-8">
										<a href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}" target="_blank" class="tit">{$vo.title}</a>
										<p class="c-red f-14">券后价：￥{$vo.coupon_price}</p>
										<p class="f-12 mt-5"><img src="__STATIC__/tqkpc/images/tmall.png" class="va-t mr-5"/>月销<span class="c-primary">{$vo.volume}</span>件</p>
									</div>
								</div>
							</li>
</volist>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	<include file="public:foot" />
	</body>
</html>