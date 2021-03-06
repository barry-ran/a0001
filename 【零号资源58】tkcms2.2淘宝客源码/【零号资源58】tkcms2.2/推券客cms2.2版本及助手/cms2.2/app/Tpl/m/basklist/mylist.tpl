<include file="public:head_nosearch" />
<!--header-->
<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
  	<div class="am-header-left am-header-nav">
	    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
	</div>
	<h1 class="am-header-title">我的晒单</h1>
	<include file="public:navright" />
</header>
<!--shaidan-->
<main>
<div class="shaidan">
	<ul>
		
			<if condition="$list">
				
		<volist name="list" id="vo">
			<li>
				<div class="shai-item">
					<div class="shai-avatar">
						<img src="{$vo.avatar}"/>
					</div>
					<div class="shai-main">
						<div class="shai-tit">
							<h3 class="am-text-secondary">{$vo.nickname}</h3>
							<h4 class="am-text-warning am-fr">获得积分：{$vo.integray}</h4>
						</div>
						<div class="shai-sub">
							<a href="{:U('basklist/read',array('id'=>$vo['id']))}{$trackurl}">
								<h3 class="ellipsis-2">{$vo.title}</h3>
							</a>

							<span class="">晒单时间：{$vo.create_time|frienddate}</span><br>
							<span class="">状态：
								<if condition="$vo['status'] eq 1">
									<span>晒单完成</span>
									<elseif condition="$vo['status'] eq 0"/>
									<span class="am-text-secondary">待审核</span>
									<else/>
									<span class="c-main">未通过</span>
								</if>
							</span>
						</div>
					</div>
				</div>
			</li>
		</volist>
			<else/>
			<div class="no-order">
			<i class="iconfont icon-order"></i>
			<p>您还没有晒单</p>
		</div>
		</if>
		
		
	</ul>
	<div class="page">
		<if condition="$total_item gt 6">
		{$page}
		</if>
	</div>
</div>
</main>
<include file="public:amz_foot" />
</body>
</html>
