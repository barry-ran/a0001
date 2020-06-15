		<!--top-->
		<div class="top">
			<div class="container cl">
				<div class="f-l">
					<p class="c-666"> 	{:C('yh_app_key')}</p>
				</div>
				<div class="f-r">
					<if condition="$visitor">
						<p>欢迎，<a href="{:U('user/ucenter')}" class="c-main">{$visitor.nickname}</a>
							<span>&nbsp;&nbsp;</span>
							<a href="{:U('login/logout')}" class="c-main">退出登录</a>
						</p>
						<else/>	
						<p><a href="{:U('login/index')}{$trackurl}" class="c-main">亲，请登录</a><span>或</span><a href="{:U('login/register')}{$trackurl}">免费注册</a></p>
					</if>
					<p><a rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&uin={:C('yh_qq')}&site=qq&menu=yes">在线客服</a></p>
					<p><a href="javascript:;" class="btn_baoming" msg="请不要修改“卖家报名”否则将无法享受推券客免费产品服务">商家报名</a></p>
				</div>
			</div>	
		</div>
		<!--head-->
		<div class="head">
			<div class="container cl">
				<div class="logo">
					<a href="{:C('yh_site_url')}{$trackurl}" ><img width="250" height="70" alt="{:C('yh_site_name')}" src="{:C('yh_site_logo')}"></a>
				</div>
				<div class="search">
					<form id="query_form" method="get" action="{:U("cate/index")}">
						<input type="text" name="k" value="{$k}" class="input-text" placeholder="请输入您要查找的优惠券商品名称" />
						<i class="iconfont icon-sousuo"></i>
						<input type="submit" value="搜索" class="btn btn-main radius" />
					</form>
				</div>
				<div class="barcode cl">
					<div class="f-l mr-5">
						<img src="{:C('yh_site_flogo')}" width="80" height="80">
					</div>
					<div class="f-l text-c">
						<h5 class="c-main">微信扫一扫</h5>
						<p>关注微信公众号<br>看直播抢红包</p>
					</div>
				</div>
			</div>
		</div>
		<!--nav-->
		<div class="navigation">
			<div class="container cl">
				<ul>
					<li <if condition="strlen($request_url) elt 1 || stripos($request_url,'item') || stripos($request_url,'user') || stripos($request_url,'cate') || stripos($request_url,'help') || stripos($request_url,'login')">class="cur"</if>><a href="/">首页</a></li>
					<yh:nav type="lists" style="main">
					<volist name="data" id="val"> 
						<li <if condition="strpos($nav_curr,$val['alias']) gt 0">class="cur"</if> ><a <if condition='$val.target eq 1'> target="_blank" </if> href="{$val.link}{$trackurl}">{$val.name}</a></li>
					</volist>
				</yh:nav> 
			</ul>
		</div>
	</div>
	<!--series-->
	<div class="series">
		<div class="container cl">
			<ul>

				<if condition="$article_cate">
					<li class="<if condition="$cateid eq ''"> cur</if>"><a href="{:U('article/index')}{$trackurl}">全部</a></li>
					<volist name="article_cate" id="cate">
						<li class="<if condition="$cateid eq $cate['id']"> cur</if>"><a href="{:U('article/index/',array('cid'=>$cate['id']))}{$trackurl}">{$cate.name}</a></li>
					</volist>
					<elseif condition="$name"/>
					<li <if condition="$_GET['cid'] eq 0">class="cur"</if>><a href="{:U('goodsjifen/index')}{$trackurl}">全部商品</a></li>
					<else/>
					<li <if condition="$_GET['cid'] eq 0">class="cur"</if>><a href="{:U('cate/index')}{$trackurl}">全部</a></li>
					<volist name="catetree" id="cate"> 
						<li <if condition="$_GET['cid'] eq $cate['id']">class="cur"</if>><a href="{:U('cate/index',array('cid'=>$cate['id']))}{$trackurl}">{$cate[name]}</a></li>
					</volist>
				</if>	


			</ul>
		</div>
	</div>