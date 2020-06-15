<include file="public:header" />
<style>
.lt_input_text{
	min-width:50px;
}
</style>
<div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<a href="javascript:;" class="on"><em>余额提现</em></a>
    </div>
</div>
<!--菜单列表-->
<div class="pad_lr_10">
    <div class="J_tablelist table_list" data-acturi="{:U('charge/ajax_edit')}">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <th width="40"><input type="checkbox" name="checkall" class="J_checkall"></th>
      			<th width="80" align="left">用户(冻结资金)</th>
                <th width="80" align="left">提现金额</th>
                <th width="40" align="left">姓名</th>
                <th width="80" align="left">提现方式</th>
                <th width="40" align="left">账号</th>
                <th width="160">说明</th>
                 <th width="80" align="left">时间</th>
                <th width="80">状态</th>
               
                <th width="160">{:L('operations_manage')}</th>
            </tr>
            </thead>
            <tbody>
            <volist name="list" id="val">
            <tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
                <td>{:getUserInfo('',$val['uid'],'username')}(<span style="color: red;">￥{:getUserInfo('',$val['uid'],'frozen')}</span>)</td>
                <td><span>￥{$val.money}</span></td>
                
                <td align="left">
                	<span>{$val.name}</span>
                </td>
                <td align="left">
                	<if condition="$val['method'] eq 1">
                	<span>微信</span>
                	<else />
                	<span>支付宝</span>
                	</if>
                </td>
                <td align="left">
                	<span>{$val.allpay}</span>
                </td>
                <td align="center">
                	<span data-tdtype="" data-field="content" data-id="{$val.id}" class="">{$val.content}</span>
                </td>
                <td align="left">
                	<span>{$val.create_time|frienddate}</span>
                </td>
                
                <td align="center">
                	<if condition="$val['status'] eq 0">
                	<span style="color: red;">待处理</span>
               		<else/>
               		<span style="color: green;">已处理</span>
               		</if>
                </td>
                
                <td align="center">
                	<if condition="$val['status'] eq 0">
                		<a href="javascript:void(0);" class="J_confirmurl" data-uri="{:U('balance/balance_status', array('id'=>$val['id'],'status'=>1,'money'=>$val['money'],'uid'=>$val['uid']))}"  data-msg="是否真的确认付款？" data-acttype="ajax">确认提现</a>  |
                   	<else/>
                   	<span style="color: gray;">已付款</span> |  
                	</if>
                    <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="{:U('delete', array('id'=>$val['id']))}" data-msg="{:sprintf(L('confirm_delete_one'),$val['id'])}"><span>{:L('delete')}</span></a>
                </td>
            </tr>
            </volist>
            </tbody>
        </table>
    </div>
    <div class="btn_wrap_fixed">
        <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('balance/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
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