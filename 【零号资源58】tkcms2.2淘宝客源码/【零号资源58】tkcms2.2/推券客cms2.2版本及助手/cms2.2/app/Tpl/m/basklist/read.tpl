<include file="public:head_nosearch" />
<!--header-->
<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
  	<div class="am-header-left am-header-nav">
	    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
	</div>
	<h1 class="am-header-title">晒单详情</h1>
	<include file="public:navright" />
</header>
<main>
	<div class="shai-view">
		<div class="shai-view-tit">
			<h4 class="am-text-secondary"><img src="{$info.avatar}"/>{$info.nickname}</h4>
			<h3 class="ellipsis-2">{$info.title}</h3>
			<div class="pri am-cf"><p>获得{$info.integray}积分</p><span>{$info.create_time|frienddate}</span></div>
		</div>
		<div class="shai-sub-con">
			<p>{$info.content}</p>
			<php>$imgArr = explode(',',$info['images']);</php>
			<volist name="imgArr" id="vo">
				<img src="{$vo}" alt="" style="padding:5px 0;">
			</volist>
		</div>
		<div class="shai-post">
			<if condition="$previous_article neq null">
				<a href="{:U('basklist/read',array('id'=>$previous_article['id']))}{$trackurl}" class="am-cf">
					<span class="am-btn am-btn-default am-btn-xs am-radius am-margin-right-sm">上一篇</span>
					<p class="am-text-sm">{:mb_substr($previous_article['title'],0,15)}...</p>
				</a>
			<else/>
				<span class="am-btn am-btn-default am-btn-xs am-radius am-margin-right-sm">上一篇</span>
				<p class="am-text-sm">到头了</p>
			</if>
			<if condition="$next_article neq null">
			<a href="{:U('basklist/read',array('id'=>$next_article['id']))}{$trackurl}" class="am-cf">
				<span class="am-btn am-btn-default am-btn-xs am-radius am-margin-right-sm">下一篇</span>
				<p class="am-text-sm">{:mb_substr($next_article['title'],0,15)}...</p>
			</a>
			<else/>
				<span class="am-btn am-btn-default am-btn-xs am-radius am-margin-right-sm">下一篇</span>
				<p class="am-text-sm">到底了</p>
			</if>
		</div>
	</div>
</main>
<include file="public:amz_foot" />
</body>
</html>
