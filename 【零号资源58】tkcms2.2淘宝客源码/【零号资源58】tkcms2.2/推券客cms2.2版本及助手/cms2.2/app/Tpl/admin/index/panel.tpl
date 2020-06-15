<include file="public:header" />
<script src="__STATIC__/js/jquery/jquery.js"></script>
<script src="__STATIC__/js/yhxia.js"></script>
<script src="__STATIC__/js/admin.js"></script>
<div class="pad_10">
	<div class="clearfix">

		<div class="col-2 fl mr10" style="width:48%">
			<h6>个人信息</h6>
			<div class="content" style="height:80px;">
				您好，<b style="color:#06C"> {$my_admin.username}</b> &nbsp;[超级管理员]<br />
				登录IP： {$ip} [ {$time}]<br />
				<div class="bk20 hr"><hr /></div>
				<if condition="$count">
				余额提现：<a href="?g=admin&m=balance&a=index&menuid=364"><span><font color="green">{$count}</font></span></a><br />
				<else/>
				余额提现：<span><font color="green">0</font></span><br />
				</if>
			</div>
		</div>
		<div class="col-2 col-auto">
				<h6>授权信息</h6>
			<div class="content" style="height:80px;">
				授权类型：<span><font color="green">免费</font></span><br />
				授权域名：<span><font color="green">{:C('yh_site_url')}</font></span><br />
				<div class="bk20 hr"><hr /></div>
			交流群<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=b270129c484606942f69304bf655dedfe9eb022b23e5daf9d5ec04306ab17bdb"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="推券客联盟技术支持群" title="推券客联盟技术支持群"></a></div>
			
			
		</div>

		<div class="bk10"></div>

		<div class="col-2 fl mr10" style="width:48%">
			<h6>系统信息</h6>
			<div class="content" style="height:113px;">
				{:L('yhxia_version')}：<font style="color:#090">{$system_info.yhxia_version}</font><!--<span style="color: #260BEE;font-weight: bold;" id="new_version">6.0</span><span id="version_update">[在线升级]</span>--><br />
				{:L('server_os')}：{$system_info.server_os}<br />
				{:L('web_server')}：{$system_info.web_server}<br />
				{:L('php_version')}：{$system_info.php_version}<br />
				支持函数：<span class="{$system_info.curl}">远程读取</span>
				<span class="onCorrect">编码转换</span>
				<span class="{$system_info.zlib}">页面压缩</span>
				<br />
			</div>
		</div>
		<div class="col-2 col-auto">
<h6>特别声明</h6>
			<div class="content" style="height:113px;">
			1.为了保证有足够的商家报名参加活动，任何个人或组织在使用推券客CMS以及高佣金申请工具时，都必须保留前台“卖家报名”入口，否则您将无权使用。<br />
			2.用户出于自愿而使用本软件，您必须了解使用本软件的风险，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。
				
				
			</div>
		</div>