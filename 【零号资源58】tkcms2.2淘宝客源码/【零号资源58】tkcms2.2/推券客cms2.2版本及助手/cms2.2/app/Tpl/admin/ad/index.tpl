<include file="public:header" />
<!--广告列表-->
<div class="pad_lr_10">    
    <div class="J_tablelist table_list" data-acturi="{:U('ad/ajax_edit')}">
		<table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="25"><input type="checkbox" name="checkall" class="J_checkall"></th>
            <th>ID</th>
            <th align="left"><span data-tdtype="order_by" data-field="name">{:L('ad_name')}</span></th>
            <th align="left"><span data-tdtype="order_by" data-field="url">{:L('ad_url')}</span></th>
            <th><span data-tdtype="order_by" data-field="type">广告图</span></th>
            <th width="60"><span data-tdtype="order_by" data-field="ordid">{:L('sort_order')}</span></th>
            <th width="60"><span data-tdtype="order_by" data-field="status">位置</span></th>
            <th width="80">{:L('operations_manage')}</th>
          </tr>
        </thead>
        <tbody>
          <volist name="board_list" id="val" >
          <tr>
            <td align="center"><input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
            <td align="center">{$val.id}</td>
            <td><span data-tdtype="edit" data-field="name" data-id="{$val.id}" class="tdedit">{$val.name}</span></td>
            <td><span data-tdtype="edit" data-field="url" data-id="{$val.id}" ><a href="{$val.url}">查看链接</a></span></td>
            <td align="center"><span class="attachment_icon J_attachment_icon" file-type="image" file-rel="{$val.img}" ><img src="__STATIC__/images/filetype/image_s.gif" /></span><span data-tdtype="edit" data-field="img" data-id="{$val.id}" class="tdedit">{$val.img}</span></td>
            <td><span data-tdtype="edit" data-field="ordid" data-id="{$val.id}" class="tdedit">{$val.ordid}</span></td>
            <td align="center">
   <if condition="$val.status eq 0">电脑banner
   	<elseif condition="$val.status eq 2"/>PC头部
   	<elseif condition="$val.status eq 3"/>PC弹窗
   	<elseif condition="$val.status eq 4"/>WAP弹窗
   <else/>
   手机banner
   </if>
            
            </td>
            <td align="center"><a href="javascript:void(0);" class="J_confirmurl" data-acttype="ajax" data-uri="{:u('ad/delete', array('id'=>$val['id']))}" data-msg="{:sprintf(L('confirm_delete_one'),$val['name'])}">{:L('delete')}</a></td>
          </tr>
          </volist>
        </tbody>
      	</table>
		<div class="btn_wrap_fixed">
    		<label class="select_all"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
            <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('ad/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
    		<div id="pages">{$page}</div>
    	</div>
    </div>
</div>
<include file="public:footer" />
<link rel="stylesheet" type="text/css" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script type="text/javascript" src="__STATIC__/js/calendar/calendar.js"></script>
</body>
</html>