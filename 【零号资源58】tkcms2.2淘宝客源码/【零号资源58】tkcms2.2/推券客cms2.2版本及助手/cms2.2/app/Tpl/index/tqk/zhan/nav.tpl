	<div class="leftbar">
		<div class="user">
			<img src="{$user.avatar}" class="round">
			<p>欢迎回来，<b>{$user.nickname}</b> <span class="label label-success radius ml-5">站长</span></p>
		</div>
		<div class="list">
			<ul>
				<li <if condition="stripos($request_url,'ucenter')"> class="cur" </if> ><a href="{:U('zhan/ucenter')}">基本信息</a></li>
				<li <if condition="stripos($request_url,'order')"> class="cur" </if> ><a href="{:U('zhan/order')}">订单列表</a></li>
				<li <if condition="stripos($request_url,'journal')"> class="cur" </if> ><a href="{:U('zhan/journal')}">财务日志</a></li>
				<li <if condition="stripos($request_url,'modify')"> class="cur" </if> ><a href="{:U('zhan/modify')}">个人资料</a></li>
				<li <if condition="stripos($request_url,'logout')"> class="cur" </if> ><a href="{:U('login/logout')}">退出中心</a></li>
			</ul>
		</div>
	</div>