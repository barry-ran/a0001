<include file="public:head_nosearch" />
	<main>
		<div class="form fillphone">
			<form action="{:U('user/fillphone')}"  method="post" id="register">
				<div class="inputbox">  
					<span class="iconfont icon-my4"></span>
					<input type="tel" name="phone" autocomplete="off" id="phone" placeholder="请输入您的手机号" />
				</div>
				<input type="submit" value="确认保存" class="am-btn btn-main am-radius am-btn-block"/>
			</form>
		</div>
	</main>
		<script type="text/javascript">
			$("#register").validate({
				rules:{
					phone:{
						required: true,
						isMobile:true,
					},
				},
				messages:{
					phone:{
						required: "请输入手机号",
						isMobile:"请输入正确格式的手机号",
					},
				},
				submitHandler: function(form) 
			    {
					$(form).ajaxSubmit({
						success: function(json) {
							if(json.status == 1){
								layer.msg(json.msg, {icon:6});
								setTimeout(function(){
									//location.href = "{:U('user/ucenter')}";
					            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                                parent.layer.close(index);  
									
								},1000);
							}else{
								layer.msg(json.msg, {icon:5});
							}
			            }
					});     
			    }
			})
		</script>
	</body>
</html>
