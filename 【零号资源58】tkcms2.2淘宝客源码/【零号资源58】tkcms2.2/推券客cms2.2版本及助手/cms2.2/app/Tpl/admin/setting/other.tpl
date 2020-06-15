<include file="public:header" />
<!--其他设置-->
<div class="pad_lr_10">
	<form id="info_form" action="{:u('setting/edit')}" method="post">
	<table width="100%" class="table_form contentWrap">
		<tr>
			<th>电脑站Logo图片 :</th>
			<td>
				<input type="text" name="setting[site_logo]" id="J_logo_img" class="input-text fl mr10" size="50" value="{:C('yh_site_logo')}">
				<div id="J_logo_upload_img" class="upload_btn"><span>{:L('upload')}</span></div><span class="gray ml10">建议宽:300  高:50  </span><br><br>
				<img src="{:C('yh_site_logo')}" height="100" id="show_logo_J_img" /><span class="attachment_icon J_attachment_icon" file-type="image" ></span>
			</td>
		</tr>
		<tr>
			<th>电脑站首页二维码:</th>
			<td>
				<input type="text" name="setting[site_flogo]" id="J_flogo_img" class="input-text fl mr10" size="50" value="{:C('yh_site_flogo')}">
				<div id="J_flogo_upload_img" class="upload_btn"><span>{:L('upload')}</span></div><span class="gray ml10">建议 宽:250  高:250  </span><br><br>
				<img src="{:C('yh_site_flogo')}" height="100" id="show_flogo_J_img" /><span class="attachment_icon J_attachment_icon" file-type="image" ></span>
			</td>
		</tr>
		<tr>
			<th> 手机站客服二维码:</th>
			<td>
				<input type="text" name="setting[site_background]" id="J_background_img" class="input-text fl mr10" size="50" value="{:C('yh_site_background')}">
				<div id="J_background_upload_img" class="upload_btn"><span>{:L('upload')}</span></div><span class="gray ml10">建议 宽:250  高:250 </span><br><br>
				<img src="{:C('yh_site_background')}" height="100" id="show_background_J_img" /><span class="attachment_icon J_attachment_icon" file-type="image" ></span>
			</td>
		</tr>
		<tr>
			<th>直播间头像:</th>
			<td>
				<input type="text" name="setting[site_zhibo]" id="J_zhibo_img" class="input-text fl mr10" size="50" value="{:C('yh_site_zhibo')}">
				<div id="J_zhibo_upload_img" class="upload_btn"><span>{:L('upload')}</span></div><span class="gray ml10">建议 宽:200  高:200 </span><br><br>
				<img src="{:C('yh_site_zhibo')}" height="100" id="show_zhibo_J_img" /><span class="attachment_icon J_attachment_icon" file-type="image" ></span>
			</td>
		</tr>
		
        	<th></th>
        	<td><input type="hidden" name="menuid"  value="{$menuid}"/><input type="submit" class="smt mr10" name="do" value="{:L('submit')}"/></td>
    	</tr>
 <tr>
 	<th></th>
 	<td></td>
 </tr>
       	<th></th>     

 
	</table>
 
	</form>
</div>
<include file="public:footer" />
<script src="__STATIC__/js/fileuploader.js"></script>
<script type="text/javascript">
$(function(){
    var upload = new qq.FileUploaderBasic({
    	allowedExtensions: ['jpg','gif','png'],
        button: document.getElementById('J_logo_upload_img'),
        multiple: false,
        action: "{:U('setting/ajax_upload')}",
        inputName: 'img',
        forceMultipart: true, //用$_FILES
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
        	$('#J_logo_upload_img').addClass('btn_disabled').find('span').text(lang.uploading);
        },
        onComplete: function(id, fileName, result){
        	$('#J_logo_upload_img').removeClass('btn_disabled').find('span').text(lang.upload);
		if(result.status == '1'){
            		$('#show_logo_J_img').attr('src',result.data);
        		$('#J_logo_img').val(result.data);
        	}else{
        		$.yhxia.tip({content:result.msg, icon:'error'});
        	}
        }
    });

    var zhiboupload = new qq.FileUploaderBasic({
    	allowedExtensions: ['jpg','gif','png'],
        button: document.getElementById('J_zhibo_upload_img'),
        multiple: false,
        action: "{:U('setting/ajax_upload')}",
        inputName: 'img',
        forceMultipart: true, //用$_FILES
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
        	$('#J_zhibo_upload_img').addClass('btn_disabled').find('span').text(lang.uploading);
        },
        onComplete: function(id, fileName, result){
        	$('#J_zhibo_upload_img').removeClass('btn_disabled').find('span').text(lang.upload);
		if(result.status == '1'){
            	$('#show_zhibo_J_img').attr('src',result.data);
        		$('#J_zhibo_img').val(result.data);
        	}else{
        		$.yhxia.tip({content:result.msg, icon:'error'});
        	}
        }
    });


    var navupload = new qq.FileUploaderBasic({
    	allowedExtensions: ['jpg','gif','png'],
        button: document.getElementById('J_background_upload_img'),
        multiple: false,
        action: "{:U('setting/ajax_upload')}",
        inputName: 'img',
        forceMultipart: true, //用$_FILES
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
        	$('#J_background_upload_img').addClass('btn_disabled').find('span').text(lang.uploading);
        },
        onComplete: function(id, fileName, result){
        	$('#J_background_upload_img').removeClass('btn_disabled').find('span').text(lang.upload);
		if(result.status == '1'){
            		$('#show_background_J_img').attr('src',result.data);
        		$('#J_background_img').val(result.data);
        	}else{
        		$.yhxia.tip({content:result.msg, icon:'error'});
        	}
        }
    });

    var fupload = new qq.FileUploaderBasic({
    	allowedExtensions: ['jpg','gif','png'],
        button: document.getElementById('J_flogo_upload_img'),
        multiple: false,
        action: "{:U('setting/ajax_upload')}",
        inputName: 'img',
        forceMultipart: true, //用$_FILES
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
        	$('#J_flogo_upload_img').addClass('btn_disabled').find('span').text(lang.uploading);
        },
        onComplete: function(id, fileName, result){
        	$('#J_flogo_upload_img').removeClass('btn_disabled').find('span').text(lang.upload);
		if(result.status == '1'){
            		$('#show_flogo_J_img').attr('src',result.data);
        		$('#J_flogo_img').val(result.data);
        	}else{
        		$.yhxia.tip({content:result.msg, icon:'error'});
        	}
        }
    });
});
</script>
</body>
</html>