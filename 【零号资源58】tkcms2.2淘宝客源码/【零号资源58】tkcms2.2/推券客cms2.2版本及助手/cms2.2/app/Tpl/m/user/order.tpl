<include file="public:head_nosearch" />
	<main>
		<div class="user-bg">
			<div class="nav">
				<a href="javascript:history.go(-1);" class="iconfont icon-left back"></a>
				<h3>我的订单</h3>
			</div>
			<div class="panel-wrap">
				<div class="panel">
					<div class="item">
						<h4><span>{$user.score}</span></h4>
						<p>可用积分</p>
					</div>
					<div class="item">
						<h4><span>{$integral}</span></h4>
						<p>待返积分</p>
					</div>
				</div>
				<a href="{:U('user/jifen')}" class="btn-white">我要兑换</a>
			</div>
		</div>
		<!--list-->
		<div class="wallet">
			<ul>
				<volist name="list" id="vo">
					<li>
						<div class="am-cf">
							<if condition="$vo['price']">
								<p class="am-fl"><em>付款金额</em><span class="c-main">￥{$vo.price}</span></p>
							</if>
							<p class="am-fr"><em>状态</em><span class="c-primary">{$vo.status}</span></p>
						</div>
						<div class="am-cf">
							<p class="am-fl"><em>提交时间</em>{$vo.add_time|frienddate}</p>
							<a href="{:U('basklist/detail',array('id'=>$vo['id']))}" class="am-badge am-badge-warning am-fr">我要晒单</a>
						</div>
						<p><em>订单编号</em>{$vo.orderid}</p>
						<if condition="$vo['integral']">
							<p><em>获得积分</em>{$vo.integral}</p>
						</if>
						<if condition="$vo['up_time']">
							<p><em>更新时间</em>{$vo.up_time|frienddate}</p>
						</if>
					</li>
				</volist>	
			</ul>
			<div class="page">
				<if condition="$total_item gt 10">
					{$page}
				</if>
			</div>
		</div>
	</main>
<include file="public:foot" />
</body></html>
