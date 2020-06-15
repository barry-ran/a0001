<include file="public:head_nosearch" />
<main>
	<div class="user-bg">
		<a href="{:U('login/logout')}" class="exit">退出</a>
		<div class="user">
			<a href="{:U('zhan/modify')}"><img src="{$user.avatar}"></a>
			<p>{$user.nickname}<span class="am-badge am-badge-success am-radius">站长</span></p>
		</div>
		<div class="subnav flexbox">
			<div class="subnav-item">
				<a href="javascript:;" id="webpromote" data-am-modal="{target: '#web'}"><p><span>{:C('yh_site_url')}</span><span>网址推广</span></p></a>
			</div>
			<div class="subnav-item">
				<a href="javascript:;" id="codepromote" data-am-modal="{target: '#code'}"><p><i class="iconfont icon-erweima"></i><span>二维码推广</span></p></a>
			</div>
		</div>
	</div>
	<div class="wbg m5">
		<div class="report-money flexbox">
			<div class="oval-item">
				<div class="report-oval oval-1">
					<h4><span>￥</span>{$yesterday}</h4>
					<p>昨日预估收入</p>
				</div>
			</div>
			<div class="oval-item">
				<div class="report-oval oval-3">
					<h4><span>￥</span>{$month}</h4>
					<p>本月预估收入</p>
				</div>
			</div>	
		</div>
		<div class="report-num flexbox">
			<div class="report-num-item">
				<p>昨日订单数量：</p>
				<h4>{$yesterday_count}<span>笔</span></h4>
			</div>
			<div class="report-num-item">
				<p>本月订单数量：</p>
				<h4>{$month_count}<span>笔</span></h4>
			</div>
			<div class="report-num-item">
				<p>上月订单数量：</p>
				<h4>{$pre_count}<span>笔</span></h4>
			</div>
		</div>
	<div class="am-center" style="text-align: center;">	<a href="{:U('zhan/order')}" class="more"><span>更多订单明细...</span></a></div>
	</div>
	<div class="wbg m5">
		<div class="accu-msg">
			<h2>站长累计收入金额</h2>
			<div class="am-text-center">
				<h3><span>￥</span>{:$total?$total:0.00}</h3>
				<p>每月20日结算上月预估收入</p>
				<p>本月预估收入则在下月20日结算</p>
			</div>
		</div>
		<div class="accu-state">
			<ul>
			<if condition='$flist'>
				<li>
					<div class="am-padding-sm am-cf">
						<p>上月收入：￥{$flist.income}</p>
						<span class="state state-warning">{$flist.status}</span>
					</div>
				</li>	
			</if>	
			</ul>
		<div class="am-center" style="text-align: center;">	<a href="{:U('zhan/journal')}" class="more"><span>更多收入明细...</span></a></div>
		</div>
	</div>
	<div class="wbg m5">
		<div class="flow">
			<h2>推广流程</h2>
			<div class="flow-bg">
				<div class="flow-step am-cf">
					<span class="iconfont icon-share-copy"></span>
					<div class="line"></div>
					<div class="txt">
						1.站长发送链接/二维码给用户
					</div>
				</div>
				<div class="flow-step am-cf">
					<span class="iconfont icon-visit"></span>
					<div class="line"></div>
					<div class="txt">
						2.访问者访问您网站
					</div>
				</div>
				<div class="flow-step am-cf">
					<span class="iconfont icon-coupon"></span>
					<div class="line"></div>
					<div class="txt">
						3.访问者领取优惠券并在淘宝天猫上成功下单
					</div>
				</div>
				<div class="flow-step am-cf">
					<span class="iconfont icon-integral"></span>
					<div class="line"></div>
					<div class="txt">
						4.站长结算获得商家奖励
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<div class="am-modal am-modal-no-btn lightbox" tabindex="-1" id="web">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">网址推广
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
      	<input type="text" class="am-form-field am-margin-top am-margin-bottom" value="{:C('yh_site_url')}/?trackid={$r}" id="foo" />
		<button class="am-btn btn-main am-radius copy_key" data-clipboard-action="copy" data-clipboard-target="#foo">一键复制</button>
		<p>分享给好友吧！</p>
    </div>
  </div>
</div>
<div class="am-modal am-modal-no-btn lightbox" tabindex="-1" id="code">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">二维码推广
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
      	<img src="{:U('zhan/qrcode')}" width="120" height="120" >
		<!-- <a href="{:U('zhan/downfile')}" class="am-btn btn-main am-radius">下载二维码</a> -->
		<p>分享给好友吧！</p>
    </div>
  </div>
</div>
</main>
<include file="public:foot" />
<script type="text/javascript">
	var clipboard = new Clipboard('.copy_key');
    clipboard.on('success', function(e) {
        layer.msg('成功复制推广链接！', {time:2000});
    });
</script>
</body></html>
	
