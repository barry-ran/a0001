<include file="public:top" />
	<body>
<include file="public:head" />
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
			<include file="nav" />
				<div class="mianbar">
					<div class="subnav mb-10">
						<div class="report-tit">
							<h4>累计获得奖励金额</h4>
							<h2><span>￥</span>{:$total?$total:0.00}</h2>
							<p class="c-999">每月20日结算上月预估奖励，本月预估奖励则在下月20日结算</p>
						</div>
					</div>
					<div class="subnav">
						<table class="table table-border table-bg">
							<thead>
								<tr>
									<th>结算日期</th>
									<th>预估金额</th>
									<th>客户返利金额</th>
									<th>结算金额</th>
									<th>备注</th>
									<th>状态</th>
								</tr>
							</thead>
							<tbody>
								<volist name="list" id="vo">
								<tr>
									<td>{$vo.add_time}</td>
									<td>{$vo.price}</td>
									<td>-{$vo.backcash}</td>
									<td>{$vo.income}</td>
									<td><b class="c-main">{$vo.mark}</b></td>
									<td>
										{$vo.status}
									</td>
								</tr>
								</volist>
							</tbody>
						</table>
						<div class="page cl">
							<div class="f-r pd-10">
						<if condition="$total_item gt $page_size">
						{$page}
						</if>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<include file="public:foot" />	
	</body>
</html>
