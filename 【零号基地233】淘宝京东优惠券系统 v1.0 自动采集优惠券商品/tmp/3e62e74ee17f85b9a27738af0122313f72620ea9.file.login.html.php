<?php /* Smarty version Smarty-3.0.8, created on 2020-03-30 06:43:54
         compiled from "D:\phpStudy\WWW\mxszpt_coupon/tpl\login.html" */ ?>
<?php /*%%SmartyHeaderCode:141755e81952aedcb05-99899892%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e62e74ee17f85b9a27738af0122313f72620ea9' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\mxszpt_coupon/tpl\\login.html',
      1 => 1584071496,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141755e81952aedcb05-99899892',
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
<link href="css/min.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link href="css/login.style.css" rel="stylesheet" type="text/css" />
<link href="iconfont/iconfont.min.css" rel="stylesheet" type="text/css" />
<title>淘宝优惠券系统-梦想瞬智网络</title>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'logingo'),$_smarty_tpl);?>
" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="admin_name" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="admin_password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input class="input-text size-L" type="text" placeholder="验证码"  style="width:150px;" name="verifycode">
          <img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'loginverifycode'),$_smarty_tpl);?>
"/> </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 淘宝优惠券系统-梦想瞬智网络 <a href="http://www.mxszpt.com" target="_blank">www.mxszpt.com</a></div>
<script type="text/javascript" src="js/jquery.min.js"></script> 
<script type="text/javascript" src="js/min.js"></script>

</body>
</html>