<include file="public:head_nosearch" />
<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">财务日志</h1>
 			<include file="public:navright" />
		</header>
	<main>
		<div class="sort">
			<div class="am-g">
				
			</div>
		</div>
		<div class="order-detail">
			
<if condition="$list">			
			<volist name="list" id="vo">
			<div class="order-item">
				<div class="order-tit">
					<p>结算日期：{$vo.add_time}</p>
					<span class="state state-notice">{$vo.status}</span>
				</div>
				<div class="order-con">
					<div class="am-g">
						<div class="am-u-sm-4">
							<span>预估收入</span>
							<p>{$vo.price}</p>
						</div>
						<div class="am-u-sm-4">
							<span>客户返利金额</span>
							<p>-{$vo.backcash}</p>
						</div>
						<div class="am-u-sm-4">
							<span>实际结算金额</span>
							<p class="c-main">{$vo.income}</p>
						</div>
					</div>
				</div>
			</div>
			</volist>
			<else/>
			<div class="no-order">
				<i class="iconfont icon-order"></i>
				<p>暂时还没有收入，多推广才能赚取奖励哟。</p>
			</div>
		</if>
			
			
			<div class="page am-margin-bottom-lg">
				<if condition="$total_item gt 10">
				{$page}
				</if>
			</div>
		</div>
	</main>
<include file="public:foot" />	
</body></html>