<?php /*a:3:{s:55:"D:\phpstudy\WWW\application\admin\view\users\index.html";i:1585249912;s:48:"D:\phpstudy\WWW\application\admin\view\main.html";i:1583653879;s:62:"D:\phpstudy\WWW\application\admin\view\users\index_search.html";i:1585626908;}*/ ?>
<div class="layui-card layui-bg-gray"><style>        .layui-tab-card>.layui-tab-title .layui-this {
            background-color: #fff;
        }
    </style><!--<div class="layui-tab layui-tab-card" lay-allowClose="true" lay-filter="test1">--><!--<ul class="layui-tab-title">--><!--<li lay-id="/admin/users/index" class="layui-this">网站设置</li>--><!--<li lay-id="/admin/deal/order_list">用户基本管理</li>--><!--<li lay-id="222">权限分配</li>--><!--<li lay-id="222">全部历史商品管理文字长一点试试</li>--><!--<li lay-id="222">全部历史商品管理文字长一点试试</li>--><!--<li lay-id="222">订单管理</li>--><!--<li lay-id="222">订单管理</li>--><!--<li lay-id="222">订单管理</li>--><!--<li lay-id="222">订单管理</li>--><!--<li lay-id="222">订单管理</li>--><!--<li lay-id="222">订单管理</li>--><!--<li lay-id="222">订单管理</li>--><!--<li lay-id="222">订单管理</li>--><!--<li lay-id="222">订单管理</li>--><!--</ul>--><!--</div>--><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header layui-anim layui-anim-fadein notselect"><span class="layui-icon layui-icon-next font-s10 color-desc margin-right-5"></span><?php echo htmlentities((isset($title) && ($title !== '')?$title:'')); ?><div class="pull-right"><?php if(auth("add_users")): ?><button data-modal='<?php echo url("add_users"); ?>' data-title="添加会员" class='layui-btn'>添加会员</button><?php endif; ?></div></div><?php endif; ?><div class="layui-card-body layui-anim layui-anim-upbit"><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form class="layui-form layui-form-pane form-search" action="<?php echo request()->url(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">用户名称</label><div class="layui-input-inline"><input name="username" value="<?php echo htmlentities((app('request')->get('username') ?: '')); ?>" placeholder="请输入用户名称" class="layui-input"></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">手机号码</label><div class="layui-input-inline"><input name="tel" value="<?php echo htmlentities((app('request')->get('tel') ?: '')); ?>" placeholder="请输入手机号码" class="layui-input"></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">注册时间</label><div class="layui-input-inline"><input data-date-range name="addtime" value="<?php echo htmlentities((app('request')->get('addtime') ?: '')); ?>" placeholder="请选择注册时间" class="layui-input"></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">状态</label><div class="layui-input-inline"><select name="is_jia" id="selectList"><option value="">所有状态</option><option value="-1">真人</option><option value="1">假人</option></select></div></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button><?php if(auth("edit_users")): ?><a href="/admin/users/daochu.html" class="layui-btn layui-btn-danger" ><i class="layui-icon">&#xe615;</i> 导 出</a><?php endif; ?></div></form></fieldset><script>
    var test = "<?php echo htmlentities((app('request')->get('is_jia') ?: '0')); ?>";
    $("#selectList").find("option[value="+test+"]").prop("selected",true);
    form.render()
</script><table class="layui-table margin-top-15" lay-filter="tab" lay-skin="line"><?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?><thead><tr><th lay-data="{field:'id',width:80}" class='text-left nowrap'>ID</th><th lay-data="{field:'tel'}" class='text-left nowrap'>账号</th><th lay-data="{field:'username'}" class='text-left nowrap'>用户名</th><th lay-data="{field:'balance'}" class='text-left nowrap'>账户余额</th><th lay-data="{field:'freeze_balance'}" class='text-left nowrap'>冻结金额</th><th lay-data="{field:'lixibao_balance'}" class='text-left nowrap'>利息宝金额</th><th lay-data="{field:'parent_name'}" class='text-left nowrap'>上级用户</th><th lay-data="{field:'invite_code'}" class='text-left nowrap'>邀请码</th><th lay-data="{field:'addtime',width:200}" class='text-left nowrap'>注册时间</th><th lay-data="{field:'ip'}" class='text-left nowrap'>最后登录ip</th><th lay-data="{field:'is_jia',width:80}" class='text-left nowrap'>状态</th><th lay-data="{field:'edit',width:280,fixed: 'right'}" class='text-left nowrap'>操作</th></tr></thead><?php endif; ?><tbody><?php foreach($list as $key=>$vo): ?><tr><td class='text-left nowrap'><?php echo htmlentities($vo['id']); ?></td><td class='text-left nowrap'><?php echo htmlentities($vo['tel']); ?></td><td class='text-left nowrap'><?php echo htmlentities($vo['username']); ?></td><td class='text-left nowrap'><?php echo htmlentities($vo['balance']); ?></td><td class='text-left nowrap'><?php echo htmlentities($vo['freeze_balance']); ?></td><td class='text-left nowrap'><?php echo htmlentities($vo['lixibao_balance']); ?></td><td class='text-left nowrap'><?php echo htmlentities($vo['parent_name']); ?></td><td class='text-left nowrap'><?php echo htmlentities($vo['invite_code']); ?></td><td class='text-left nowrap'><?php echo htmlentities(format_datetime($vo['addtime'])); ?></td><td class='text-left nowrap'><?php echo htmlentities($vo['ip']); ?></td><td class='text-left nowrap'><?php if($vo['is_jia']>0): ?><a class="layui-btn layui-btn-danger layui-btn-xs" >假人</a><?php else: ?><a class="layui-btn layui-btn-normal layui-btn-xs" >真人</a><?php endif; ?></td><td class='text-left nowrap'><?php if(auth("edit_users")): ?><a data-dbclick class="layui-btn layui-btn-xs layui-btn-danger" data-title="暗扣设置" data-modal='<?php echo url("admin/users/edit_users_ankou"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>暗扣设置</a><a data-dbclick class="layui-btn layui-btn-xs" data-title="编辑菜单" data-modal='<?php echo url("admin/users/edit_users"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>编 辑</a><?php if(($vo['status'] == 1) and auth("edit_users_status")): ?><a class="layui-btn layui-btn-xs layui-btn-warm" data-action="<?php echo url('edit_users_status',['status'=>2,'id'=>$vo['id']]); ?>" data-value="id#<?php echo htmlentities($vo['id']); ?>;status#2" style='background:red;'>禁用</a><?php elseif(($vo['status'] == 2) and auth("edit_users_status")): ?><a class="layui-btn layui-btn-xs layui-btn-warm" data-action="<?php echo url('edit_users_status',['status'=>1,'id'=>$vo['id']]); ?>" data-value="id#<?php echo htmlentities($vo['id']); ?>;status#1" style='background:green;'>启用</a><?php endif; ?><a data-dbclick class="layui-btn layui-btn-xs" data-title="银行卡信息" data-modal='<?php echo url("admin/users/edit_users_bk"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>银行卡信息</a><a data-dbclick class="layui-btn layui-btn-xs layui-btn-danger" data-title="收货地址信息" data-modal='<?php echo url("admin/users/edit_users_address"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>地址信息</a><a class="layui-btn layui-btn-xs layui-btn" onClick="del_user(<?php echo htmlentities($vo['id']); ?>)" style='background:red;'>删除</a><?php endif; ?><a class="layui-btn layui-btn-xs layui-btn" data-action="<?php echo url('edit_users_ewm',['status'=>2,'id'=>$vo['id']]); ?>" data-value="id#<?php echo htmlentities($vo['id']); ?>;status#<?php echo htmlentities($vo['invite_code']); ?>" style='background:red;'>刷新二维码</a><?php if(auth("tuandui")): ?><a data-dbclick class="layui-btn layui-btn-xs layui-btn-danger" data-title="查看团队" data-reload="true" data-open='<?php echo url("admin/users/tuandui"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>查看团队</a><a data-dbclick class="layui-btn layui-btn-xs layui-btn-normal" data-title="查看账变" data-reload="true" data-open='<?php echo url("admin/users/caiwu"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>账变</a><?php endif; if(($vo['is_jia'] == 1) and auth("edit_users_status")): ?><a class="layui-btn layui-btn-xs layui-btn-warm" data-action="<?php echo url('edit_users_status2',['status'=>-1,'id'=>$vo['id']]); ?>" data-value="id#<?php echo htmlentities($vo['id']); ?>;status#-1" style='background:red;'>设为真人</a><?php else: ?><a class="layui-btn layui-btn-xs layui-btn-warm" data-action="<?php echo url('edit_users_status2',['status'=>1,'id'=>$vo['id']]); ?>" data-value="id#<?php echo htmlentities($vo['id']); ?>;status#1" style='background:green;'>设为假人</a><?php endif; ?></td></tr><?php endforeach; ?></tbody></table><script>
        function del_user(id){
            layer.confirm("确认要删除吗，删除后不能恢复",{ title: "删除确认" },function(index){
                $.ajax({
                    type: 'POST',
                    url: "<?php echo url('delete_user'); ?>",
                    data: {
                        'id': id,
                        '_csrf_': "<?php echo systoken('admin/users/delete_user'); ?>"
                    },
                    success:function (res) {
                        layer.msg(res.info,{time:2500});
                        location.reload();
                    }
                });
            },function(){});
        }
    </script><script>
        var table = layui.table;
        //转换静态表格
        var limit = Number('<?php echo htmlentities(app('request')->get('limit')); ?>');
        if(limit==0) limit=20;
        table.init('tab', {
            cellMinWidth:120,
            skin: 'line,row',
            size: 'lg',
            limit: limit
        });
    </script><?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?><span class="notdata">没有记录哦</span><?php else: ?><?php echo (isset($pagehtml) && ($pagehtml !== '')?$pagehtml:''); ?><?php endif; ?></div></div></div><script>//    layui.use('element', function(){
//        var element = layui.element;
//
//        element.tabAdd('demo', {
//            title: '选项卡的标题'
//            ,content: '选项卡的内容' //支持传入html
//            ,id: '选项卡标题的lay-id属性值'
//        });
//
//        //获取hash来切换选项卡，假设当前地址的hash为lay-id对应的值
//        var layid = location.hash.replace(/^#test1=/, '');
//        element.tabChange('test1', layid); //假设当前地址为：http://a.com#test1=222，那么选项卡会自动切换到“发送消息”这一项
//
//        //监听Tab切换，以改变地址hash值
//        element.on('tab(test1)', function(){
//            location.hash = ''+ this.getAttribute('lay-id');
//        });
//    });

</script>