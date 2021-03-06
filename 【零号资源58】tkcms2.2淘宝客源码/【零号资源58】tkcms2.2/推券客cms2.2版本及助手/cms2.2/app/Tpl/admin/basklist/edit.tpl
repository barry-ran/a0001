<include file="public:header" />

<div class="subnav">
	<div class="content_menu ib_a blue line_x">
		<a href="?g=admin&m=basklist&a=index&menuid=350" class="on"><em>晒单列表</em></a>  </div>
	</div>
	<form id="info_form" action="{:u('basklist/edit')}" method="post" enctype="multipart/form-data">
		<div class="pad_lr_10">
			<div class="col_tab">
				<ul class="J_tabs tab_but cu_li">
					<li class="current">{:L('article_basic')}</li>
				</ul>
				<div class="J_panes">
					<div class="content_list pad_10">
						<table width="100%" cellspacing="0" class="table_form">
							<tr>
								<th>订单号 :</th>
								<td>
									<input type="text" name="order_sn" id="J_title" rel="title_color" class="input-text iColorPicker" size="60" value="{$info.order_sn}">
								</td>
							</tr>
							<tr>
								<th>图片 :</th>
								<td>
								<php>$imgArr = explode(',',$info['images']);</php>
								<volist name="imgArr" id="vo">
									<img src="{$vo}" width="200" height="200" />&nbsp;
								</volist>
								</td>
							</tr>
							<tr>
								<th>详细内容 :</th>
								<td><textarea name="content" id="info" style="width:88%;height:400px;visibility:hidden;resize:none;">{$info.content}</textarea></td>
							</tr>

						</table>
					</div>
				</div>
				<div class="mt10"><input type="submit" value="{:L('submit')}" id="dosubmit" name="dosubmit" class="btn btn_submit" style="margin:0 0 10px 100px;"><br /><br /><br /></div>
			</div>
		</div>
		<input type="hidden" name="menuid"  value="{$menuid}"/>
		<input type="hidden" name="id" id="id" value="{$info.id}" />
	</form>
	<include file="public:footer" />
	<script src="__STATIC__/js/jquery/plugins/iColorPicker.js"></script>
	<script src="__STATIC__/js/jquery/plugins/colorpicker.js"></script>
	<script src="__STATIC__/js/kindeditor/kindeditor-min.js"></script>
	<script>
		$('.J_cate_select').cate_select('请选择');
		$(function() {
			KindEditor.create('#info', {
				uploadJson : '{:U("attachment/editer_upload")}',
				fileManagerJson : '{:U("attachment/editer_manager")}',
				allowFileManager : true
			});
			$('ul.J_tabs').tabs('div.J_panes > div');

	//颜色选择器
	$('.J_color_picker').colorpicker();
	//自动获取标签
	$('#J_gettags').live('click', function() {
		var title = $.trim($('#J_title').val());
		if(title == ''){
			$.yhxia.tip({content:lang.article_title_isempty, icon:'alert'});
			return false;
		}
		$.getJSON('{:U("article/ajax_gettags")}', {title:title}, function(result){
			if(result.status == 1){
				$('#J_tags').val(result.data);
			}else{
				$.yhxia.tip({content:result.msg});
			}
		});
	});
});
</script>
</body>
</html>