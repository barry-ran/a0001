	<!--foot-->
		<div class="foot">
			<div class="container cl">
				<ul>
					<li>
						<dl>
							<dt>关于我们</dt>
							<dd><a href="{:U('help/index',array('id'=>1))}">关于{:C('yh_site_name')}</a></dd>
							<dd><a href="{:U('help/index',array('id'=>3))}">免责声明</a></dd>
						</dl>
					</li>
					<li>
						<dl>
							<dt>帮助中心</dt>
							<dd><a href="{:U('help/index',array('id'=>4))}">新手指南</a></dd>
							<dd><a href="{:U('help/index',array('id'=>2))}">联系我们</a></dd>
						</dl>
					</li>
					<li>
						<dl>
							<dt>微信扫一扫</dt>
							<dd>
								<div class="public">
									<img src="{:C('yh_site_flogo')}">
									<p>关注公众号</p>
								</div>
							</dd>
						</dl>
					</li>
					<li>
						<dl>
<yh:nav type="lists" style="main">
<volist name="data" id="val"> 
<dd><a href="{$val.link}">{$val.name}</a></dd>
	</volist>
</yh:nav> 
						</dl>
					</li>
					<li>
						<dl>
							<dt>商家合作</dt>
							<dd><a href="javascript:;" class="btn_baoming">商家报名</a></dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>
<!--bottom-->
		<div class="bottom">
			<if condition="strlen($request_url) elt 1 || $request_url eq '/index.php'">
			<ul>
			<yh:link type="lists" status="1">
				<li>友情链接：</li>
				<volist name="data" id="val">
				<li><a href="{$val.url}" target="_blank">{$val.name}</a></li>
			</volist>
			</yh:link>	
			</ul></if>
			<p>Copyright © 2017-2018 {:C('yh_site_name')} 版权所有  {:C('yh_site_icp')}</p>
			<p style="display: none;">{:C('yh_statistics_code')}</p>
		</div>
		<div id="back_top" class="back_top">
			<a href="javascript:;" class="call-top" title="返回顶部" _hover-ignore="1" style="display: block;"></a>
			<a id="checkTrap" rel="nofollow" class="checkTrap" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={:C('yh_qq')}&site=qq&menu=yes"><span class="call-check" title="联系客服"></span></a>
		</div>
{:C('yh_taojindian_html')}
<if condition="$alertadv">
<div id="activity">
	<img src="__STATIC__/tqkpc/images/12.png" width="100%"/>
	<a href="{$alertadv.url}" rel="nofollow" target="_blank" class="actbtn"></a>
	<label class="cancel"></label>
</div>
<script type="text/javascript">
$(function(){
	layer.open({
	  type: 1,
	  title: false,
	  closeBtn: 0,
	  area: 'auto',
	  offset:'25%',
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
});
</script>
  </if> 
<script language="JavaScript">
jQuery(function($) {
				var backTop = jQuery(".call-top");
				$(window).scroll(function() {
					if($(window).scrollTop() > 150) {
						backTop.css("display", "block");
					} else {
						backTop.css("display", "none");
					}
				})
				$('#back_top .call-top').click(function() {
					$('body,html').animate({
						scrollTop: 0
					}, 500);
					return false;
				})
				$(".btn_baoming").click(function(){
				layer.open({
				  type: 2,
				  title: '卖家入驻报名',
				  shadeClose: true,
				  shade: 0.8,
				  area: ['600px', '520px'],
				  content: ['/?m=baoming','no'] //iframe的url
				}); 
				
				
				});
				
				$("#jubao").click(function(){
				var num_iid=$('#jubao').attr('rel');
				layer.open({
				  type: 2,
				  title: '卖家违规举报',
				  shadeClose: true,
				  shade: 0.8,
				  area: ['440px', '280px'],
				  content: ['/?m=baoming&a=jubao&num_iid='+num_iid,'no'] //iframe的url
				});
					
				})		

				
			})
</script>