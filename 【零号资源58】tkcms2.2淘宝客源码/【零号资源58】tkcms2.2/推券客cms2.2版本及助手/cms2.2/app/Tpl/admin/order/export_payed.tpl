<div class="dialog_content">
	<form id="info_form" action="{:U('order/putin_pay_stat')}" method="post">
	<table width="100%" class="table_form">
        <tr>
			<th>说明</th>
			<td>
			请在阿里妈妈 “效果报表”=>“订单明细”=>"淘宝客推广" <br/>中下载<font color="red">已付款</font>的excel数据
			</td>
		</tr>
		 <tr>
			<th>上传Excel</th>
			<td>	<input type="text" name="alixls" id="J_img" class="input-text fl mr10" size="30" value="">
            	<div id="J_upload_img" class="upload_btn"><span>{:L('upload')}</span></div> </td>
            	<input name="key" value="{:trim(C('yh_gongju'))}" type="hidden" >
		</tr>
	</table>
	</form>
</div>
	
<script src="__STATIC__/js/fileuploader.js"></script>
<script>

$(function(){
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$('#info_form').ajaxForm({success:complate,dataType:'json'});
	function complate(result){
		if(result.status == 1){
		//	$.dialog.get(result.dialog).close();
            $.yhxia.tip({content:result.msg});
            window.location.reload();
		} else {
			$.yhxia.tip({content:result.msg, icon:'alert'});
		}
	}
	
	
	//上传图片
    var uploader = new qq.FileUploaderBasic({
    	allowedExtensions: ['xls'],
        button: document.getElementById('J_upload_img'),
        multiple: false,
        action: "{:U('order/ajax_upload_xls')}",
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