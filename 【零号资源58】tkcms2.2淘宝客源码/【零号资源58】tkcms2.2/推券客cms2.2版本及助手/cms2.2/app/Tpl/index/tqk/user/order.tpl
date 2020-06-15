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
								<img src="__STATIC__/tqkpc/images/order.png">
							</div>
						</div>
						<div class="ex-wrap f-l">
							<div class="ex-txt">
								<p>可用积分：<span class="c-main">{$user.score}</span>分</p>
								<p>待返积分：<span class="c-main">{$integral}</span>分</p>
							</div>
						</div>
						<div class="ex-wrap f-l">
							<div class="ex-pic">
								<a href="{:U('user/suborder')}" class="btn btn-main radius size-S">提交订单</a>
							</div>
						</div>
					</div>
					<div class="exchange-r f-l">
						<div class="ex-pic">
							<b class="c-main">注：以下情况无法获得积分</b>
							<p>1、未使用本站淘口令或链接购买</p>
							<p>2、打开商品后没有直接下单</p>
							<p>3、下单后请在48小时内提交订单<br/>否则无法返积分</p>
						</div>
					</div>
				</div>
				<div class="subnav">
					<table class="table table-border table-bg">
						<thead>
							<tr>
								<th>付款时间</th>
								<th>订单编号</th>
								<th>付款金额</th>
								<th>获得积分</th>
								<th>状态</th>
								<th>结算时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<volist name="list" id="vo">
								<tr>
									<td>{$vo.add_time|frienddate}</td>
									<td>{$vo.orderid}</td> 
									<td><b class="c-main">
										<if condition="$vo['price']">
											{$vo.price}
											<else/>
											--
										</if>
									</b></td>
									<td><if condition="$vo['integral']">
										{$vo.integral}
										<else/>
										----
									</if></td>
									<td>
										{$vo.status}
									</td>
									<td><if condition="$vo['up_time']">
										{$vo.up_time|frienddate}
										<else/>
										--
									</if></td>
									<td>
											<a href="{:U('basklist/detail',array('id'=>$vo['id']))}" title="" class="btn btn-main-outline size-S radius">晒单</a>
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
