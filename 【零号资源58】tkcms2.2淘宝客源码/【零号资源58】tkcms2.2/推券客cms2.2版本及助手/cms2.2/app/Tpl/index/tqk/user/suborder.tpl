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
					<div class="taobaonum cl">
						<div class="tit flexbox">
							<div class="line"></div>
							<p>提交淘宝订单</p>
							<div class="line"></div>
						</div>
						<form method="post" action="{:U('user/suborder')}" id="tijiao">
							<div class="formControls">
								<input type="text" class="input-text" name="orderid" placeholder="请输入您的淘宝订单编号（24小时以内的订单）" />
							</div>
							<input type="submit" id='btn' class="btn btn-main radius" value="确认提交" />
						</form>
					</div>
					<div class="suborder cl">
						<h3>如何查看订单号？</h3>
						<p>步骤：【登录淘宝】<i class="iconfont icon-right"></i>【已购买的商品】<i class="iconfont icon-right"></i>
							【订单编号】<i class="iconfont icon-right"></i>【复制】
						</p>
						<p>详细图文：<a href="{:U('user/vieworder')}">如何在淘宝网站和淘宝APP上查看订单编号？</a></p>
						<h3>积分规则：</h3>
						<p>1.系统自动根据订单商品的品类、金额等属性返还相应积分；</p>
						<p>2.并非订单金额越大返还的积分就越多；</p>
						<p>3.每1个积分可兑换{:(C('yh_fanxian')/100)*1}元现金红包;</p>
					</div>
				</div>
			</div>
		</div>
	<include file="public:foot" />
	<script>
		$(function(){
			$("#tijiao").validate({
				rules:{
					orderid:{
						required:true,
					}
				},
				messages:{
					orderid:{
						required:"请输入淘宝单号"
					}
				},
			submitHandler: function(form) 
			{
				$(form).ajaxSubmit({
					success: function(json) {
						if(json.status == 1){
							layer.msg(json.msg, {icon:6});
			                 setTimeout(function(){
				             window.location.href="{:U('user/order')}";
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
