	<div class="leftbar">
					<div class="user">
						<img src="{$user.avatar}" class="round">
						<p>欢迎回来，<b>{$user.nickname}</b></p>
						<p><b>我的余额 <span class="c-main">{$user.money}元</span></b></p>
					</div>
					<div class="list">
						<ul>
							<li <if condition="stripos($request_url,'ucenter')"> class="cur" </if> ><a href="{:U('user/ucenter')}">基本信息</a></li>
							<li <if condition="stripos($request_url,'modify')"> class="cur" </if> ><a href="{:U('user/modify')}">我的资料</a></li>
							<li <if condition="stripos($request_url,'record')"> class="cur" </if> ><a href="{:U('user/record')}">我的钱包</a></li>
							<li <if condition="stripos($request_url,'journal')"> class="cur" </if> ><a href="{:U('user/journal')}">财务日志</a></li>
							<li <if condition="stripos($request_url,'mylist')"> class="cur" </if> ><a href="{:U('basklist/mylist')}">我的晒单</a></li>
							
							<li <if condition="stripos($request_url,'order')"> class="cur" </if> ><a href="{:U('user/order')}">我的订单</a></li>


							<li <if condition="stripos($request_url,'logout')"> class="cur" </if> ><a href="{:U('login/logout')}">退出中心</a></li>
						</ul>
					</div>
				</div>