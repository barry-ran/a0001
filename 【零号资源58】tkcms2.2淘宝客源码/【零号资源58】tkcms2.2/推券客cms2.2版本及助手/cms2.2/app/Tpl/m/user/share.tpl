<include file="public:head_nosearch" />
<!--header-->
<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
  	<div class="am-header-left am-header-nav">
	    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
	</div>
	<h1 class="am-header-title">分享推广</h1>
	<include file="public:navright" />
</header>
<main>
	<!--share-->
	<div class="share-wrap">
		<div class="share-side flexbox">
			<p>获得佣金流程</p>
		</div>
		<div class="share-sec share-flow flexbox">
			<a href="" class="share-flow-step">
				<span class="iconfont icon-share-copy"></span>
				<p>1.站长发送链接/二维码</p>
			</a>
			<a href="" class="share-flow-step">
				<span class="iconfont icon-visit"></span>
				<p>2.访问者访问平台</p>
			</a>
			<a href="" class="share-flow-step">
				<span class="iconfont icon-coupon"></span>
				<p>3.访问者领取优惠券并下单</p>
			</a>
			<a href="" class="share-flow-step">
				<span class="iconfont icon-integral"></span>
				<p>4.站长结算获得积分/佣金</p>
			</a>
		</div>
	</div>
	<div class="share-wrap">
		<div class="share-side flexbox">
			<p>推广方式</p>
		</div>
		<div class="share-sec share-way flexbox">
			<div class="share-way-item">
				<p>推广链接</p>
				<p id="foo">www.123456789.com</p>
				<button class="am-btn btn-main am-radius am-btn-xs copy_key" data-clipboard-action="copy" data-clipboard-target="#foo">一键复制</button>
			</div>
			<div class="share-way-item">
				<img src="{:C('yh_site_flogo')}" width="70" height="70" class="qr_img">
				<p>长按下载二维码</p>
			</div>
		</div>
	</div>
	<div class="share-rules">
		<span>分享规则</span>
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
	<script type="text/javascript">
		var clipboard = new Clipboard('.copy_key');
        clipboard.on('success', function(e) {
            layer.msg('成功复制推广链接！', {time:2000});
        });
	</script>
</main>
	</body>
</html>