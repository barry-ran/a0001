<include file="public:top" />
	<body>
<include file="public:head" />
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
				<div class="etao-88db-guide-newer clearfix">
					<div class="etao-88db-sidebar f-l">
						<div id="magix_vf_sidebar">
							<div class="etao-2927-guide-nav">
								<ul class="etao-2927-side-nav">
						<volist name="helps" id="vo">	
									<li <if condition="$id eq $vo['id']"> class="etao-2927-active"</if>>
										<a href="{:U('help/index',array('id'=>$vo['id']))}">{$vo.title}</a>
									</li>
					</volist>		 	
								</ul>
							</div>
						</div>
					</div>
					<div class="etao-88db-main-wrap f-r">
						<div id="magix_vf_main">
							<div class="etao-c282-guide-main-container">
								<ul id="J_magix_vf_main_guide_data">
									<li class="">
										<div class="etao-c282-question-wrapper">
									<p>
								一、手机淘宝查看订单编号
								</p>
								<p>
								1、打开手机淘宝--&gt;我的淘宝--&gt;我的订单--&gt;查看更多订单
								</p>
								<p>
								选择订单进入订单详情（如下图）并复制订单编号<br/>
								<img alt src="__STATIC__/tqkwap/images/59b6123f8acdd.jpg"/>
								</p>
								<p>
								<img alt src="__STATIC__/tqkwap/images/59b6123f08b45.jpg"/>
								</p>
								<p>
								2、进入用户中心提交复制的订单编号
								</p>
								<p>
								二、电脑淘宝查看订单编号<br/>
								1、登录电脑端淘宝--&gt;我的淘宝下选择已买到的宝贝（如下图）<br/>
								<img alt src="__STATIC__/tqkwap/images/59b61391dbf70.jpg"/>
								</p>
								<p>
								2、订单列表中选择需要提交的商品订单并复制（如下图）
								</p>
								<p>
								<img alt src="__STATIC__/tqkwap/images/59b613917477a.jpg"/>
								</p>
								<p>
								3、进入用户中心提交复制的订单编号
								</p>
										</div>
									</li>
								<li>	
										<div class="etao-c282-question-wrapper">
									<br /><br />
								</div>
								</li>
								</ul>
						
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<include file="public:foot" />
	</body>
</html>