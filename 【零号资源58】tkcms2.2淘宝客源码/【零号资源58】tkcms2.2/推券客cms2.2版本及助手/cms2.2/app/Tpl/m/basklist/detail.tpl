<include file="public:head_nosearch" />
<!--header-->
<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
  	<div class="am-header-left am-header-nav">
	    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
	</div>
	<h1 class="am-header-title">我的晒单</h1>
	<include file="public:navright" />
</header>
<!--shaidan-->
<main>
<script type="text/javascript" src="__STATIC__/tqkwap/js/imgPlugin.js" ></script>
<div class="shai-detail">
	<div class="am-container">
		<div class="shai-detail-info am-cf">
			<div class="wbg am-container">
				<h4 class="ellipsis-2">{$info.goods_title}</h4>
				订单号：{$info.orderid}
				<div class="pri">
					<h5><em>￥</em>{$info.price}</h5>
				</div>
			</div>
		</div>
		<div class="shai-entry">
			<h3>我要晒单<span>（内容越丰富，奖励越丰厚）</span></h3>
			<form action="" method="post" class="am-form" id="entry">
				<input type="hidden" class="input-text" name="orderid" value="{$info.orderid}" placeholder="请填写订单号" />
				<div class="display-title">
				</div>
				<div class="am-form-group">
					<textarea class="" rows="5" name="content" placeholder="至少要上传一张图片才能获得积分奖励哦"></textarea>
				</div>
				<div class="img-box full">		
					<section class="img-section">
						<div class="z_photo upimg-div am-cf" >
							<section class="z_file am-fl">
								<img src="__STATIC__/tqkwap/images/uploadpic.png" class="add-img">
								<input type="file" name="file" id="file" class="file" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" multiple />
							</section>
						</div>
					</section>
				</div>
				<input type="hidden" name="pid" value="{$_GET.id}">
				<aside class="mask works-mask">
					<div class="mask-content">
						<p class="del-p">您确定要删除作品图片吗？</p>
						<p class="check-p"><span class="del-com wsdel-ok">确定</span><span class="wsdel-no">取消</span></p>
					</div>  
				</aside>
				<input type="submit" value="发布晒单" class="am-btn am-btn-block btn-main am-radius"/>
			</form>
		</div>
	</div>
</div>
</main>

<include file="public:foot" />
<script type="text/javascript" src="__STATIC__/tqkwap/js/imgPlugin.js" ></script>
<script type="text/javascript">
	$(function(){
		$("#file").takungaeImgup({
			formData: {
				"name": 'img[]'
			},
			url: "{:U('basklist/uploadPics')}",
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
					required: "",
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
					$('.display-title').html('<div class=""><div class=""><h4>'+res.data+'</h4></div></div>');
				} else {
					layer.msg(res.msg);
					$('#orderid').val('');
				}
			});
		});
	</script>
</body>
</html>