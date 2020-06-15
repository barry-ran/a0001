<?php /* Smarty version Smarty-3.0.8, created on 2020-03-30 06:43:35
         compiled from "D:\phpStudy\WWW\mxszpt_coupon/tpl\super_shop_show.html" */ ?>
<?php /*%%SmartyHeaderCode:133105e8195170a4105-23468362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31de760d7bd2f90e5b72e9e15d9f113787c21856' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\mxszpt_coupon/tpl\\super_shop_show.html',
      1 => 1585532486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133105e8195170a4105-23468362',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="blog.anchen8.net" />
	<title>链接跳转中....请稍后</title>
               <script src="js/jquery.min.js"></script>
 <script type="text/javascript">
$(document).ready(function(){
    var sVal = <?php echo $_smarty_tpl->getVariable('taobaoid')->value;?>
;
  	$.getJSON( 'https://acs.m.taobao.com/h5/mtop.taobao.detail.getdetail/6.0/?jsonp=1&data=%7B%22itemNumId%22%3A%22'+sVal+'%22%7D&callback=?' , function(res) 
					{
									var res = res;
                                    var ress = JSON.stringify(res); 
		                             $("#taobao_data").val(ress); 
                                     $("form[name='zz']").submit(); 
				    		});
  
  
});
</script>
</head>

<body style="background-image: url(images/super_taobao_pc.gif);background-repeat:no-repeat ;background-size:100% 100%;background-attachment: fixed">
<form action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'shop_shows'),$_smarty_tpl);?>
" method="POST" name="zz">
<input type="hidden" value="" name="taobao_data" id="taobao_data"/>
<input type="hidden" value="<?php echo $_smarty_tpl->getVariable('taobaoid')->value;?>
" name="taobaoid"/>
</form>
</body>
</html>