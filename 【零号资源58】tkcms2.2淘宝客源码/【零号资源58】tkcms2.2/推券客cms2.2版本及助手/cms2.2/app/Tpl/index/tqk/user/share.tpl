<include file="public:top" />
<yh:load type="js" href="__STATIC__/tqkpc/js/jquery.validate.js,__STATIC__/tqkpc/js/validate-methods.js,__STATIC__/tqkpc/js/messages_zh.min.js,__STATIC__/tqkwap/js/jquery.form.min.js,__STATIC__/tqkpc/js/clipboard.min.js"/>
	</head>
	<body>
<include file="public:head" />
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
<include file="nav" />	
				<div class="mianbar">
					<div class="share-wrap">
						<div class="share-tit">
							<h4>分享流程及方式</h4>
						</div>
						<div class="share-flow flexbox">
							<a href="" class="share-flow-step">
								<span class="iconfont icon-share-copy"></span>
								<p>1.站长发送链接/二维码</p>
							</a>
							<div class="share-flow-arr"><i class="iconfont icon-right2"></i></div>
							<a href="" class="share-flow-step">
								<span class="iconfont icon-visit"></span>
								<p>2.访问者访问平台</p>
							</a>
							<div class="share-flow-arr"><i class="iconfont icon-right2"></i></div>
							<a href="" class="share-flow-step">
								<span class="iconfont icon-coupon"></span>
								<p>3.访问者领取优惠券并下单</p>
							</a>
							<div class="share-flow-arr"><i class="iconfont icon-right2"></i></div>
							<a href="" class="share-flow-step">
								<span class="iconfont icon-integral"></span>
								<p>4.站长结算获得积分/佣金</p>
							</a>
						</div>
						<div class="share-way form form-horizontal">
							<div class="row cl">
								<div class="share-way-tit mt-5">
									<span class="btn btn-main radius size-S">方式一</span>
									<label class="form-label">推广链接</label>
								</div>
								<div class="formControls col-xs-7 col-sm-7">
									<input type="text" class="input-text" value="www.xxxxx.xxxxx.xxxx.123" id="foo" />
								</div>
								<div class="col-xs-2 col-sm-2">
									<button class="btn btn-warning size-L radius copy_key" data-clipboard-action="copy" data-clipboard-target="#foo">一键复制</button>
								</div>
							</div>
							<div class="row cl">
								<div class="share-way-tit mt-5">
									<span class="btn btn-main radius size-S">方式二</span>
									<label class="form-label">推广二维码</label>
								</div>
								<div class="formControls col-xs-2 col-sm-2 text-c">
									<img src="{:C('yh_site_flogo')}" width="120" height="120" class="show qr_img">
									<a class="btn btn-warning  radius down_qr">下载二维码</a>
								</div>
							</div>
						</div>
						<div class="share-rules">
							<span class="c-main">分享规则</span>
							<p>
								（1）首邀奖<br />
								若您从未成功邀请过好友注册或者邀请的注册好友均未投资，11月您成功邀请指定个数好友注册且好友满足条件，您即可获得相应奖励（是否可享受以您专属的奖励规则是否显示<首邀奖>内容为准）。
							</p>		
							<p>	
								（2）续邀奖<br />
								11月若您成功邀请2位及以上好友注册，其中至少2位好友月末持有投资产品金额均≥1万元，即可获得相应奖励（是否享受及享受多少奖励以您专属的奖励规则显示<续邀奖>内容为准）。
							</p>		
							<p>
								（3）投资奖<br />
								您本次活动邀请注册的好友，每位好友在注册30天内首笔投资成功（系统显示“持有中”，下同），首笔投资成功后的30天内，按好友的最高持有投资产品金额奖励给您，持有投资产品金额越高奖越多（具体奖励金额参见您专属的奖励规则）。<br />
								若您邀请的11月注册且在注册30天内首笔投资成功的好友人数超过X位，按好友首笔投资成功时间的先后，仅奖励并发放给您前X位，第(X+1)位起的好友的投资奖仍会显示在系统中，这部分奖励将不予发放。（X具体数值参见您专属的奖励规则）
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
<include file="public:foot" />

		<script>
			var clipboard = new Clipboard('.copy_key');
	        clipboard.on('success', function(e) {
	            layer.msg('成功复制推广链接！', {icon: 1,time:2000});
	        });
	        var img_src = $('.qr_img')[0].src; 
	        $('.down_qr').on('click',function(){  
                $('.down_qr').attr('download',img_src);  
                $('.down_qr').attr('href',img_src);  
            });  
		</script>
	</body>
</html>
