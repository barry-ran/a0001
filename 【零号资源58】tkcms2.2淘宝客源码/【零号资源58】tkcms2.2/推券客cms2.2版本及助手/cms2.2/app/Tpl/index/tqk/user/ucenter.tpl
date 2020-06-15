<include file="public:top"/>
	<body>
<include file="public:head"/>
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
<include file="nav"/>
				<div class="mianbar">
					<div class="user-center">
						<ul>
							<li>
								<h3>我的余额</h3>
								<h4><span class="c-main">{$user.money}</span>元</h4>
								<a href="{:U('user/tixian')}" class="btn btn-main radius size-S">我要提现</a>
								<p>看直播抢红包</p>
									<p>积分兑换,都可用获得现金奖励哦</p>
							</li>
							<li>
								<h3>可用积分</h3>
								<h4><span class="c-success">{$user.score}</span>分</h4>
								<a href="{:U('user/jifen')}" class="btn btn-success radius size-S">积分兑换</a>
								<p>100积分={:(C('yh_fanxian')/100)*100}元红包</p>
								<p>积分兑换的红包可提现到微信或支付宝</p>
							</li>
							<li>
								<h3>待返积分</h3>
								<h4><span class="c-primary">{$integral}</span>分</h4>
								<a href="{:U('user/suborder')}" class="btn btn-primary radius size-S">提交订单</a>
								<p>提交订单，可以获得积分奖励</p>
							</li>
						</ul>
					</div>
					<div class="laba cl">
						<p class="c-main">公告通知：<i class="iconfont icon-laba"></i></p>
						<div class="bd">
							<ul>
<volist name="article" id="art">
<li><a target="_blank" href="<if condition="C('URL_MODEL') eq 2">/article/view_{$art.id}<else/>{:U('/article/read',array('id'=>$art['id']))}</if>">{$art.title}</a></li>
</volist>	
							</ul>
						</div>
					</div>
					<div class="subnav">
						<div class="subtop">
							<p class="c-main">最近提交订单</p>
						</div>
						<table class="table table-border table-bg">
							<thead>
								<tr>
									<th>付款时间</th>
									<th>订单编号</th>
									<th>付款金额</th>
									<th>获得积分</th>
									<th>状态</th>
									<th>结算时间</th>
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
							--
								</if></td>
								<td>
									{$vo.status}
								</td>
								<td><if condition="$vo['up_time']">
								{$vo.up_time|frienddate}
								<else/>
								--
								</if></td>
								</tr>
								</volist>
							</tbody>
						</table>
						
						</div>
				</div>
			</div>
		</div>
		<include file="public:foot"/>
		<script>
			jQuery(".laba").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"top",autoPlay:true});
			
		</script>
	</body>
</html>
