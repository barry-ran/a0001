<include file="public:head_nosearch" />
	<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">用户登录</h1>
 		</header>
 	<main>
		<div class="form">
			<h3>用户登录</h3>
			<form action="{:U('login/login')}" method="post" id="login">
				<div class="inputbox">
					<span class="iconfont icon-my4"></span>
					<input type="tel" name="username" id="phone" placeholder="请输入您的手机号" />
				</div>
				<div class="inputbox">
					<span class="iconfont icon-lock"></span>
					<input type="password" name="password" id="password" placeholder="请输入您的密码" />
				</div>
				<div class="inputbox code">
					<span class="iconfont icon-safe"></span>
					<input type="text" name="verify" id="verify" placeholder="请输入验证码" style="width: 49%;" />
					<img src="{:U('login/verify')}" id="verifyImg" width="98" height="43" class="am-fr">
				</div>
				<div class="am-cf">
					<label><input type="checkbox" value="1" checked="" />记住密码</label>
					<p class="am-fr forget"><a href="http://wpa.qq.com/msgrd?v=3&uin={:C('yh_qq')}&site=qq&menu=yes" target="_blank">忘记密码？联系管理员</a></>
				</div>
				<input type="submit" value="登录" class="am-btn btn-main am-btn-block am-radius am-btn-lg"/>
				<input type="hidden" name="callback" value="{$_SERVER['HTTP_REFERER']}"/>
				<div class="flexbox">
					<div class="flex line"></div>
					<div class="flex"><a href="{:U('login/register')}{$trackurl}">新用户注册</a></div>
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
				 document.getElementById('verifyImg').src='{:U("login/verify")}?t='+timenow;
			}
		$("#verifyImg").on('click',function(){
			changeVerify();
		});
		
		$("#login").validate({
				rules:{
					username:{
						required: true,
						isMobile:true,
					},
					password:{
						required: true,
					},
					verify:{
						required: true,
					}
				},
				messages:{
					username:{
						required: "请输入手机号",
						isMobile:"请输入正确格式的手机号",
					},
					password:{
						required: "请输入密码",
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
									location.href = json.data;
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
