<include file="public:head_nosearch" />
	<main>
		<div class="user-bg">
			<div class="nav">
				<a href="javascript:history.go(-1);" class="iconfont icon-left back"></a>
				<h3>我要提现</h3>
			</div>
			<div class="panel-wrap">
				<div class="panel">
					<div class="item">
						<h4><span>{$user.money}</span>元</h4>
						<p>账户余额</p>
					</div>
				</div>
			</div>
		</div>
		<form method="post" action="{:U('user/tixian')}" id="mloginbox">
			<div class="am-container">
				<div class="input-box">
					<div class="input-row">
				        <label>提现金额</label>
				        <div class="formControls">
				        	<input type="text" class="input-text" name="money" placeholder="请输入提现金额" />
				        </div>
				    </div>	
				    <div class="input-row">
				        <label>真实姓名</label>
				        <div class="formControls">
				    		<input type="text" class="input-text" name="name" placeholder="请输入真实姓名（很重要）" />
				    	</div>
				    </div>								    
					<div class="input-row">
						<label>提现方式</label>
						<div class="formControls">
							<select class="select" name="method">
								<option value="" selected>请选择提现方式...</option> 
								<option value="1">微信</option>
								<option value="2">支付宝</option>
							</select>
						</div>
					</div>							    
				    <div class="input-row">
				        <label>账号</label>
				        <div class="formControls">
				    		<input type="text" class="input-text" name="allpay" placeholder="请输入支付宝/微信账号">
				    	</div>
					</div>	
					<div class="input-row">
						<label>备注</label>
						<div class="formControls">
							<textarea class="textarea" name="content"></textarea>
				    	</div>
					</div>
				</div>
				<button type="submit" class="am-btn btn-main am-btn-block am-radius">立即申请</button>
			</div>
		</form>	
	</main>
<include file="public:foot" />
<script>	
	$(function() {
		$("#mloginbox").validate({
			rules: {
				money: {
					required: true,
					amount:true
				},
				name: {
					required: true,
				},
				method: {
					required: true,
				},
				allpay: {
					required: true,
				},
			},
			messages: {
				money: {
					required: "请输入提现金额",
				},
				name: {
					required: "请输入真实姓名",
				},
				method: {
					required: "请选择提现方式",
				},
				allpay: {
					required: "请输入支付宝/微信账号",
				},
			},
			submitHandler: function(form) {
				$(form).ajaxSubmit({
					success: function(json) {
						if(json.status == 1) {
							layer.msg(json.msg, {
								icon: 6
							});
							setTimeout(function() {
								window.location.href = "{:U('user/record')}";
							}, 1000);
						} else {
							layer.msg(json.msg, {
								icon: 5,
								time: 1000
							});
						}
					}
				});
			}
		});
	});
</script>
</body></html>
