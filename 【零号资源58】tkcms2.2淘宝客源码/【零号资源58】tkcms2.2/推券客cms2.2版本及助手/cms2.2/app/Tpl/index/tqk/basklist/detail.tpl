<include file="public:top"/>
<yh:load type="js" href="__STATIC__/tqkpc/js/jquery.validate.js,__STATIC__/tqkpc/js/validate-methods.js,__STATIC__/tqkpc/js/messages_zh.min.js,__STATIC__/tqkpc/js/jquery.form.min.js,__STATIC__/tqkpc/js/preview.js,__STATIC__/tqkpc/js/imgPlugin.js" />
<body>
	<include file="public:head"/>
	<!--wrap-->
	<div class="wrap">
		<div class="container cl">
			<include file="user:nav"/>
			<div class="mianbar">
				<div class="subnav pd-15">
					<div class="shai-entry pb-30">
						<h3>我要晒单</h3>
						<form action="{:U('basklist/detail')}{$trackurl}" method="post" class="form form-horizontal" id="entry">
								<div class="">
									<h3>{$info.goods_title}</h3>
									<p>订单号：{$info.orderid}</p>
									<h4 class="c-warning">订单付款：{$info.price}元</h4>
								</div>
							<!-- <div class="row cl">
								<div class="formControls col-sm-6 col-xs-6">
									<input type="text" class="input-text" name="orderid" id="orderid" placeholder="请填写订单号" />
								</div>
								<div class="col-sm-2 col-xs-2">
									<p class="c-main mt-5">*必填</p>
								</div>
							</div> -->
							<input type="hidden" class="input-text" name="orderid" value="{$info.orderid}" />
							<div class="display-title">

							</div>
							<div class="row cl">
								<div class="col-sm-12 col-xs-12 text-c">
									<div class="bk-gray cl">
										<textarea class="textarea" placeholder="输入晒单内容文字，且至少要上传一张照片才能获得积分奖励哦" name="content"></textarea>
										<div class="img-box full">
											<section class=" img-section">
												<div class="z_photo upimg-div clear" >
													<section class="z_file fl">
														<img src="__STATIC__/tqkpc/images/uploadpic.png" class="add-img">
														<input type="file" name="file" id="file" class="file" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" multiple />
													</section>
												</div>
											</section>
										</div>
										<aside class="mask works-mask">
											<div class="mask-content">
												<p class="del-p">您确定要删除作品图片吗？</p>
												<p class="check-p"><span class="del-com wsdel-ok">确定</span><span class="wsdel-no">取消</span></p>
											</div>
										</aside>
									</div>
								</div>
							</div>
							<div class="row cl">
								<div class="col-sm-12 col-xs-12 text-c">
									<input type="submit" value="晒单" class="btn btn-secondary radius"/>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			$("#file").takungaeImgup({
				formData: {
					"name": 'img[]'
				},
				url: "{:U('/basklist/uploadPics')}",
				success: function(data) {},
				error: function(err) {
					alert(err);
				}
			});

			$("#entry").validate({
				rules:{
					content:{
						required: true,
					},
				},
				messages:{
					content:{
						required: "输入晒单内容文字",
					},
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
			// $("input[type=submit]").on("click",function(){
			// 	if(!$("section").hasClass("up-section")){
			// 		layer.msg("请至少上传一张图片")
			// 	}
			// })
			
		});
		$("#orderid").blur(function(){
			var orderid = $("#orderid").val();
			var str = orderid.replace(/(^\s*)|(\s*$)/g, '');//去除空格;
			if(str == ''){
				return false;
			}
			$.post("{:U('basklist/getOrderInfo')}",{orderid:orderid},function(res){
				if(res.status == 0){
					$('.display-title').html('<div class="shai-detail"><div class=""><h4>'+res.data+'</h4></div></div>');
				} else {
					layer.msg(res.msg);
					$('#orderid').val('');
				}
			});
		});
	</script>
	<include file="public:foot"/>
</body>
</html>
