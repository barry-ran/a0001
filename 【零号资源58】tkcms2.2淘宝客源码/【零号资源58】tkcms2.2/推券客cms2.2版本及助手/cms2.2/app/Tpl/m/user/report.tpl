<include file="public:head_nosearch" />
<main>	
		<div class="user-bg">
			<div class="user">
				<div class="laba">
					<i class="iconfont icon-laba"></i>
					<div class="am-slider am-slider-default notice" data-am-flexslider="{direction: 'vertical',directionNav: false,controlNav: false, slideshowSpeed: 1000}">
						<ul class="am-slides">
							<volist name="article" id="art">
							<li><a href="<if condition="C('URL_MODEL') eq 2">/article/view_{$art.id}<else/>{:U('/m/article/read',array('id'=>$art['id']))}</if>">{$art.title}</a></li>
							</volist>	
						</ul>
					</div>
				</div>
				<div class="user">
					<a href="{:U('user/modify')}"><img src="{$user.avatar}"></a>
					<p>{$user.nickname}<span class="am-badge am-badge-success am-radius">站长</span </p>
				</div>
			</div>
			<div class="subnav flexbox">
				<div class="subnav-item"><p>{$user.money}<br><span>我的余额</span></p></div>
				<div class="subnav-item"><p>{$user.score}<br><span>可用积分</span></p></div>
				<div class="subnav-item"><a href=""><p><i class="iconfont icon-erweima"></i> <br><span>推广链接</span></p></a></div>
			</div>
		</div>
		<div class="wbg m5">
			<div class="report-money flexbox">
				<div class="oval-item">
					<div class="report-oval oval-1">
						<h4><span>￥</span>200.00</h4>
						<p>昨日预估收益</p>
					</div>
				</div>
				<div class="oval-item">
					<div class="report-oval oval-3">
						<h4><span>￥</span>20000.00</h4>
						<p>上月结算收益</p>
					</div>
				</div>	
			</div>
			<div class="report-num flexbox">
				<div class="report-num-item">
					<p>昨日订单数量：</p>
					<h4>10<span>笔</span></h4>
				</div>
				<div class="report-num-item">
					<p>本月订单数量：</p>
					<h4>100<span>笔</span></h4>
				</div>
				<div class="report-num-item">
					<p>上月订单数量：</p>
					<h4>2000<span>笔</span></h4>
				</div>
			</div>
		</div>
		<div class="mod user-bot">
			<table>
				<tr>
					<td>
						<a href="{:U('user/record')}"><i class="iconfont icon-admin" style="color: #fb3434;"></i><br>申请站长<br />站长推广</a>
					</td>
					<td>
						<a href="{:U('user/modify')}"><i class="iconfont icon-qianbao" style="color: #fa34fa;"></i><br>我的钱包</a>
					</td>
					<td>
						<a href="{:U('user/journal')}"><i class="iconfont icon-tijiaodingdan" style="color: #34b8fa;"></i><br>提交订单</a>
					</td>
				</tr>
				<tr>
					<td>
						<a href="{:U('user/order')}"><i class="iconfont icon-meiyuan" style="color: #5534fa;"></i><br>财务日志</a>
					</td>
					<td>
						<a href="{:U('user/suborder')}" id="tijiao"><i class="iconfont icon-order" style="color: #f19149;"></i><br>我的订单</a>
					</td>
					<td>
						<a href="{:U('login/logout')}"><i class="iconfont icon-set" style="color: #9734fa;"></i><br>个人设置</a>
					</td>
				</tr>
			</table>
		</div>
</main>	
<include file="public:foot" />
</body></html>
