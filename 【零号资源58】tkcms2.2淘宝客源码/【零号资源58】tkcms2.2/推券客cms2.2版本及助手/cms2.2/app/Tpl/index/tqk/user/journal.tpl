<include file="public:top" />
	<body>
<include file="public:head" />
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
			<include file="nav" />
				<div class="mianbar">
					<div class="exchange cl">
						<div class="exchange-l f-l cl">
							<div class="ex-wrap f-l">
								<div class="ex-pic">
									<img src="__STATIC__/tqkpc/images/dollar.png">
								</div>
							</div>
							<div class="ex-wrap f-l">
								<div class="ex-txt">
									<p>账户余额：<span class="c-main">{$user.money}</span>元</p>
									<p>累计提现：<span class="c-main">{$balance}</span>元</p>
								</div>
							</div>
							<div class="ex-wrap f-l">
								<div class="ex-pic">
									<a href="{:U('user/tixian')}" class="btn btn-main radius size-S">我要提现</a>
								</div>
							</div>
						</div>
						<div class="exchange-r f-l">
							<div class="ex-pic">
								<b class="c-main">注：</b>
								<p>1、看直播抢红包可获得现金奖励</p>
								<p>2、100个积分可以兑换{:(C('yh_fanxian')/100)*100}元</p>
							</div>
						</div>
					</div>
					<div class="subnav">
						<table class="table table-border table-bg">
							<thead>
								<tr>
									<th>日期</th>
									<th>项目</th>
									<th>金额</th>
								</tr>
							</thead>
							<tbody>
								<volist name="info" id="vo">
								<tr>
									<td>{$vo.create_time|frienddate}</td>
									<td>{$vo.type}</td>
									<td><b class="c-main">{$vo.money}</b></td>
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
