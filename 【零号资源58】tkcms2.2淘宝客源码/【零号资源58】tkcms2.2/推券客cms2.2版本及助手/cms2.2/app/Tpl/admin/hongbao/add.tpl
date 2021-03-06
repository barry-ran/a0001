<!--新增红包-->
<div class="dialog_content">
	<form id="info_form" action="{:u('hongbao/added')}" method="post">
	<table width="100%" class="table_form">
		<tr>
			<th width="100">金额 :</th>
			<td><input type="text" id="price" name="price" class="input-text" placeholder="金额不低于1元" />元</td>
		</tr>
	    <tr>
			<th>拆分 :</th>
			<td><input type="text" name="num" id="num" class="input-text fl mr10" size="30" >份</td>
		</tr>
        <tr>
			<th>推送时间 :</th>
			<td><input type="text" name="push_time" id="push_time" class="input-text date" ></td>
		</tr>
	</table>
	<input type="hidden" name="did" value="{$info.id}" />
	</form>
</div>
<script>
$(function(){
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#price").formValidator({onshow:'金额不低于1元',onfocus:'金额不低于1元'}).inputValidator({min:1,number:true,onerror:'金额不低于1元'});
	$("#num").formValidator({onshow:'拆分数为整数',onfocus:'拆分数为整数'}).inputValidator({min:1,number:true,digits:true,onerror:'拆分数为整数'});
	
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
    
});

Calendar.setup({
    inputField     :    "push_time",
    ifFormat       :    "%Y-%m-%d %H:%M",
    showsTime      :    'true',
    timeFormat     :    "24"
});
</script>