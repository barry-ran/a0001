<include file="public:head_nosearch" />
	<main>
		<div class="user-bg">
			<div class="nav">
				<a href="javascript:history.go(-1);" class="iconfont icon-left back"></a>
				<h3>我的钱包</h3>
			</div>
			<div class="panel-wrap">
				<div class="panel">
					<div class="item">
						<h4><span>{$user.money}</span>元</h4>
						<p>现金余额</p>
					</div>
					<div class="item">
						<h4><span>{$user.frozen}</span>元</h4>
						<p>冻结资金</p>
					</div>
				</div>
				<a href="{:U('user/tixian')}" class="btn-white">我要提现</a>
			</div>
		</div>
		<!--list-->
		<div class="list">
			<table>
				<thead>
					<tr>
						<th>时间</th>
						<th>项目</th>
						<th>金额</th>
						<th>状态</th>
					</tr>
				</thead>
				<tbody>
					<volist name="info" id="vo">
						<tr>
							<td>{$vo.create_time|frienddate}</td>
							<td>提现</td>
							<td><span class="am-text-primary">-￥{$vo.money}</span></td>
							<if condition="$vo['status'] eq 0">
							<td><span class="am-text-danger">处理中</span></td>
							<else/>
							<td>已处理</td>
							</if>
						</tr>
					</volist>
				</tbody>
			</table>
			<div class="page">
				<if condition="$total_item gt 10">
				{$page}
				</if>
			</div>
		</div>
	</main>
<include file="public:foot" />
</body></html>
