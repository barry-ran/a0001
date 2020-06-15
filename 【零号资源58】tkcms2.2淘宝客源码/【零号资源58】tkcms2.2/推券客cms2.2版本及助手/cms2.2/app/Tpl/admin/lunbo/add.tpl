<div class="dialog_content">
<form id="info_form" action="{:u('link/add')}" method="post">
<div class="common-form">
	<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
 
        <tr>
			<th width="100">链接名称 :</th>
			<td><input type="text" name="name" id="name" class="input-text" size="30"></td>
		</tr>
        <tr>
			<th width="100">链接地址 :</th>
			<td><input type="text" name="url" id="url" class="input-text" size="30"></td>
		</tr>
		<tr>
			<th>图片 :</th>
			<td>
            	<input type="text" name="img" id="J_img" class="input-text fl mr10" size="30">
            	<div id="J_upload_img" class="upload_btn"><span>{:L('upload')}</span></div>
			</td>
		</tr>
        <tr>
			<th width="100">排序值 :</th>
			<td><input type="text" name="ordid" id="ordid" class="input-text" size="10"></td>
		</tr>
		<tr>
			<th>{:L('enabled')} :</th>
			<td>
				<label><input type="radio" name="status" class="radio_style" value="1" checked="checked">&nbsp;{:L('yes')}&nbsp;&nbsp; </label>
				<label><input type="radio" name="status" class="radio_style" value="0">&nbsp;{:L('no')}&nbsp;&nbsp; </label>
			</td>
		</tr>
	</table>
</div>
</form>
</div>
<script src="__STATIC__/js/fileuploader.js"></script>
<script type="text/javascript">
var check_name_url = "{:U('link/ajax_check_name')}";
$(function(){
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#name").formValidator({onshow:"请填写链接名称",onfocus:"请填写链接名称"}).inputValidator({min:1,onerror:"请填写链接名称"}).ajaxValidator({
	    type : "get",
		url : check_name_url,
		datatype : "json",
		async:'false',
		success : function(result){	
            if(result.status == 0){
                return false;
			}else{
                return true;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "链接名称已经存在",
		onwait : "正在验证"
	});
	$("#cate_id").formValidator({onshow:"请选择分类",onfocus:"请选择分类"}).inputValidator({min:1,onerror:"请选择分类"});
	$("#url").formValidator({onshow:"请填写链接地址",onfocus:"请填写链接地址"}).inputValidator({min:1,onerror:"请填写链接地址"});
	
	$('#info_form').ajaxForm({success:complate,dataType:'json'});

	function complate(result){
		if(result.status == 1){
			$.dialog.get(result.dialog).close();
			$.yhxia.tip({content:result.msg});
			window.location.reload();
		} else {
			$.yhxia.tip({content:result.msg, icon:'alert'});
		}
	}
	
	//上传图片
    var uploader = new qq.FileUploaderBasic({
    	allowedExtensions: ['jpg','gif','jpeg','png','bmp','pdg'],
        button: document.getElementById('J_upload_img'),
        multiple: false,
        action: "{:U('link/ajax_upload_img')}",
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
});
</script>