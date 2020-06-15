<include file="public:header" />

<div class="subnav">
	<div class="content_menu ib_a blue line_x">
		<a href="?g=admin&m=brand&a=index&menuid=373" class="on"><em>品牌列表</em></a><span>|</span> <a href="?g=admin&m=brand&a=add&menuid=373" class=""><em>添加品牌</em></a>    </div>
	</div>
	<!--添加文章-->
	<form id="info_form" action="{:U('brand/edit')}" method="post" enctype="multipart/form-data">
		<div class="pad_lr_10">
			<div class="col_tab">
				<ul class="J_tabs tab_but cu_li">
					<li class="current">{:L('article_basic')}</li>
				</ul>
				<div class="J_panes">
					<div class="content_list pad_10">
						<table width="100%" cellspacing="0" class="table_form">
							<tr>
								<th width="120">{:L('article_cateid')} :</th>
								<td><select class="J_cate_select mr10" data-pid="0" data-uri="{:U('brand_cate/ajax_getchilds')}" data-selected="{$selected_ids}"></select><input type="hidden" name="cate_id" id="J_cate_id" value="" /></td>
							</tr>
							<tr>
								<th>品牌名称 :</th>
								<td>
									<input type="text" name="brand" id="brand" class="input-text" size="50" value="{$info.brand}">
								</td>
							</tr>

							<tr>
								<th>品牌LOGO :</th>
								<td>
									<input type="text" name="logo" id="J_img" class="input-text fl mr10" size="30" value="{$info.logo}">
									<div id="J_upload_img" class="upload_btn"><span>{:L('upload')}</span></div>
								</td>
							</tr>

							<tr>
								<th>备注 :</th>
								<td>
									<input type="text" name="remark" id="remark" class="input-text fl mr10" value="{$info.remark}">
								</td>
							</tr>

							<tr>
								<th>排序 :</th>
								<td>
									<input type="text" name="ordid" id="ordid" class="input-text" size="20" value="{$info.ordid}">
								</td>
							</tr>

							<tr>
								<th>是否推荐 :</th>
								<td>
									<label><input type="radio" name="recommend" class="radio_style" value="1" <if condition="$info['recommend'] eq 1">checked</if>> {:L('yes')} </label>&nbsp;&nbsp;
									<label><input type="radio" name="recommend" class="radio_style" value="0" <if condition="$info['recommend'] eq 0">checked</if>> {:L('no')}</label>
								</td>
							</tr>	

							<tr>
								<th>{:L('publish')} :</th>
								<td>
									<label><input type="radio" name="status" class="radio_style" value="1" <if condition="$info['status'] eq 1">checked</if>> {:L('yes')} </label>&nbsp;&nbsp;
									<label><input type="radio" name="status" class="radio_style" value="0" <if condition="$info['status'] eq 0">checked</if>> {:L('no')}</label>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="mt10"><input type="submit" value="{:L('submit')}" id="dosubmit" name="dosubmit" class="smt mr10" style="margin:0 0 10px 100px;"><br /><br /><br /></div>
			</div>
		</div>
		<input type="hidden" name="menuid"  value="{$menuid}"/>
		<input type="hidden" name="id" id="id" value="{$info.id}" />
	</form>
	<include file="public:footer" />
	<script src="__STATIC__/js/fileuploader.js"></script>
	<script src="__STATIC__/js/kindeditor/kindeditor.js"></script>
	<script>
		$('.J_cate_select').cate_select('请选择');
		$(function() {
			KindEditor.create('#info', {
				uploadJson : '{:U("attachment/editer_upload")}',
				fileManagerJson : '{:U("attachment/editer_manager")}',
				allowFileManager : true
			});
		});
		var uploader = new qq.FileUploaderBasic({
			allowedExtensions: ['jpg','gif','jpeg','png','bmp','pdg'],
			button: document.getElementById('J_upload_img'),
			multiple: false,
			action: "{:U('user/ajax_upload_img')}",
			inputName: 'img',
			forceMultipart: true,
			messages: {
				typeError: lang.upload_type_error,
				sizeError: lang.upload_size_error,
				minSizeError: lang.upload_minsize_error,
				emptyError: lang.upload_empty_error,
				noFilesError: lang.upload_nofile_error,
				onLeave: lang.upload_onLeave
			},
			showMessage: function(message){
				$.yhxia.tip({content:message, icon:'error'});
			},
			onSubmit: function(id, fileName){
				$('#J_upload_img').addClass('btn_disabled').find('span').text(lang.uploading);
			},
			onComplete: function(id, fileName, result){
				$('#J_upload_img').removeClass('btn_disabled').find('span').text(lang.upload);
				if(result.status == '1'){
					$('#J_img').val(result.data);
				} else {
					$.yhxia.tip({content:result.msg, icon:'error'});
				}
			}
		});

	</script>
</body>
</html>