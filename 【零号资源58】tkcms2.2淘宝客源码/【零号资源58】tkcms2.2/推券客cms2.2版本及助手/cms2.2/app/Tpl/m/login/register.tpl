<include file="public:head_nosearch" />
	<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">用户注册</h1>
 		</header>
 	<main>
		<div class="form">
			<h3>新用户注册</h3>
			<form action="{:U('login/register')}"  method="post" id="register">
				<div class="inputbox">
					<span class="iconfont icon-my4"></span>
					<input type="tel" name="phone" autocomplete="off" id="phone" placeholder="请输入您的手机号" />
				</div>
				<div class="inputbox">
					<span class="iconfont icon-lock"></span>
					<input type="password" autocomplete="off" name="password" id="password" placeholder="请输入您的密码" />
				</div>
				<div class="inputbox">
					<span class="iconfont icon-lock"></span>
					<input type="password" autocomplete="off" name="repassword" id="repassword" placeholder="请重复输入您的密码" />
				</div>
				<div class="inputbox code">
					<span class="iconfont icon-safe"></span>
					<input type="text" name="verify" id="verify" placeholder="请输入验证码" style="width: 49%;" />
					<img src="{:U('login/verify')}" id="verifyImg" height="43" class="am-fr" onclick="changeVerify()">
				</div>
				<input type="submit" value="确认注册" class="am-btn btn-main am-btn-block am-radius am-btn-lg"/>
				<div class="flexbox">
					<div class="flex line"></div>
					<div class="flex"><a href="{:U('login/index')}{$trackurl}">返回登录</a></div>
					<div class="flex line"></div>
				</div>
				<div style="background: #fff;height: 30px;">
					
				</div>
			</form>
		</div>
 	</main>
<include file="public:foot" />
		<script type="text/javascript">
	$(function(){
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
					verify:{
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
					verify:{
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
			changeVerify();
	});
		</script>
	</body>
</html>
