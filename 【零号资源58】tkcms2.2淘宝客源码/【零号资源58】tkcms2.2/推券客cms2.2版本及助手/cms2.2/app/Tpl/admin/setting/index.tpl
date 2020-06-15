<include file="public:header" />
<div class="pad_lr_10">
	<form id="info_form" action="{:u('setting/edit')}" method="post" enctype="multipart/form-data">
	<table width="100%" class="table_form">
    	<tr>
        	<th>{:L('site_status')} :</th>
        	<td>
            	<label><input type="radio" class="J_change_status" <if condition="C('yh_site_status') eq '1'">checked="checked"</if> value="1" name="setting[site_status]"> {:L('open')}</label> &nbsp;&nbsp;
                <label><input type="radio" class="J_change_status" <if condition="C('yh_site_status') eq '0'">checked="checked"</if> value="0" name="setting[site_status]"> {:L('close')}</label>
            </td>
    	</tr>

    	<tr>
        	<th>跳转WAP :</th>
        	<td>
            	<label><input type="radio" class="J_change_status" <if condition="C('yh_site_tiaozhuan') eq '1'">checked="checked"</if> value="1" name="setting[site_tiaozhuan]"> {:L('open')}</label> &nbsp;&nbsp;
                <label><input type="radio" class="J_change_status" <if condition="C('yh_site_tiaozhuan') eq '0'">checked="checked"</if> value="0" name="setting[site_tiaozhuan]"> {:L('close')}</label>
            </td>
    	</tr>
    	 	<tr>
        	<th>淘宝图片开启ssl :</th>
        	<td>
            	<label><input type="radio" class="J_change_status" <if condition="C('yh_site_secret') eq '1'">checked="checked"</if> value="1" name="setting[site_secret]"> {:L('open')}</label> &nbsp;&nbsp;
                <label><input type="radio" class="J_change_status" <if condition="C('yh_site_secret') eq '0'">checked="checked"</if> value="0" name="setting[site_secret]"> {:L('close')}</label>
               &nbsp;&nbsp; <a id="ressl" href="javascript:;" style="color: blue;">一键替换</a> （第一次开启需要点击一键替换）
        	</td>
    	</tr>
    	
        <tr>
            <th width="150">{:L('site_name')} :</th>
            <td><input type="text" name="setting[site_name]" class="input-text" size="30" value="{:C('yh_site_name')}"></td>
        </tr>
		<tr>
            <th width="150">{:L('site_url')} :</th>
            <td><input type="text" name="setting[site_url]" class="input-text" size="30" value="{:C('yh_site_url')}">
				<span class="gray ml10">电脑版首页网址必须以 http:// 开头</span>
			</td>
       </tr> 
        <tr>
            <th width="150">WAP地址 :</th>
            <td>
                <input type="text" name="setting[headerm_html]" class="input-text" size="30" value="{:C('yh_headerm_html')}">
				<span class="gray ml10">手机版首页网址必须以 http:// 开头</span>
			</td>
        </tr>
        <tr>
            <th>{:L('site_icp')} :</th>
            <td><input type="text" name="setting[site_icp]" class="input-text" size="30" value="{:C('yh_site_icp')}">
				<span class="gray ml10">备案号如：苏ICP备05909090号 </span>
            </td>
        </tr>
		<tr>
            <th>QQ号码 :</th>
            <td><input type="text" name="setting[qq]" class="input-text" size="30" value="{:C('yh_qq')}"></td>
        </tr>
		
		<tr>
			<th width="10%">Appkey :</th>
        	<td width="40%">
				<input type="text" name="setting[taobao_appkey]" class="input-text" size="45" value="{:C('yh_taobao_appkey')}" placeholder="联盟合作网站API Appkey ">
            </td>
		</tr>
		
		<tr>
			<th width="10%">App Secret :</th>
        	<td width="40%">
				<input type="text" name="setting[taobao_appsecret]" class="input-text" size="45" value="{:C('yh_taobao_appsecret')}" placeholder="联盟合作网站API App Secret">
            </td>
		</tr>
		
     
	   <tr>
            <th width="150">阿里妈妈PID:</th>
            <td>
                <input type="text" name="setting[taobao_pid]" placeholder="填写推客助手中的PID" class="input-text" size="50" value="{:C('yh_taobao_pid')}" /><br>
                <span class="gray ml10">此PID必须要和上面的appkey 属于同一站点下的，否则无法使用好券清单功能。 </span>
	           </td>
        </tr>
	
		<tr>
			<th width="150">通行密钥 :</th>
			<td><input type="text" name="setting[gongju]" class="input-text" size="50" value="{:C('yh_gongju')}" /><br><span class="gray ml10">请复制推券客高佣金申请工具中的通行密钥填写</span></td>
		</tr>
		
        <tr>
            <th width="150">百度推送准入密钥 :</th>
            <td><input type="text" name="setting[zhunru]" class="input-text" size="50" value="{:C('yh_zhunru')}" /><br><span class="gray ml10">在站长平台申请的推送用的准入密钥</span></td>
        </tr>

		<tr>
			<th width="150">积分返现比例 :</th>
			<td><input type="text" placeholder="请填写积分兑换红包的比例 如：30" name="setting[fanxian]" class="input-text" size="50" value="{:C('yh_fanxian')}" /><br><span class="gray ml10">用户提交订单获得与佣金相等的积分返还。如：100元的订单淘客佣金20元 即用户可获得20积分 </span></td>
		</tr>
        <tr>
            <th width="150">精品晒单积分 :</th>
            <td><input type="text" placeholder="用户晒的精品帖，将获得的积分 如：15" name="setting[jingpintie]" class="input-text" size="50" value="{:C('yh_jingpintie')}" />
            <br><span class="gray ml10">计算公式：15(精品晒单获得积分)  30%(积分兑换比例)= 4.5 元 (用户晒单成功可获得金额) </span></td>
		</tr>
        <tr>
            <th width="150">普通晒单积分 :</th>
            <td><input type="text" placeholder="用户晒的普通帖，将获得的积分 如：10" name="setting[putongtie]" class="input-text" size="50" value="{:C('yh_putongtie')}" /></td>
        </tr>
        
         <tr>
            <th width="150">允许上传的文件格式 :</th>
            <td><input type="text"  name="setting[attr_allow_exts]" class="input-text" size="50" value="{:C('yh_attr_allow_exts')}" /></td>
        </tr>
		
     <tr>
			<th width="10%">pc版头部文字 :</th>
        	<td width="40%">
        		 <textarea rows="3" cols="80" name="setting[app_key]">{:C('yh_app_key')}</textarea> 
				
            </td>
		</tr>

        <tr>
            <th>{:L('statistics_code')} :</th>
            <td>
                <textarea rows="6" cols="80" name="setting[statistics_code]">{:C('yh_statistics_code')}</textarea> 
				<span class="gray ml10"><br>统计代码需要你自己去CNZZ 或 百度 申请 <a href="http://www.cnzz.com/" target="_blank">http://www.cnzz.com/</a>  <a href="http://tongji.baidu.com" target="_blank">http://tongji.baidu.com</a></span>
			</td>
           
      </tr>

		<tr>
            <th width="150">淘点金代码 :</th>
            <td>
                <textarea rows="6" cols="80" name="setting[taojindian_html]">{:C('yh_taojindian_html')}</textarea>
            </td>
        </tr>
        <tr id="J_closed_reason" <if condition="C('yh_site_status') eq 1">class="hidden"</if>>
        	<th>{:L('closed_reason')} :</th>
        	<td><textarea rows="4" cols="50" name="setting[closed_reason]" id="closed_reason">{:C('yh_closed_reason')}</textarea></td>
    	</tr>
        <tr>
        	<th></th>
        	<td><input type="hidden" name="menuid"  value="{$menuid}"/><input type="submit" class="smt mr10" value="{:L('submit')}"/></td>
    	</tr>
	</table>
	</form>
</div>
<include file="public:footer" />
<script>
$(function(){
    $('.J_change_status').live('click', function(){
        if($(this).val() == '0'){
            $('#J_closed_reason').fadeIn();
        }else{
            $('#J_closed_reason').fadeOut();
        }
    });
});

$("#ressl").on('click',function(){
   	
$.ajax({ 
url: "{:U('setting/ressl')}",  
type:'get',
dataType: "text",
async: true,  
success: function(data){
	if(data=='ok'){
	 alert('替换完成！');
		}else{
		alert('替换失败！');
		}
	}  
});

   	
});
</script>
</body>
</html>