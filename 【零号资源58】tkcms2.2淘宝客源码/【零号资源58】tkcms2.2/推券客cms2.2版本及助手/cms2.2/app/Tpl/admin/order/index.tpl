<include file="public:header" />
<!--商品列表-->
<div class="pad_10" >

    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                	    <form name="searchform" method="get" >
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="order" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="{$menuid}" />
                    &nbsp;&nbsp;订单号 :
                    <input name="keyword" type="text" class="input-text" size="25" value="{$search.keyword}" />
                    
                    &nbsp;&nbsp;状态 :
                    <select name="status">
                    <option value="">-{:L('all')}-</option>
                    <option value="0" <if condition="$search.status eq '0'">selected="selected"</if>>待处理</option>
                    <option value="2" <if condition="$search.status eq '2'">selected="selected"</if>>失效订单</option>
                    <option value="1" <if condition="$search.status eq '1'">selected="selected"</if>>已付款</option>
                    <option value="3" <if condition="$search.status eq '3'">selected="selected"</if>>已结算</option>
                    </select>
                    &nbsp;&nbsp;
                    <input type="submit" name="search" class="btn" value="搜索" />
                 </form>
                   <div class="bk8"></div>                
                 <form name="export" action="{:U('order/export')}" method="post" target="_blank" >
                    按时间导出 :
			<input type="text" name="time_start" id="J_time_start" class="date" size="12" value="{$search.time_start}">
			-
			<input type="text" name="time_end" id="J_time_end" class="date" size="12" value="{$search.time_end}">
			&nbsp;&nbsp;站长:
			
			<select name="webmaster" class="J_cate_select mr10">
		 <option value="0">所有</option>
		<volist name="webmaster" id="we">
		<option value="{$we.webmaster_pid}">{$we.phone}({$we.nickname})</option>
		</volist>
				
			</select>
			&nbsp;&nbsp;状态:
			
			<select name="status" class="J_cate_select mr10">
				<option value="0">所有</option>
				<option value="1">已付款</option>
				<option value="3">已结算</option>
				<option value="2">已失效</option>
				
			</select>
			
			 <input type="submit" name="search" class="btn" value="导出Excel" />
                        </form>
        <div class="bk8"></div>   
        如果你的推客助手无法自动统计订单，你可以采用手工导入(注：一次导入不要超过500条，否则可能因为运行超时而出错)
         &nbsp;&nbsp;
      <a href="javascript:;" class="J_showdialog" data-uri="{:u('order/export_payed', array('menuid'=>$menuid))}" data-title="导入阿里妈妈已付款订单" data-id="export_payed" data-width="420" data-height="130" style="color: #0000FF;">导入已付款订单</a>
     &nbsp;&nbsp;
     <a href="javascript:;" class="J_showdialog" data-uri="{:u('order/export_sus', array('menuid'=>$menuid))}" data-title="导入阿里妈妈已结算订单" data-id="export_sus" data-width="420" data-height="130" style="color: #0000FF;">导入已结算订单</a>
                   
                   <div class="bk8"></div>                
                </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="J_tablelist table_list" data-acturi="{:U('order/ajax_edit')}">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th width="80"><span data-tdtype="order_by" data-field="uname">返现用户</span></th>
                <th><span data-tdtype="order_by" data-field="item_name">订单号</span></th>
                <th width="120"><span data-tdtype="order_by" data-field="item_num">付款/佣金</span></th>
                <th width="60"><span data-tdtype="order_by" data-field="order_score">返积分</span></th>
                <th width="120"><span data-tdtype="order_by" data-field="add_time">下单时间</span></th>
                 <th width="120"><span data-tdtype="order_by" data-field="add_time">结算时间</span></th>
                 <th width="100"><span data-tdtype="order_by" data-field="add_time">推广位/站长</span></th>
                <th width="60"><span data-tdtype="order_by" data-field="status">{:L('status')}</span></th>
                <th width="120">{:L('operations_manage')}</th>
            </tr>
        </thead>
        <tbody>
            <volist name="orderlist" id="val" >
            <tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
                <td align="center">{:$val['nickname']?$val['nickname']:'--'}</td>
                <td align="center">{$val.orderid}</td>
                <td align="center">
                	<if condition="$val['price']">
                	￥{$val.price} ({$val.income}元)
                	<else/>
                	--
                	</if>
                
                </td>
                <td align="center">
                	 <if condition="$val['integral']">
                	{$val.integral}
                	<else/>
                	--
                	</if>
               </td>  
                <td align="center">{$val.add_time}</td>  
                <td align="center">{:$val['up_time']?$val['up_time']:'--'}</td> 
                 <td align="center">{$val.ad_name}
                 	<font color="red">{$val.webmaster}</font>
                 </td>    
                <td align="center">
              {$val.status}
                </td>
               
               <td align="center">
				
	          <a href="javascript:void(0);" class="J_confirmurl" data-uri="{:u('order/delete_f', array('id'=>$val['id']))}" data-acttype="ajax" data-msg="{:sprintf(L('confirm_delete_one'),$val['title'])}">{:L('delete')}</a></td>
            </tr>
            </volist>
        </tbody>
    </table>
    </div>
    <div class="btn_wrap_fixed">
        <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('order/delete_f')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
        <div id="pages">{$page}</div>
    </div>
</div>
<include file="public:footer" />

<link rel="stylesheet" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script src="__STATIC__/js/calendar/calendar.js"></script>
<script>
Calendar.setup({
	inputField : "J_time_start",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_end",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});

</script>
</body>
</html>