<include file="public:header" />
<!--会员列表-->
<div class="pad_10" >
    <form name="searchform" method="get" >
        <table width="100%" cellspacing="0" class="search_form">
            <tbody>
                <tr>
                    <td>
                        <div class="explain_col">
                            <input type="hidden" name="g" value="admin" />
                            <input type="hidden" name="m" value="user" />
                            <input type="hidden" name="a" value="index" />
                            <input type="hidden" name="menuid" value="{$menuid}" />
                            &nbsp;关键字 :
                            <input name="keyword" type="text" class="input-text" size="25" value="{$search.keyword}" />
                            <input type="submit" name="search" class="btn" value="搜索" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <div class="J_tablelist table_list" data-acturi="{:U('user/ajax_edit')}">
        <table width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                    <th><span data-tdtype="order_by" data-field="id">ID</span></th>
                    <th width="40">头像</th>
                    <th align="left"><span data-tdtype="order_by" data-field="username">用户名</span></th>
                    <th width="120" align="left"><span data-tdtype="order_by" data-field="email">手机</span></th>
                    <th width="60" align="right"><span data-tdtype="order_by" data-field="score">账户余额</span></th>
                    <th width="60" align="right"><span data-tdtype="order_by" data-field="score">冻结资金</span></th>
                    <th width="60" align="right"><span data-tdtype="order_by" data-field="score">积分</span></th>
                    <th width="120"><span data-tdtype="order_by" data-field="reg_time">注册时间</span></th>
                    <th width="40"><span data-tdtype="order_by" data-field="status">站长</span></th>
                    <th width="40"><span data-tdtype="order_by" data-field="status">{:L('status')}</span></th>
                    <th width="140">{:L('operations_manage')}</th>
                </tr>
            </thead>
            <tbody>
                <volist name="list" id="val" >
                    <tr>
                        <td align="center"><input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
                        <td align="center">{$val.id}</td>
                        <td align="center"><img src="{$val.avatar}" style="width: 20px;height: 20px;"/></td>
                        <td align="left"><span data-tdtype="" data-field="username" data-id="{$val.id}" class="">{$val.username}</span></td>
                        <td align="left"><span data-tdtype="" data-field="email" data-id="{$val.id}" class="">{$val.phone}</span></td>
                        <td align="right"><span data-tdtype="" data-field="money" data-id="{$val.id}" class="">{$val.money}</span></td>
                        <td align="right"><span data-tdtype="" data-field="frozen" data-id="{$val.id}" class="">{$val.frozen}</span></td>
                        <td align="right"><span data-tdtype="" data-field="score" data-id="{$val.id}" class="">{$val.score}</span></td>
                        <td align="center">{$val.reg_time|frienddate}</td>
                        <td align="center">{:$val['webmaster']==1?'<font color="red">是</font>':'否'}</td>
                        <td align="center"><img data-tdtype="toggle" data-id="{$val.id}" data-field="status" data-value="{$val.status}" src="__STATIC__/images/admin/toggle_<if condition="$val.status eq 0">disabled<else/>enabled</if>.gif" /></td>
                        <td align="center">
                           <a href="javascript:;" class="J_showdialog" data-uri="{:u('user/edit', array('id'=>$val['id'], 'menuid'=>$menuid))}" data-title="编辑-{$val.username}" data-id="edit" data-width="520" data-height="330">编辑</a> | <a href="javascript:void(0);" class="J_confirmurl" data-uri="{:u('user/delete', array('id'=>$val['id']))}" data-acttype="ajax" data-msg="{:sprintf(L('confirm_delete_one'),$val['username'])}">{:L('delete')}</a></td>
                       </tr>
                   </volist>
               </tbody>
           </table>
           <div class="btn_wrap_fixed">
            <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
            <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('user/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
            <div id="pages">{$page}</div>
        </div>

    </div>
</div>
<include file="public:footer" />
</body>
</html>
<link rel="stylesheet" type="text/css" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script type="text/javascript" src="__STATIC__/js/calendar/calendar.js"></script>
