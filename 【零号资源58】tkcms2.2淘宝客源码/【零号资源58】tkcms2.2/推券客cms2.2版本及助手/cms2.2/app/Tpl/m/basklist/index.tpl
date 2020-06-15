<include file="public:head_nosearch" />
<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
  	<div class="am-header-left am-header-nav">
	    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
	</div>
	<h1 class="am-header-title">晒单赚积分</h1>
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
							<h4 class="am-text-warning am-fr">获得{$vo.integray}积分</h4>
						</div>
						<div class="shai-sub">
							<a href="{:U('basklist/read',array('id'=>$vo['id']))}{$trackurl}">
								<h3 class="ellipsis-2">{$vo.title}</h3>
								<p class="ellipsis-2">{$vo.content}</p>
							</a>
							<div class="am-g am-margin-top-xs">
								<php>$imgArr = explode(',',$vo['images']);</php>
								<volist name="imgArr" id="vo">
									<div class="am-u-sm-4 am-padding-left-0 am-u-end am-margin-bottom">
										<img src="{$vo}" class="am-img-responsive"/>
									</div>
								</volist>
							</div>
							<span class="shai-time">{$vo.create_time|frienddate}</span>
						</div>
					</div>
				</div>
			</li>
		</volist>
		<else/>
		<div class="no-order">
			<i class="iconfont icon-order"></i>
			<p>暂时还没有人晒单</p>
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
