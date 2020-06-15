<include file="public:head" />
		<!--header-->
		<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">今日头条</h1>
 			<include file="public:navright" />
		</header>
		<main>
			<!--headlines-->
			<div class="headlines">
				<div class="am-slider am-slider-default"  data-am-widget="slider" data-am-slider="{animationLoop: false,slideshow: false,controlNav: false,directionNav: false,itemWidth: 80,itemMargin: 10}" data-am-sticky>
					<ul class="am-tabs-nav am-nav am-nav-tabs am-slides">
					    <li class="<if condition="$cateid eq ''"> am-active</if>"><a href="{:U('article/index')}{$trackurl}">全部</a></li>
					    <volist name="article_cate" id="cate">
							<li class="<if condition="$cateid eq $cate['id']"> am-active</if>"><a href="{:U('article/index/',array('cateid'=>$cate['id']))}{$trackurl}">{$cate.name}</a></li>
						</volist>
					</ul>
				</div>	
				<div class="am-tab-panel am-fade am-in am-active">
					<ul class="headlines-bd">
						<volist name='list' id="cateid">
							<li>
								<a href="{$cateid.linkurl}{$trackurl}">
									<img src="{$cateid.pic}" width="120" height="120">
									<h3 class="ellipsis-2">{$cateid.title}</h3>
									<p class="ellipsis-2">{$cateid.infocontent}</p>
									<div class="am-cf">
										<span class="mark">{$cateid.catename}</span>
										<p class="time">{$cateid.add_time}</p>
									</div>
								</a>
							</li>
						</volist>
					</ul>
					<div class="page am-margin-bottom-lg">
						<if condition="$total_item gt $size">
						{$page}
						</if>
					</div>
				</div>
			</div>
		</main>
<include file="public:amz_foot" />
</body></html>