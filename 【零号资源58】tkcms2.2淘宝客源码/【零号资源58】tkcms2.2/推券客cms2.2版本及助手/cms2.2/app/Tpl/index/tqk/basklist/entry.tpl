<include file="public:top"/>

<body>
	<include file="public:head"/>
	<yh:load type="js" href="__STATIC__/tqkwap/js/jquery.validate.js,__STATIC__/tqkwap/js/validate-methods.js,__STATIC__/tqkwap/js/messages_zh.min.js,__STATIC__/tqkwap/js/jquery.form.min.js,__STATIC__/tqkwap/js/preview.js" />
	<!--wrap-->
	<div class="wrap">
		<div class="container cl">
			<include file="user:nav"/>
			<div class="mianbar">
				<div class="subnav pd-15">
					<div class="shai-detail">
						<img src="http://image.uc.cn/o/wemedia/s/2017/7f5ef74002fbdaf5f1143b6f0216d320x600x600x35.jpeg;,3,jpegx;3,700x.jpg" alt="" />
						<div class="shai-detail-info">
							<h4><img src="__STATIC__/tqkpc/images/taobao.png" class="mr-5" />福特翼虎 嘉年华 福克斯定速巡航 蓝牙开关 保证4S原装 支持验货</h4>
							<div class="pri cl">
								<h5 class="c-main"><em>￥</em>360.00</h5><span class="c-999">500.00</span>
							</div>
							<p class="c-999"> 店铺：广州千彩汽车用品</p>
						</div>
					</div>
					<div class="shai-entry pb-30">
						<h3>我要评论</h3>
						<form action="" method="post" class="form form-horizontal" id="entry">
							<div class="row cl">
								<label class="form-label col-sm-1 col-xs-1">标题</label>
								<div class="formControls col-sm-6 col-xs-6">
									<input type="text" class="input-text" name="title" />
								</div>
								<div class="col-sm-2 col-xs-2">
									<p class="c-main mt-5">*必填</p>
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-sm-1 col-xs-1">内容</label>
								<div class="formControls col-sm-11 col-xs-11">
									<textarea class="textarea" placeholder="内容越丰富，获得的积分越多...." name="content"></textarea>
								</div>
							</div>
							<div class="row cl">
								<div class="col-sm-8 col-xs-8 col-offset-1">
									<span class="btn-upload">
										<a href="javascript:void();"><img src="__STATIC__/tqkpc/images/picfile.png" id="input-image"/></a>
										<input type="file" multiple name="pic" class="input-file">
									</span>
								</div>
							</div>
							<div class="row cl">
								<div class="col-sm-8 col-xs-8 col-offset-1">
									<input type="submit" value="晒单" class="btn btn-secondary radius mr-20"/>
									<label><input type="checkbox">匿名发布</label>
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
			$('input[name=pic]').uploadPreview({ Img: "input-image", Width: 70, Height: 70 });
			$("#entry").validate({
				rules:{
					title:{
						required: true,
					},
				},
				messages:{
					title:{
						required: "请填写标题！",
					},
				},
			})
		});
	</script>
	<include file="public:foot"/>
</body>
</html>
