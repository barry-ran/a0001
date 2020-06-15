<include file="public:head_nosearch" />
		<!--header-->
		<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">今日头条</h1>
			<include file="public:navright" />
 		</header>
		<main>
			<!--read-->
			<div class="article">
				<div class="title">
					<h3 class="ellipsis-2">如何查看商品订单编号</h3>
					<div class="am-cf">
						<a href="{:U('article/index/',array('cateid'=>$info['cate_id']))}{$trackurl}"><span class="mark">{$info.catename}</span></a>
						<p class="time">{:date('Y-m-d',$info['add_time'])}</p>
					</div>
				</div>
				<div class="content">
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
				<!--更多商品-->
				<if condition="$sellers">
					<div class="recommend">
						<h3>【好物推荐】</h3>
						<ul>
							<volist name="sellers" id="val" >
							<li class="item">
								<a href="<if condition="C('APP_SUB_DOMAIN_DEPLOY') eq false">{:U('/m/detail',array('id'=>$val['id']))}{$trackurl}<else/>{:U('/detail',array('id'=>$val['id']))}{$trackurl}</if>">
									<img src="{$val.pic_url}_480x480" width="100%">
									<span>券后价：￥{$val.coupon_price}</span>
								</a>
								<p class="ellipsis-2"><i class="iconfont icon-triangle-arrow-u"></i>{$val.title}</p>
							</li>
							</volist>
						</ul>
					</div>
				</if>
				<if condition="$articlelike">
					<div class="relevant">
						<h3>推荐相关文章</h3>
						<ul>
							<volist name="articlelike" id="art" >	
							    <li>
							    	<a href="<if condition="C('URL_MODEL') eq 2">/article/view_{$art.id}<else/>{:U('/m/article/read',array('id'=>$art['id']))}{$trackurl}</if>">
								    	<img src="{$art.pic}"/>
								    	<div>
							                <h4 class="ellipsis">{$art.title}</h4>
							                <div class="am-cf">
							             		<span>{$art.catename}</span>
							                	<p class="time">{:date('Y-m-d',$art['add_time'])}</p>
							                </div>
							            </div>
							        </a>
							    </li>
							 </volist>
						</ul>
					</div>
				</if>
			</div>
		</main>
<include file="public:foot" />	
</body></html>