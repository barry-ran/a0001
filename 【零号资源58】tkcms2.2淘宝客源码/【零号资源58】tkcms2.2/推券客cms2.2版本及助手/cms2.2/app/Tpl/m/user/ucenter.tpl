<include file="public:head_nosearch" />
<main>		
	<div class="user-bg">
		<div class="user">
			<a href="{:U('user/modify')}"><img src="{$user.avatar}"></a>
			<p>{$user.nickname}</p>
		</div>
		<div class="subnav flexbox">
			<div class="subnav-item"><p>{$user.money}</p><span>账户余额</span></div>
			<div class="subnav-item"><p>{$user.score}</p><span>可用积分</span></div>
			<div class="subnav-item"><p>{$integral}</p><span>待返积分</span></div>
		</div>
	</div>
	<div class="laba">
		<i class="iconfont icon-laba"></i>
		<div class="am-slider am-slider-default notice" data-am-flexslider="{direction: 'vertical',directionNav: false,controlNav: false, slideshowSpeed: 1000}">
			<ul class="am-slides">
				<volist name="article" id="art">
					<li><a href="<if condition="C('URL_MODEL') eq 2 and C('APP_SUB_DOMAIN_DEPLOY') eq true">/article/view_{$art.id}<else/>{:U('/m/article/read',array('id'=>$art['id']))}</if>">{$art.title}</a></li>
				</volist>	
			</ul>
		</div>
	</div>
	<div class="mod">
		<table>
			<tr>
				<td>
					<a href="{:U('user/record')}"><i class="iconfont icon-qiandai" style="color: #72aefd;"></i><br>我的钱包</a>
				</td>
				<td>
					<a href="{:U('user/modify')}"><i class="iconfont icon-ziliao" style="color: #a283f6;"></i><br>修改资料</a>
				</td>
				<td>
					<a href="{:U('user/journal')}"><i class="iconfont icon-order" style="color: #fec832;"></i><br>财务日志</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="{:U('user/order')}"><i class="iconfont icon-wodedingdan" style="color: #ff8746;"></i><br>我的订单</a>
				</td>
				<td>
					<a href="{:U('user/suborder')}" id="tijiao"><i class="iconfont icon-tijiaodingdan" style="color: #38be9a;"></i><br>提交订单</a>
				</td>
				<td>
					<a href="{:U('basklist/mylist')}"><i class="iconfont icon-shaidan" style="color: #f75c5c;"></i><br>我的晒单</a>
				</td>

			</tr>
			<tr>
				<td>
						<a href="{:U('apply/index')}"><i class="iconfont icon-daili" style="color: #72aefd;"></i><br>申请代理</a>
					</td>
				<td>
					<a href="{:U('login/logout')}"><i class="iconfont icon-exit" style="color: #f75c5c;"></i><br>退出登录</a>
				</td>
			</tr>

		</table>
	</div>
</main>
<include file="public:foot" />
</body></html>

