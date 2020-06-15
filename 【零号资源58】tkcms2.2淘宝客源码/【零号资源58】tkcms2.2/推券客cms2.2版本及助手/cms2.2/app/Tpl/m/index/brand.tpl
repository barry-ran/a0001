<include file="public:head" />
		<!--header-->
		<header data-am-widget="header" class="am-header am-header-default am-header-fixed main-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">品牌券</h1>
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
					<div class="mod">
						<table>
							<tr>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
							</tr>
							<tr>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
							</tr>
							<tr>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
								<td><a href=""><img src="__STATIC__/tqkwap/images/brand.png" class="am-margin-bottom-xs" width="60%"/><p>阿迪达斯</p></a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</main>
<include file="public:foot" />