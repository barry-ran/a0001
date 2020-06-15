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
										<form method="post" action="{:U('user/jifen')}" id="jifen">
								<div class="col-sm-8">
									
									<div class="row cl">
										<label class="form-label col-xs-4 col-sm-3">当前可用积分</label>
										<div class="formControls col-xs-8 col-sm-9">
										 	{$user.score}
										</div>
									</div>
									
									<div class="row cl">
										<label class="form-label col-xs-4 col-sm-3">积分兑换</label>
										<div class="formControls col-xs-8 col-sm-9">
										 	<input type="text" class="input-text" name="count" id="count" placeholder="请输入您要兑换的数量" />
										 	
										</div>
									</div>
									
									<div class="row cl">
										<label class="form-label col-xs-4 col-sm-3">金额</label>
										<div class="formControls col-xs-8 col-sm-9">
											<input readonly="readonly" type="text" class="input-text" name="money" id="money" value="0" style="width: 85%;margin-right: 2%;" /><span class="c-red">元红包</span>
											<span id="calc" class="hide">{:(C('yh_fanxian')/100)*100}</span>
										</div>
									</div>
									
								</div>
								<div class="col-sm-8">
									<div class="row cl">
										<div class="col-xs-8 col-sm-9 col-offset-3">
											<input type="submit" id='btn' class="btn btn-main radius" value="立即兑换" />
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
			jQuery.validator.addMethod("amount",function(value,element,params){  
		        var amount = /^\+?(?!0+(\d|(\.00?)?$))\d+(\.\d\d?)?$/;  
		        return this.optional(element)||(amount.test(value));  
		    },"请正确输入充值金额！");  
			$("#jifen").validate({
				rules:{
					count:{
						required:true,
						amount:true,
					}
				},
				messages:{
					count:{
						required:"不能为空"
					}
				},
			submitHandler: function(form) 
			{
				$(form).ajaxSubmit({
					success: function(json) {
						if(json.status == 1){
							layer.msg(json.msg, {icon:6});
			                 setTimeout(function(){
				             window.location.href="{:U('user/journal')}";
							},1000);
						}else{
							layer.msg(json.msg, {icon:5,time:1000});
						}
			        }
				});     
			}
			});
			
			$('#count').on('input propertychange', function(){
				if($(this).val() == ''){
					$("#money").val(0);
				}
				calc_money();
			});
			
			function calc_money()
			{
				var count = parseFloat($('#count').val());
				var calc = parseFloat($('#calc').text());
				var money = (calc/100)*count || 0;
				$('#money').val(money.toFixed(2));
			}
		});		
		
	</script>
	</body>
</html>
