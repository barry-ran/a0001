<?php /* Smarty version Smarty-3.0.8, created on 2020-03-30 06:44:39
         compiled from "D:\phpStudy\WWW\mxszpt_coupon/tpl\admin/welcome.html" */ ?>
<?php /*%%SmartyHeaderCode:68715e819557a2d788-61058927%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f922af39ce2d038bc5671c6d9c0e0b0582725f0e' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\mxszpt_coupon/tpl\\admin/welcome.html',
      1 => 1583462968,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68715e819557a2d788-61058927',
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
<link rel="stylesheet" type="text/css" href="css/min.css" />
<link rel="stylesheet" type="text/css" href="css/admin.css" />
<link rel="stylesheet" type="text/css" href="iconfont/iconfont.min.css" />
<link rel="stylesheet" type="text/css" href="css/login.style.css" />
<title>我的桌面</title>
</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">梦想瞬智网络&nbsp;&nbsp;<a href="http://www.mxszpt.com" target="_blank"><span class="f-14">www.mxszpt.com</span></a></p>
	<p>登录次数：<?php echo $_smarty_tpl->getVariable('count')->value;?>
 </p>
	<p>上次登录IP：<?php echo $_smarty_tpl->getVariable('last_ip')->value;?>
  上次登录时间：<?php echo $_smarty_tpl->getVariable('last_time')->value;?>
</p>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">服务器信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th width="30%">服务器计算机名</th>
				<td><span id="lbServerName">http://127.0.0.1/</span></td>
			</tr>
			<tr>
				<td>服务器IP地址</td>
				<td>192.168.1.1</td>
			</tr>
			<tr>
				<td>服务器域名</td>
				<td>www.h-ui.net</td>
			</tr>
			<tr>
				<td>服务器端口 </td>
				<td>80</td>
			</tr>
			<tr>
				<td>服务器IIS版本 </td>
				<td>Microsoft-IIS/6.0</td>
			</tr>
			<tr>
				<td>本文件所在文件夹 </td>
				<td>D:\WebSite\HanXiPuTai.com\XinYiCMS.Web\</td>
			</tr>
			<tr>
				<td>服务器操作系统 </td>
				<td>Microsoft Windows NT 5.2.3790 Service Pack 2</td>
			</tr>
			<tr>
				<td>系统所在文件夹 </td>
				<td>C:\WINDOWS\system32</td>
			</tr>
			<tr>
				<td>服务器脚本超时时间 </td>
				<td>30000秒</td>
			</tr>
			<tr>
				<td>服务器的语言种类 </td>
				<td>Chinese (People's Republic of China)</td>
			</tr>
			<tr>
				<td>.NET Framework 版本 </td>
				<td>2.050727.3655</td>
			</tr>
			<tr>
				<td>服务器当前时间 </td>
				<td>2014-6-14 12:06:23</td>
			</tr>
			<tr>
				<td>服务器IE版本 </td>
				<td>6.0000</td>
			</tr>
			<tr>
				<td>服务器上次启动到现在已运行 </td>
				<td>7210分钟</td>
			</tr>
		</tbody>
	</table>
</div>
<footer class="footer mt-20">
	<div class="container">
		<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
			Copyright &copy;2015-2017 H-ui.admin v3.1 All Rights Reserved.<br>
			本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
	</div>
</footer>
<script type="text/javascript" src="js/jquery.min.js"></script> 
<script type="text/javascript" src="js/min.js"></script>

</body>
</html>