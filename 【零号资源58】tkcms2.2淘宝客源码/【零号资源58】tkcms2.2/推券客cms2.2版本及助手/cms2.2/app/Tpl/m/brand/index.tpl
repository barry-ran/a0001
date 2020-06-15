<include file="public:head_nosearch" />
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
					    <li class="<if condition="$cateid eq ''"> am-active</if>"><a href="{:U('brand/index')}{$trackurl}">全部</a></li>
					    <volist name="brand_cate" id="cate">
							<li class="<if condition="$cateid eq $cate['id']"> am-active</if>"><a href="{:U('brand/index/',array('cateid'=>$cate['id']))}{$trackurl}">{$cate.name}
								</a>
							</li>
						</volist>
					</ul>
				</div>	
				<div class="am-tab-panel am-fade am-in am-active">
					<div class="mod">
						<table>
							<tr>
			<volist name="list" id="vo" key="i" mod="3">
				<td><a href="{:U('cate/index',array('k'=>$vo['brand']))}"><img src="{$vo.logo}" class="am-margin-bottom-xs" width="60%"/><p>{$vo.brand}</p></a></td>
				<eq name="mod" value="2"></tr><tr></eq>
			</volist>
							</tr>
						</table>
						
					 <div class="page am-margin-bottom-lg">
						<if condition="$total_item gt 30">
						{$page}
						</if>
					</div>
					
					</div>
				</div>
			</div>
		</main>
<include file="public:amz_foot" />
</body>
</html>