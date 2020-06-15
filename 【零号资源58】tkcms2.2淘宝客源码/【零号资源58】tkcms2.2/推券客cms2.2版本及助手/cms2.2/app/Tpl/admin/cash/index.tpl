<include file="public:header" />
<style>
.lt_input_text{
	min-width:50px;
}
</style>
<div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<a href="javascript:;" class="on"><em>财务日志</em></a>
    </div>
</div>
<!--菜单列表-->
<div class="pad_lr_10">
	<form name="searchform" method="get" >
	    <table width="100%" cellspacing="0" class="search_form">
	        <tbody>
	        <tr>
	            <td>
	            <div class="explain_col">
	          
	                <input type="hidden" name="g" value="admin" />
	                <input type="hidden" name="m" value="cash" />
	                <input type="hidden" name="a" value="index" />
	                <input type="hidden" name="menuid" value="{$menuid}" />
	         		&nbsp;&nbsp;日志分类 :
	                <select name="type">
	                	<option value="">所有…</option>
	                	<option value="6" <if condition="$search['type'] eq 6">selected="selected"</if>>余额提现</option>
	                </select>
	                &nbsp;&nbsp;{:L('keyword')} :
	                <input name="keyword" type="text" class="input-text" size="25" value="{$search.keyword}" />
	                <input type="submit" name="search" class="btn" value="{:L('search')}" />
	            </div>
	            </td>
	        </tr>
	        </tbody>
	    </table>
    </form>

    <div class="J_tablelist table_list" data-acturi="{:U('cash/ajax_edit')}">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <th width="40"><input type="checkbox" name="checkall" class="J_checkall"></th>
      			<th width="80" align="left">用户</th>
                <th width="80">类型</th>
                <th width="80" align="left">金额</th>
                <th width="160" align="left">时间</th>
                <th width="40">说明</th>
            </tr>
            </thead>
            <tbody>
            	
            <volist name="list" id="val">
            <tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
                <td>{:getUserInfo('',$val['uid'],'username')}</td>
                <td align="center"><span style="color:green;">
               <?php $type = unserialize(user_cash_type($val['type'])); ?>
                {:$type[0]}
                </span></td>
                <td>{:$type[1]}{$val.money}</td>
                <td align="left">
                	<span data-tdtype="" class="">{$val.create_time|frienddate}</span>
                </td>
                <td align="center">
                	<span data-tdtype="" data-field="reason" data-id="{$val.id}" class="">{$val.remark}</span>
                </td>
            </tr>
            </volist>
            </tbody>
        </table>
    </div>
    <div class="btn_wrap_fixed">
        <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('cash/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
        <div id="pages">{$page}</div>
    </div>
</div>
<include file="public:footer" />
<script>
	$('.img-referer').click(function(){
		window.open('javascript:window.name;', '<script>location.replace("'+$(this).attr('href')+'")<\/script>');
		return false;
	});
</script>
</body>
</html>