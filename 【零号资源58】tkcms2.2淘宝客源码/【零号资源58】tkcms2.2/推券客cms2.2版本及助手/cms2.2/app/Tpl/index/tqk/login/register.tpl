<include file="public:top"/>
<body>
	<!--top-->
	<div class="top">
		<div class="container cl">
			<div class="f-l">
				<p class="c-666"> 	{:C('yh_app_key')}</p>
			</div>
			<div class="f-r">
				<p><a href="{:U('login/index')}" class="c-main">亲，请登录</a><span>或</span><a href="{:U('login/register')}">免费注册</a></p>
				<p><a rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&uin={:C('yh_qq')}&site=qq&menu=yes">在线客服</a></p>
				<p><a href="javascript:;" class="btn_baoming" msg="请不要修改“卖家报名”否则将无法享受推券客免费产品服务">商家报名</a></p>
			</div>
		</div>	
	</div>
	<!--head-->
	<div class="head">
		<div class="container cl">
			<div class="logo">
				<a href="{:C('yh_site_url')}" ><img width="250" height="70" alt="{:C('yh_site_name')}" src="{:C('yh_site_logo')}"></a>
			</div>
			<div class="search">
				<form id="query_form" method="get" action="{:U("cate/index")}">
					<input type="text" name="k" value="{$key}" class="input-text" placeholder="请输入您要查找的优惠券商品名称" />
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
				<li <if condition="strlen($request_url) elt 1 || stripos($request_url,'login') || stripos($request_url,'cate')">class="cur"</if>><a href="/">首页</a></li>
				<yh:nav type="lists" style="main">
				<volist name="data" id="val"> 
					<li <if condition="strpos($nav_curr,$val['alias']) gt 0">class="cur"</if> ><a href="{$val.link}">{$val.name}</a></li>
				</volist>
			</yh:nav> 
		</ul>
	</div>
</div>
<div class="login-wrap">
	<div class="container cl">
		<div class="login-bg">
			<div class="loginbox">
				<div class="tabBar clearfix"><span><a href="{:U('login/index')}">会员登录</a></span><span class="f-r current"><a href="javascript:;">免费注册</a></span></div>
				<div class="tabCon">
					<form action="{:U('login/register')}"  method="post" id="register">
						<div class="input-box cl">
							<i class="iconfont icon-user"></i>
							<input type="tel" name="phone" class="input-text" autocomplete="off" id="phone" placeholder="请输入您的手机号" />
						</div>
						<div class="input-box cl">
							<i class="iconfont icon-lock"></i>
							<input type="password" class="input-text"  autocomplete="off" name="password" id="password" placeholder="请输入您的密码" />
						</div>

						<div class="input-box cl">
							<i class="iconfont icon-lock"></i>
							<input type="password" class="input-text"  autocomplete="off" name="repassword" id="repassword" placeholder="请再次输入您的密码" />
						</div>

						<div class="input-box code cl">
							<i class="iconfont icon-yanzhengma"></i>
							<input type="text" class="input-text" name="code" id="code" placeholder="请输入验证码" style="width:150px;" />
							<img src="{:U('login/verify')}" id="verifyImg" height="40" class="f-r" onclick="changeVerify()">
						</div>

						<div class="input-box cl">
							<input type="submit" class="btn btn-main radius size-L" value="确认注册">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<yh:load type="js" href="__STATIC__/tqkwap/js/jquery.validate.js,__STATIC__/tqkwap/js/validate-methods.js,__STATIC__/tqkwap/js/messages_zh.min.js,__STATIC__/tqkwap/js/jquery.form.min.js"/>
<include file="public:foot" />
<script type="text/javascript">
	function changeVerify(){
		 var timenow = new Date().getTime();
		 document.getElementById('verifyImg').src='{:U("login/verify")}?'+timenow; 
	}
	$("#register").validate({
		rules:{
			phone:{
				required: true,
				isMobile:true,
			},
			password:{
				required: true,
			},
			repassword:{
				required: true,
				equalTo:"#password"
			},
			code:{
				required: true,
			}
		},
		messages:{
			phone:{
				required: "请输入手机号",
				isMobile:"请输入正确格式的手机号",
			},
			password:{
				required: "请输入密码",
			},
			repassword:{
				required: "请重复输入密码",
				equalTo:"两次密码输入不一致"
			},
			code:{
				required: "请输入验证码",
			}
		},
		submitHandler: function(form) 
		{
			$(form).ajaxSubmit({
				success: function(json) {
					if(json.status == 1){
						layer.msg(json.msg, {icon:6});
						setTimeout(function(){
							location.href = "{:U('user/ucenter')}";
						},1000);
					}else{
						layer.msg(json.msg, {icon:5});
					}
				}
			});     
		}
	})
</script>
</body>
</html>
