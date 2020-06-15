<?php /* Smarty version Smarty-3.0.8, created on 2020-03-30 06:44:47
         compiled from "D:\phpStudy\WWW\mxszpt_coupon/tpl\admin/article_list.html" */ ?>
<?php /*%%SmartyHeaderCode:81325e81955f69b681-34778388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b197ee61d7bf0bc621f398bf8b8f4b50c3df0b61' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\mxszpt_coupon/tpl\\admin/article_list.html',
      1 => 1583481561,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81325e81955f69b681-34778388',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="images/favicon.ico" >
<link rel="Shortcut Icon" href="images/favicon.ico" />

<link rel="stylesheet" type="text/css" href="css/min.css" />
<link rel="stylesheet" type="text/css" href="css/admin.css" />
<link rel="stylesheet" type="text/css" href="iconfont/iconfont.min.css" />
<link rel="stylesheet" type="text/css" href="css/skin.css" />
<link rel="stylesheet" type="text/css" href="css/login.style.css" />
<title>资讯列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'article_del_all'),$_smarty_tpl);?>
"  class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
     <a class="btn btn-primary radius" data-title="添加文章" data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'article_add'),$_smarty_tpl);?>
" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加文章</a></span></div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>标题</th>
                    <th width="100">来源</th>
					<th width="120">发布时间</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
            <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('all')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
				<tr class="text-c">
					<td><input type="checkbox" value="" name=""></td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['ma_id'];?>
</td>
					<td class="text-l"><?php echo $_smarty_tpl->tpl_vars['value']->value['ma_name'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['value']->value['ma_taobaoid']!=null){?>自动采集<?php }else{ ?><span style="color: red;">人工</span><?php }?></td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['ma_time'];?>
</td>
					<td class="f-14 td-manage">
                    <a style="text-decoration:none" class="ml-5" data-title="修改文章" data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'article_edit','ma_id'=>$_smarty_tpl->tpl_vars['value']->value['ma_id']),$_smarty_tpl);?>
" onclick="Hui_admin_tab(this)" href="javascript:;"  title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
                    <a style="text-decoration:none"  href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'article_del','ma_id'=>$_smarty_tpl->tpl_vars['value']->value['ma_id']),$_smarty_tpl);?>
" title="删除"  onClick="return confirm('谨慎！！确定删除?');"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
<?php }} ?>
			</tbody>
		</table>
        
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="js/jquery.min.js"></script> 
<script type="text/javascript" src="js/layer.js"></script>
<script type="text/javascript" src="js/min.js"></script>
<script type="text/javascript" src="js/admin.js"></script> 
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->

</body>
</html>