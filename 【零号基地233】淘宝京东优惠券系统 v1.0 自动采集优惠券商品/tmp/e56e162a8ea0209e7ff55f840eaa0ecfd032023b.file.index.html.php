<?php /* Smarty version Smarty-3.0.8, created on 2020-03-30 06:44:38
         compiled from "D:\phpStudy\WWW\mxszpt_coupon/tpl\admin/index.html" */ ?>
<?php /*%%SmartyHeaderCode:67425e819556854d09-68475931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e56e162a8ea0209e7ff55f840eaa0ecfd032023b' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\mxszpt_coupon/tpl\\admin/index.html',
      1 => 1584064860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67425e819556854d09-68475931',
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
<link rel="stylesheet" type="text/css" href="css/login.css" />
<link rel="stylesheet" type="text/css" href="css/login.style.css" />
<title>优惠券系统-梦想瞬智网络</title>

</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top"  style="background-color: #FF4A00;">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="" style="color: #fff;font-size: 16px;">淘宝优惠券系统</a>
			<span class="logo navbar-slogan f-l mr-10 hidden-xs" style="color: #fff;font-size: 16px;">v1.0</span> 
		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			<ul class="cl" style="color: #fff;font-size: 16px;">
				<li>超级管理员-admin</li>
                <li class="dropDown dropDown_hover">
					<a href="index.php" class="dropDown_A" style="color: #fff;" target="_blank">首页</a>
			</li>
				<li class="dropDown dropDown_hover">
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'logout'),$_smarty_tpl);?>
" class="dropDown_A" style="color: #fff;">退出</a>
			</li>
			</ul>
		</nav>
	</div>
</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'article_list'),$_smarty_tpl);?>
" data-title="资讯管理" href="javascript:void(0)">资讯管理</a></li>
                    	<li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'article_auto'),$_smarty_tpl);?>
" data-title="自动定时采集" href="javascript:void(0)">自动定时采集</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'user'),$_smarty_tpl);?>
" data-title="会员列表" href="javascript:;">会员列表</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'admin_list'),$_smarty_tpl);?>
" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
                    <li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'admin_add'),$_smarty_tpl);?>
" data-title="添加管理员" href="javascript:void(0)">添加管理员</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe61a;</i> 数据统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'taobaoke_data'),$_smarty_tpl);?>
" data-title="淘宝联盟EXECL数据" href="javascript:void(0)">淘宝联盟EXECL数据</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'config'),$_smarty_tpl);?>
" data-title="系统设置" href="javascript:void(0)">系统设置</a></li>
                    	<li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'ad_list'),$_smarty_tpl);?>
" data-title="轮播图设置" href="javascript:void(0)">轮播图设置</a></li>
					<li><a data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'log'),$_smarty_tpl);?>
" data-title="系统日志" href="javascript:void(0)">系统日志</a></li>
			</ul>
		</dd>
	</dl>
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="我的桌面" data-href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'welcome'),$_smarty_tpl);?>
">我的桌面</span>
					<em></em></li>
		</ul>
	</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'welcome'),$_smarty_tpl);?>
"></iframe>
	</div>
</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
</ul>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="js/jquery.min.js"></script> 
<script type="text/javascript" src="js/layer.js"></script>
<script type="text/javascript" src="js/min.js"></script>
<script type="text/javascript" src="js/admin.js"></script> 
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="js/jquery.contextmenu.r2.js"></script>

</body>
</html>