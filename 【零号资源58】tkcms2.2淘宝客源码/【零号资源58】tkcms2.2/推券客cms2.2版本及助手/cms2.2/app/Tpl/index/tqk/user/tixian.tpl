<include file="public:top" />
<yh:load type="js" href="__STATIC__/tqkwap/js/jquery.validate.js,__STATIC__/tqkwap/js/validate-methods.js,__STATIC__/tqkwap/js/messages_zh.min.js,__STATIC__/tqkwap/js/jquery.form.min.js,__STATIC__/tqkpc/js/addclear.js"/>
	</head>
	<body>
<include file="public:head" />
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
<include file="nav" />	
				<div class="mianbar">
					<div class="profile">
						<div class="row cl">
							<form method="post" action="{:U('user/tixian')}" id="mloginbox">
								<div class="col-sm-8">
									<div class="row cl">
										<label class="form-label col-xs-4 col-sm-3">提现金额</label>
										<div class="formControls col-xs-8 col-sm-9">
										 	<input type="text" class="input-text" name="money" placeholder="请输入提现金额" />
										</div>
									</div>
									
									<div class="row cl">
										<label class="form-label col-xs-4 col-sm-3">真实姓名</label>
										<div class="formControls col-xs-8 col-sm-9">
										 	<input type="text" class="input-text" name="name" placeholder="请输入真实姓名（很重要）" />
										</div>
									</div>
									<div class="row cl">
										<label class="form-label col-xs-4 col-sm-3">提现方式</label>
										<div class="formControls col-xs-8 col-sm-9">
											<span class="select-box">
												<select name="method" class="select">
													<option value="" selected>请选择提现方式...</option> 
													<option value="1">微信</option>
													<option value="2">支付宝</option>
												</select>
											</span>
										</div>
									</div>
									<div class="row cl">
										<label class="form-label col-xs-4 col-sm-3">账号</label>
										<div class="formControls col-xs-8 col-sm-9">
											<input type="text" class="input-text" name="allpay" datatype="m|e" placeholder="请输入支付宝/微信账号">
										</div>
									</div>
									<div class="row cl">
										<label class="form-label col-xs-4 col-sm-3">备注</label>
										<div class="formControls col-xs-8 col-sm-9">
											<textarea class="textarea" name="content"></textarea>
										</div>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="row cl">
										<div class="col-xs-8 col-sm-9 col-offset-3">
											<input type="submit" id='btn' class="btn btn-main radius" value="确认提现" />
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<include file="public:foot" />
<script>
		$(function(){
			$("#mloginbox").validate({
				rules:{
					name:{
						required:true,
					},
					money:{
						required:true,
					},
					allpay:{
						required:true,
					},
					method:{
						required:true,
					},
				},
			submitHandler: function(form) 
			{
				$(form).ajaxSubmit({
					success: function(json) {
						if(json.status == 1){
							layer.msg(json.msg, {icon:6});
			                 setTimeout(function(){
				             window.location.href="{:U('user/record')}";
							},1000);
						}else{
							layer.msg(json.msg, {icon:5,time:1000});
						}
			        }
				});     
			}
			});
		});		
	
	</script>		
	</body>
</html>
