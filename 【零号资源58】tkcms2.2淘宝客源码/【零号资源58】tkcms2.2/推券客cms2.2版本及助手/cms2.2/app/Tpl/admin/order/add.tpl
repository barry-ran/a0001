<!--添加广告-->
<div class="dialog_content">
<form id="info_form" action="{:u('ad/add')}" method="post">
<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
    <tr>
      <th width="80">{:L('ad_name')} :</th>
      <td><input type="text" name="name" id="name" class="input-text" size="40"></td>
    </tr>
    <tr>
      <th>文案链接 :</th>
      <td><input placeholder="手机弹窗请输入淘口令文案，其它请填链接" type="text" name="url" class="input-text" size="40"></td>
    </tr>
    <tr id="ad_image" class="bill_media">
      <th>{:L('ad_image')} :</th>
      <td>
          <input type="text" name="img" id="J_img" class="input-text fl mr10" size="30">
          <div id="J_upload_img" class="upload_btn"><span>{:L('upload')}</span></div>
      </td>
    </tr>
    <tr id="ad_code" class="bill_media" style="display:none;">
      <th>{:L('ad_code')} :</th>
      <td><textarea rows="3" cols="50" name="code" id="code"></textarea></td>
    </tr>

    <tr id="ad_text" class="bill_media" style="display:none;">
      <th>{:L('ad_text')} :</th>
      <td><textarea rows="3" cols="50" name="text" id="text"></textarea></td>
    </tr>
    <tr>
        <th>位置 :</th>  
        <td>
            <label><input type="radio" name="status" value="1" checked>手机banner</label>&nbsp;&nbsp;
            <label><input type="radio" checked="checked" name="status" value="0">电脑banner</label>
            &nbsp;&nbsp; <label><input type="radio" checked="checked" name="status" value="2">PC头部</label>
             &nbsp;&nbsp; <label><input type="radio" checked="checked" name="status" value="3">PC弹窗</label>
             &nbsp;&nbsp;  <label><input type="radio" checked="checked" name="status" value="4">WAP弹窗</label>
        </td>
    </tr>
</table>
</form>
</div>
<script src="__STATIC__/js/fileuploader.js"></script>
<script>
$(function(){
    $("#type").change(function(){
        $(".bill_media").hide();
        $("#ad_"+$(this).val()).show();
    });
    $("#type").change();
    //获取版块允许的广告类型
    $("#board_id").change(function(){
        var allowtype = $("#board_id option:selected").attr('allowtype');
        var allowtype_arr = allowtype.split("|");
        $("#type option").attr('selected', false).hide();
        $("#type option").each(function(){
            for(i=0; i<allowtype_arr.length; i++) {
                if($(this).val() == allowtype_arr[i]){
                    $(this).show();
                }
            }
        });
        $('#type option:visible:first').attr('selected', true);
        $("#type").change();
    });
    $("#board_id").change(); 
    $.formValidator.initConfig({formid:"info_form",autotip:true});
    $("#name").formValidator({onshow:"请填写广告名称",onfocus:"请填写广告名称"}).inputValidator({min:1,onerror:"请填写广告名称"});
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
    var img_uploader = new qq.FileUploaderBasic({
        allowedExtensions: ['jpg','gif','jpeg','png','bmp','pdg'],
        button: document.getElementById('J_upload_img'),
        multiple: false,
        action: "{:U('ad/ajax_upload_img')}",
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

    var extimg_uploader = new qq.FileUploaderBasic({
        allowedExtensions: ['jpg','gif','jpeg','png','bmp','pdg'],
        button: document.getElementById('J_upload_extimg'),
        multiple: false,
        action: "{:U('ad/ajax_upload_img', array('type'=>'extimg'))}",
        inputName: 'extimg',
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
            $('#J_upload_extimg').addClass('btn_disabled').find('span').text(lang.uploading);
        },
        onComplete: function(id, fileName, result){
            $('#J_upload_extimg').removeClass('btn_disabled').find('span').text(lang.upload);
            if(result.status == '1'){
                $('#J_extimg').val(result.data);
            } else {
                $.yhxia.tip({content:result.msg, icon:'error'});
            }
        }
    });
})
</script>