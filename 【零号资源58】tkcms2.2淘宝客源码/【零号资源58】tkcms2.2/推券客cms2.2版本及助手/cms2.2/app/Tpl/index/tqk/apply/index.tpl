<include file="public:top" />
<yh:load type="js" href="__STATIC__/tqkwap/js/jquery.validate.js,__STATIC__/tqkwap/js/validate-methods.js,__STATIC__/tqkwap/js/messages_zh.min.js,__STATIC__/tqkwap/js/jquery.form.min.js,__STATIC__/tqkpc/js/addclear.js"/>
<body>
<include file="public:head" />
		<!--wrap-->
		<div class="container cl">
			<div class="recruit-bg">
				<br />
				<a href="" title="" class="ban"><img src="__STATIC__/tqkpc/images/recruit.jpg" class="img-responsive"/></a>
				<h2>申请代理站长</h2>
				<div class="recruit-wrap flexbox">
					<div class="recruit-item">
						<h3><i class="iconfont icon-v"></i>站长特权</h3>
						<div class="recruit-list">
							<div class="recruit-power flexbox">
								<span class="iconfont icon-erweima"></span>
								<div class="txt">
									<h4>站长专属身份标识</h4>
									<p>每位站长拥有自己独立的身份标识，二维码和网站链接 </p>
								</div>
							</div>
							<div class="recruit-power flexbox">
								<span class="iconfont icon-qiandai"></span>
								<div class="txt">
									<h4>推广赚奖励</h4>
									<p>如果您推广的链接，用户成功领取优惠券下单后，您将可以获得商家奖励</p>
								</div>
							</div>
							<div class="recruit-power flexbox">
								<span class="iconfont icon-idea"></span>
								<div class="txt">
									<h4>坐等收钱 零成本投入</h4>
									<p>无需囤货、无需售后、不需要投入时间管理，所有问题都有淘宝天猫卖家处理</p>
								</div>
							</div>
							<div class="recruit-power flexbox">
								<span class="iconfont icon-huojian"></span>
								<div class="txt">
									<h4>自动结算，极速提现</h4>
									<p>用户下单签收就自动获得商家奖励，收益提现秒审核</p>
								</div>
							</div>
						</div>
					</div>
					<div class="recruit-arr iconfont icon-you"></div>
					<div class="recruit-item">
						<h3><i class="iconfont icon-ziliao"></i>填写申请资料</h3>
						<div class="recruit-form">
							<form action="{:U('apply/index')}" method="post" class="form form-horizontal" id="recruit">
								<div class="cl">
									<div class="col-xs-10 col-sm-10 col-offset-1">
										<p>真实姓名</p>
										<div class="formControls"><input type="text" name="name" class="input-text" placeholder="请输入您的真实姓名与支付宝一致"/></div>
									</div>
								</div>
								<div class="cl">
									<div class="col-xs-10 col-sm-10 col-offset-1">
										<p>支付宝账号</p>
										<div class="formControls"><input type="text" name="alipay" class="input-text" placeholder="请输入您的支付宝账号用于收款，务必填写正确"/></div>
									</div>
								</div>
								<div class="cl">
									<div class="col-xs-10 col-sm-10 col-offset-1">
										<p>QQ号码</p>
										<div class="formControls"><input type="text" name="qq" class="input-text" placeholder="请输入您的QQ号码，方便平台联系您"/></div>
									</div>
								</div>
								
								<div class="cl">
									<div class="col-xs-10 col-sm-10 col-offset-1">
										<p>验证码</p>
										<div class="formControls"><input type="text" class="input-text f-l" name="code" id="code" placeholder="请输入验证码" style="width:150px;" />
										<img src="{:U('login/verify')}" id="verifyImg" height="40" class="f-l" onclick="changeVerify()">
										</div>
									</div>
								</div>
								<div class="text-c">
															
						<if condition='$is_login eq "yes"'>
							<input type="submit" value="提交申请" class="btn btn-main radius size-L"/>
							
						<else/>
						<input type="button" onclick="alert('请登录后再提交');" value="提交申请" class="btn btn-main radius size-L"/>
							
						</if>
								
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<include file="public:foot" />	
	<script type="text/javascript">
		function changeVerify(){
		 var timenow = new Date().getTime();
		 document.getElementById('verifyImg').src='{:U("login/verify")}?'+timenow; 
	}
		$(function(){
			jQuery.validator.addMethod("isQq", function(value, element) {     
				var qq = /^[1-9]\d{4,12}$/;
		         return this.optional(element) || (qq.test(value));       
		    }, "匹配QQ"); 
		    jQuery.validator.addMethod("isAlipay", function(value,element) {   
		        var mobile = /^(((13[0-9]{1})|(15[0-35-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
		        var email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
		        return this.optional(element) || mobile.test(value) || email.test(value);   
		    }, "请正确填写您的支付宝账号"); 
			$("#recruit").validate({
				rules:{
					name:{
						required:true
					},
					alipay:{
						required:true,
						isAlipay:true
					},
					qq:{
						required:true,
						isQq:true,
					},
				code:{
					required: true,
				}
				},
				messages:{
					name:{
						required:"请输入您的真实姓名"
					},
					alipay:{
						required:"请输入您的支付宝账号"
					},
					qq:{
						required:"请输入您的QQ号码",
					},
					code:{
				required: "请输入验证码",
			}
				},
				submitHandler: function(form){
					$(form).ajaxSubmit({
						success: function(json){
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
		});
	</script>
	</body>
</html>
