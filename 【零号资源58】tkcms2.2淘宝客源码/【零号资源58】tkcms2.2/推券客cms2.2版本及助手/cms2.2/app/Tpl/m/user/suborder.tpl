<include file="public:head_nosearch" />
	<main>
		<div class="user-bg">
			<div class="nav">
				<a href="javascript:history.go(-1);" class="iconfont icon-left back"></a>
				<h3>提交订单</h3>
			</div>
			<div class="panel-wrap">
				<div class="panel panel-txt">
					<p>以下情况无法参与下单返积分的活动</p>
					<p>
						1、未使用本站淘口令或者链接购买<br />
						2、打开商品后没有直接下单<br />
						3、下单后请在48小时内提交订单否则无法返积分<br />
					</p>
				</div>
			</div>
		</div>
		<form method="post" action="{:U('user/suborder')}" id="tijiao">
			<div class="am-container">
				<div class="input-box">
					<div class="input-row">
				        <label>淘宝订单</label>
				        <div class="formControls">
				        	<input type="text" class="input-text" name="orderid" placeholder="请输入淘宝订单编号" />
				        </div>
				    </div>	
				</div>
				<button type="submit" class="am-btn btn-main am-btn-block am-radius">确认提交</button>
				<div class="suborder">
					<div class="tit blue-tit flexbox">
						<div class="line flex"></div>
						<p>如何查看订单号</p>
						<div class="line flex"></div>
					</div>
					<p>步骤：【手机淘宝】<i class="iconfont icon-fangxiangjiantou-copy"></i>【我的订单】<i class="iconfont icon-fangxiangjiantou-copy"></i>
						【订单详情】<i class="iconfont icon-fangxiangjiantou-copy"></i>【复制】
					</p>
					<p>详细图文：<a href="{:U('user/vieworder')}">如何在淘宝APP查看订单编号？</a></p>
					<div class="tit red-tit flexbox">
						<div class="line flex"></div>
						<p>积分规则</p>
						<div class="line flex"></div>
					</div>
					<p>1.系统自动根据订单商品的品类、金额等属性返还相应积分；</p>
					<p>2.并非订单金额越大返还的积分就越多；</p>
					<p>3.每1个积分可兑换{:(C('yh_fanxian')/100)*1}元现金红包;</p>
				</div>
			</div>
		</form>	
	</main>
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
</body></html>
