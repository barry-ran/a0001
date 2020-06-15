<include file="public:top" />
	<body>
<include file="public:head" />
<script src="__STATIC__/tqkpc/laydate/laydate.js"></script>
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
			<include file="nav" />
				<div class="mianbar">
					<div class="subnav mb-10">
						<div class="report-det">
							<div class="tabBar clearfix">
								<span <if condition="$s eq 0">class="current"</if> ><a href="{:U('zhan/order')}">所有订单</a></span>
								<span  <if condition="$s eq 1">class="current"</if> ><a href="{:U('zhan/order',array('status'=>'1'))}">已付款</a></span>
								<span  <if condition="$s eq 3">class="current"</if> ><a href="{:U('zhan/order',array('status'=>'3'))}">已结算</a></span>
								<span  <if condition="$s eq 2">class="current"</if> ><a href="{:U('zhan/order',array('status'=>'2'))}">已失效</a></span>
							</div>
							<div>
								<div class="report-time">
									<form action="{:U('zhan/order')}" method="get">
									<label>时间：</label>
									<input type="text" value="{$start_time}" name="start_time" class="input-text" id="start1">-
									<input type="text" value="{$end_time}" name="end_time" class="input-text" id="end1">
									<input class="btn btn-primary size-S radius" type="submit" value="搜索" />
									<input type="hidden" value="{$s}" name="status" />
								</form>
								</div>
								<div class="report-table zhan-detail">
									<table class="table">
										<tr>
											<th>下单时间</th>
											<th>商品</th>
											<th>结算日期</th>
											<th>付款金额</th>
											<th>预估奖励</th>
											<th>用户返现</th>
											<th>实际奖励</th>
											<th>状态</th>
										</tr>
										
<volist name="list" id="vo">
										<tr>
											<td width="15%">{$vo.add_time}</td>
											<td width="20%"><a href="https://item.taobao.com/item.htm?id={$vo.goods_iid}" target="_blank" class="shopmsg text-overflow">{$vo.goods_title}</a><br><span class="shopnum c-999">订单编号：{$vo.orderid}</span></td>
											<td width="15%">{:$vo['up_time']?$vo['up_time']:'--'}</td>
											<td width="10%">{$vo.price}</td>
											<td width="10%">￥{$vo.income}</td>
											<td width="10%">
											<if condition="$vo['cashback']">
												<span class="c-primary">-￥{$vo.cashback}</span><br><span>{$vo.nickname}</span>
											<else/>
											--
											</if>	
											</td>
											<td width="10%"><b class="c-main">￥{$vo.payment}</b></td>
											<td width="10%"><b class="c-primary">已付款</b></td>
										</tr>
		</volist>
									
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
					<div class="subnav pd-20">
						<b>收入与结算说明：</b>
						<p>1.实际奖励 =  预估奖励  -  用户返现</p>
						<p>2.每月20号结算上月奖励，本月获得奖励则在下月20号结算。</p>
					</div>
				</div>
			</div>
		</div>
	<include file="public:foot" />	
	<script type="text/javascript">
		$(function(){
			//$.Huitab(".report-det .tabBar span",".report-det .tabCon","current","click","0")
			var startDate1 = laydate.render({
				elem: '#start1',
				max: 'yyyy-MM-dd',
				done: function(value, date) {
					if(value !== '') {
						endDate1.config.min.year = date.year;
						endDate1.config.min.month = date.month - 1;
						endDate1.config.min.date = date.date;
					} else {
						endDate1.config.min.year = '';
						endDate1.config.min.month = '';
						endDate1.config.min.date = '';
					}
				}
			});
			var endDate1 = laydate.render({
				elem: '#end1',
				max: 'yyyy-MM-dd',
				done: function(value, date) {
					if(value !== '') {
						startDate1.config.max.year = date.year;
						startDate1.config.max.month = date.month - 1;
						startDate1.config.max.date = date.date;
					} else {
						startDate1.config.max.year = '';
						startDate1.config.max.month = '';
						startDate1.config.max.date = '';
					}
				}
			});

		});
	</script>
	</body>
</html>
