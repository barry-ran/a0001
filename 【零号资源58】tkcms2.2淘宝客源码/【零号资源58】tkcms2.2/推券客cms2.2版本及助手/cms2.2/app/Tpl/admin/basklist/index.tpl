<include file="public:header" />
<!--文章列表-->


<div class="subnav">
    <div class="content_menu ib_a blue line_x">
       <a href="?g=admin&m=basklist&a=index&menuid=369" class="on"><em>晒单列表</em></a><span></div>
   </div>
   <div class="pad_lr_10" >
    <form name="searchform" method="get" >
        <table width="100%" cellspacing="0" class="search_form">
            <tbody>
                <tr>
                    <td>
                        <div class="explain_col">
                            <input type="hidden" name="g" value="admin" />
                            <input type="hidden" name="m" value="basklist" />
                            <input type="hidden" name="a" value="index" />
                            <input type="hidden" name="menuid" value="{$menuid}" />
                            {:L('publish_time')}：
                            <input type="text" name="time_start" id="time_start" class="date" size="12" value="{$search.time_start}">
                            -
                            <input type="text" name="time_end" id="time_end" class="date" size="12" value="{$search.time_end}">

                            <input type="hidden" name="cate_id" id="J_cate_id" value="{$search.cate_id}" />
                            &nbsp;&nbsp;{:L('status')}:
                            <select name="status">
                                <option value="">-{:L('all')}-</option>
                                <option value="1" <if condition="$search.status eq '1'">selected="selected"</if>>已审核</option>
                                <option value="2" <if condition="$search.status eq '2'">selected="selected"</if>>未审核</option>
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

    <div class="J_tablelist table_list" data-acturi="{:U('basklist/ajax_edit')}">
        <table width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                    <th><span data-tdtype="order_by" data-field="id">ID</span></th>
                    <th width=150><span data-tdtype="order_by" data-field="cate_id">订单号</span></th>
                    <th width=50>发表人</th>
                    <th width=500><span data-tdtype="order_by" data-field="hits">内容</span></th>
                    <th><span data-tdtype="order_by" data-field="add_time">图片</span></th>
                    <th width=60><span data-tdtype="order_by" data-field="ordid">创建时间</span></th>
                    <th width="40"><span data-tdtype="order_by" data-field="status">类型</span></th>
                    <th width="40"><span data-tdtype="order_by" data-field="status">积分</span></th>
                    <th width="40"><span data-tdtype="order_by" data-field="status">{:L('status')}</span></th>
                    <th width="80">{:L('operations_manage')}</th>
                </tr>
            </thead>
            <tbody>
                <volist name="list" id="val" >
                    <tr>
                        <td align="center"><input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
                        <td align="center">{$val.id}</td>
                        <td align="center">{$val.order_sn}</td>
                        <td align="center"><b>{$val.nick}</b></td>
                        <php>$contentstr = mb_substr($val['content'],0,30);</php>
                        <td align="center"><b>{$contentstr}...</b></td>
                        <php>$imgArr = explode(',',$val['images']);</php>
                        <td width="300">
                        <volist name="imgArr" id="vo">
                        <img src="{$vo}" width="50" height="50" />&nbsp;
                        </volist>
                        </td>
                        <td align="center">{$val.create_time|frienddate}</td> 
                        <td align="center">
                        <if condition="$val['type'] eq 1">
                        精华帖
                        <elseif condition="$val['type'] eq 2"/>
                        普通帖
                        </if>
                        </td> 
                        <td align="center">{$val.integray}</td> 
                        <td align="center">
                        <if condition="$val['status'] eq 0">
                        <a href="javascript:;" class="J_showdialog" data-uri="{:u('basklist/audit', array('id'=>$val['id'], 'menuid'=>$menuid))}" data-title="审核" data-id="edit" data-width="300" data-height="100">审核</a>
                        <elseif condition="$val['status'] eq 2"/>
                        <span style="color:red;">未通过</span>
                        <else/>
                        已通过
                        </if>
                        </td>
                        <td align="center"><a href="{:u('basklist/edit', array('id'=>$val['id'], 'menuid'=>$menuid))}">编辑</a> | <a href="javascript:void(0);" class="J_confirmurl" data-acttype="ajax" data-uri="{:u('basklist/delete', array('id'=>$val['id']))}" data-msg="{:sprintf(L('confirm_delete_one'),$val['title'])}">{:L('delete')}</a></td>
                    </tr>
                </volist>
            </tbody>
        </table>

        <div class="btn_wrap_fixed">
            <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
            <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('basklist/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
            <div id="pages">{$page}</div>
        </div>

    </div>
</div>
<include file="public:footer" />
<link rel="stylesheet" type="text/css" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script src="__STATIC__/js/calendar/calendar.js"></script>
<script>
    $('.J_cate_select').cate_select({top_option:lang.all});
    Calendar.setup({
        inputField : "time_start",
        ifFormat   : "%Y-%m-%d",
        showsTime  : false,
        timeFormat : "24"
    });
    Calendar.setup({
        inputField : "time_end",
        ifFormat   : "%Y-%m-%d",
        showsTime  : false,
        timeFormat : "24"
    });
</script>
</body>
</html>
