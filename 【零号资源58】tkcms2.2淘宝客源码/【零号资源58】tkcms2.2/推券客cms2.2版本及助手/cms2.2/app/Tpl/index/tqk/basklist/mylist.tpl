<include file="public:top" />
<body>
	<include file="public:head" />
	<!--wrap-->
	<div class="wrap">
		<div class="container cl">
			<include file="user:nav" />
			<div class="mianbar">
				<div class="shai-menu cl">
					<div class="exchange flexbox">
						<div class="shai-menu-item flexbox">
							<div class="ex-wrap f-l">
								<div class="ex-pic">
									<img src="__STATIC__/tqkpc/images/ico-shai.png">
								</div>
							</div>
							<div class="ex-wrap f-l">
								<div class="ex-txt">
									<p><b>晒单数量：</b><span class="c-main">{$count2}</span>篇</p>
									<p><b>晒单总积分：</b><span class="c-main">{$total_score.0.integrays}分</span></p>
								</div>
							</div>
						</div>
						<div class="shai-menu-item flexbox">
							<div class="ex-wrap f-l">
								<div class="ex-txt">
									<p><b>待审核的晒单</b></p>
									<p><b class="c-primary">{$count1}</b></p>
								</div>
							</div>
						</div>
						<div class="shai-menu-item flexbox">
							<div class="ex-wrap f-l">
								<div class="ex-txt">
									<p><b>未通过的晒单</b></p>
									<p><b class="c-main">{$count3}</b></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="subnav">
					<table class="table table-border table-bg">
						<thead>
							<tr>
								<th>商品</th>
								<th>晒单时间</th>
								<th>获取积分</th>
								<th>状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<volist name="list" id="vo">
								<tr>
									<td width="30%">
										<a href="<if condition="$vo['status'] eq 1">{:U('basklist/read',array('id'=>$vo['id']))}<else/>javascript:;</if>" class="shai-list-shop">
											<img src={$vo.avatar} width="45" height="45" class="f-l mr-10" />
											<h4 class="text-overflow">{$vo.title}</h4>
											<span class="c-main">￥{$vo.price}</span>
										</a>
									</td>
									<td width="20%">{$vo.create_time|frienddate}</td>
									<td width="20%"><span class="c-main">{$vo.integray}</span></td>
									<if condition="$vo['status'] eq 1">
										<td width="20%"><span>晒单完成</span></td>
										<elseif condition="$vo['status'] eq 0"/>
										<td width="20%"><span class="c-primary">待审核</span></td>
										<else/>
										<td width="20%"><span class="c-main">未通过</span></td>
									</if>
									<td width="10%"><a href="<if condition="$vo['status'] eq 1">{:U('basklist/read',array('id'=>$vo['id']))}<else/>javascript:;</if>" class="c-main">详情</a></td>
								</tr>
							</volist>
					
						</tbody>
					</table>
					<div class="page cl">
						<div class="f-r pd-10">
							<if condition="$total_item gt $size">
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
