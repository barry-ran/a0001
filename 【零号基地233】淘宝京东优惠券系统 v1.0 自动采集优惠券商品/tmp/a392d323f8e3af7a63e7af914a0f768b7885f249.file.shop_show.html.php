<?php /* Smarty version Smarty-3.0.8, created on 2020-03-30 06:43:38
         compiled from "D:\phpStudy\WWW\mxszpt_coupon/tpl\shop_show.html" */ ?>
<?php /*%%SmartyHeaderCode:45635e81951a816503-61643935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a392d323f8e3af7a63e7af914a0f768b7885f249' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\mxszpt_coupon/tpl\\shop_show.html',
      1 => 1585212385,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45635e81951a816503-61643935',
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
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="images/favicon.ico" >
<link rel="Shortcut Icon" href="images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/min.css" />
<link rel="stylesheet" type="text/css" href="iconfont/iconfont.min.css" />

 
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="js/jquery.SuperSlide.min.js"></script> 
<script type="text/javascript" src="js/admin.js"></script> 
<script type="text/javascript" src="js/layer.js"></script> 
<script type="text/javascript" src="js/min.js"></script>
 
<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('arrays_row')->value['desc'];?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->getVariable('config')->value['config_description'];?>
" /> 
<title><?php echo $_smarty_tpl->getVariable('arrays_row')->value['title'];?>
-<?php echo $_smarty_tpl->getVariable('config')->value['config_name'];?>
</title>
<style>
body{margin: 0;padding: 0;border: 0;}
a:hover{color: #000;}
.dh{display: inline;}
.dh a{padding: 7px 20px 0;color: #fff;font-size: 16px;line-height: 36px;}
.dh a:hover{color:yellow;}
.small_dh{display: inline;float: left;width: 50%;height: 42px;text-align: center;border-bottom: 1px dashed #e2e2e2;}
.small_dh a{font-size: 14px;color: #000;height: 45px;line-height: 40px;text-align: center;}
.small_dh a:hover{color:red;}
.biaoqian{background: #f5f5f5;border-radius: 12px;border: 1px solid #ddd;padding: 3px 8px;margin: 0 10px 10px 0;}
</style>

<script>
function fenxiang(title,url,w,h){
	layer_show(title,url,w,h);
}
</script> 
</head>
<body>
<?php $_template = new Smarty_Internal_Template("top.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?> 
                
                <div class="container-full">
                 <div class="container" style="padding-top: 10px;background-color: #F6F6F6;height: 25px;padding: 20px 10px;">
                 您的位置：<a href="index.php">淘宝优惠券</a>  >   <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'shop_tiaozhuan','taobaoid'=>$_smarty_tpl->getVariable('arrays_row')->value['goodsId']),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('arrays_row')->value['title'];?>
</a>
                </div>
        </div>
        
        
        	<div class="container-full">
                 <div class="container" style="padding-top: 10px;">
                    <div class="col-sm-1"></div>
                      <div class="col-sm-10" style="padding:0px">
                                     <div class="row">
                                            <div class="col-sm-4"><img src="<?php echo $_smarty_tpl->getVariable('arrays_row')->value['mainPic'];?>
" style="width: 90%;margin: auto;border-radius: 10px;"/></div>
                                            <div class="col-sm-8">
                                                     <h3><?php echo $_smarty_tpl->getVariable('arrays_row')->value['title'];?>
</h3> 
                                                     <p><span style="color: #ff464e;margin-left: 22px;">券后价￥</span><span style="font-size: 50px;color: #ff464e;"><?php echo $_smarty_tpl->getVariable('arrays_row')->value['actualPrice'];?>
</span>
                                                     <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'shop_tiaozhuan','taobaoid'=>$_smarty_tpl->getVariable('arrays_row')->value['goodsId']),$_smarty_tpl);?>
" target="_blank"><span style="background: #FF464E;color: #fff;line-height: 40px;text-align: center;padding: 6px 50px;margin-top: 13px;margin-left: 16px;border-left: 2px dashed #fff;border-right: 2px dashed #fff;font-size: 18px;float: right;">
                                                          领券下单可省 <b style="color: #00FF7F;"><?php echo $_smarty_tpl->getVariable('arrays_row')->value['couponPrice'];?>
</b> 元 
                                                            </span></a>
                                                     </p>
                                                     <p style="color: #4169E1;line-height: 20px;padding-bottom: 20px;">淘宝推荐文案：<?php echo $_smarty_tpl->getVariable('arrays_row')->value['desc'];?>
</p>
                                                     <p style="border-top: 1px solid #ececec;padding: 15px 0 10px;margin: 0px 0 10px;font-size: 12px;">商品标签：
                                                     <?php if ($_smarty_tpl->getVariable('arrays_row')->value['activityType']=='3'){?><span class="biaoqian">聚划算</span><?php }else{ ?><?php }?>
                                                       <?php if ($_smarty_tpl->getVariable('arrays_row')->value['shopType']=='1'){?><span class="biaoqian">天猫</span><?php }else{ ?><?php }?>
                                                         <?php if ($_smarty_tpl->getVariable('arrays_row')->value['goldSellers']=='1'){?><span class="biaoqian">金牌卖家</span><?php }else{ ?><?php }?>
                                                         <?php if ($_smarty_tpl->getVariable('arrays_row')->value['yunfeixian']=='1'){?><span class="biaoqian">送运险费</span><?php }else{ ?><?php }?>
                                                     </p>
                                                      <p style="font-size: 14px;font-family: 宋体;color: #bbbbbb;margin-bottom: 25px;">原价：<?php echo $_smarty_tpl->getVariable('arrays_row')->value['originalPrice'];?>
元&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->getVariable('arrays_row')->value['discounts'];?>
折&nbsp;&nbsp;&nbsp;&nbsp;优惠券到期时间：<?php echo $_smarty_tpl->getVariable('arrays_row')->value['couponEndTime'];?>
</p>
                                                      <p ><a class="btn btn-danger radius size-XL" style="font-size: 30px;" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'shop_tiaozhuan','taobaoid'=>$_smarty_tpl->getVariable('arrays_row')->value['goodsId']),$_smarty_tpl);?>
" target="_blank">领券购买</a>&nbsp;&nbsp;<a href="javascript:;" onclick="fenxiang('分享朋友','<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'fenxiang','taobaoid'=>$_smarty_tpl->getVariable('arrays_row')->value['goodsId']),$_smarty_tpl);?>
','800','600')" class="btn btn-danger radius size-XL" style="font-size: 30px;"><i class="Hui-iconfont">&#xe6ab;</i> 分享朋友</a></p>
                                                        </div>      
                                                </div>      
                                </div>
                      <div class="col-sm-1"></div>
                 </div>  
        </div>
        
        	<div class="row" style="float: left;width: 100%;">
                            <div class="col-sm-2"></div>
                      <div class="col-sm-8" style="padding:0px;border-top: 2px solid #6db110;margin-top: 10px;">
                                 <p style="padding: 10px;background-color: #F6F6F6;font-size: 24px;">商品图文详情（加载完毕，请您查阅）</span></p>    
    <p class="col-sm-12">
       <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('information')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>    
              <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['value']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['v']->key;
?>     
		<div style="text-align: left;line-height: 25px;" class="col-sm-4"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
:&nbsp;<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</div>
         <?php }} ?>
         <?php }} ?>
    </p> 
        <p class="col-sm-12 hui-tags" style="margin-top: 10px;">
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pinglun')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>    
    <?php if ($_smarty_tpl->tpl_vars['value']->value['type']=='1'){?>
		<button type="button" class="btn btn-danger size-S radius" style="margin: 2px 5px 2px 5px;font-size: 12px;"><?php echo $_smarty_tpl->tpl_vars['value']->value['word'];?>
(<?php echo $_smarty_tpl->tpl_vars['value']->value['count'];?>
)</button>
        <?php }else{ ?>
        <button type="button" class="btn btn-default size-S radius" style="margin: 2px 5px 2px 5px;font-size: 12px;"><?php echo $_smarty_tpl->tpl_vars['value']->value['word'];?>
(<?php echo $_smarty_tpl->tpl_vars['value']->value['count'];?>
)</button>
        <?php }?>
	 <?php }} ?>
    </p>
                                 <p>
                                  <?php if ($_smarty_tpl->getVariable('xiangqinsss')->value!=null){?>
                      <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('xiangqinsss')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
                       <img src="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" style="width: 100%;"/>
                         <?php }} ?>
                   <?php }else{ ?>
                       <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('content')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
                       <img src="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" style="width: 100%;"/>
                         <?php }} ?>
                   <?php }?>         
                                            </p>
                                            
                 <iframe runat="server" src="<?php echo $_smarty_tpl->getVariable('askall_url')->value;?>
" width="100%" height="600" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" ></iframe>
                 
                                 <p style="padding-top: 10px;text-align: right;line-height: 50px;height:50px;"><span style="font-size: 30px;color: #ff464e;margin-right: 10px;"><?php echo $_smarty_tpl->getVariable('arrays_row')->value['actualPrice'];?>
</span>&nbsp;<a class="btn btn-danger radius size-XL" style="font-size: 30px;margin-top: -20px;" href="<?php echo $_smarty_tpl->getVariable('arrays_row')->value['couponLink'];?>
" target="_blank">领券购买</a></p>
                                     </div>
                      <div class="col-sm-2"></div>
               </div>
    
  
    <?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>    
     

</body>
</html>