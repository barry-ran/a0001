		<include file="public:foot_nav" />
		<div data-am-widget="gotop" class="am-gotop am-gotop-fixed backTop" >
		    <a href="#top" title=""><i class="iconfont icon-top"></i></a>
		</div>
<yh:load type="js" href="__STATIC__/tqkwap/js/jquery.min.js,__STATIC__/tqkwap/js/jquery.form.min.js,__STATIC__/tqkwap/js/amazeui.min.js,__STATIC__/tqkwap/js/clipboard.min.js,__STATIC__/tqkwap/js/jquery.validate.js,__STATIC__/tqkwap/js/validate-methods.js" />
<script type="text/javascript" src="__STATIC__/tqkwap/layer/layer.js" ></script>
<if condition="$alertadv">
	<div id="activity">
		<img src="__STATIC__/tqkwap/images/12.png" width="100%"/>
		<div class="actinp" id="actinp">{$alertadv.url}</div>
		<button class="actcopy" data-clipboard-action="copy" data-clipboard-text="{$alertadv.url}"></button>  
		<label class="cancel"></label>
	</div>
	<script>
		layer.open({
		  type: 1,
		  title: false,
		  closeBtn: 0,
		  area: '80%',
		  offset:'100px',
		  skin: 'layui-layer-nobg', //没有背景色
		  shadeClose: true,
		  content: $('#activity'), 
		  skin: 'activity',
		  success: function(layero, index){
			$('.cancel').click(function(){
			layer.close(index);
			})
		  },
		});
		var clipboard = new Clipboard('.actcopy');
		 clipboard.on('success', function(e) {
		    $('.actcopy').on('click',function(){
			  layer.msg('复制成功', {time:2000});	
			})
		});		
	</script>
</if>
<div class="foot" style="display: none;">
	{:C('yh_statistics_code')}
</div>
