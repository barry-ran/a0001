<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{$page_seo.title}</title>
<meta name="keywords" content="{$page_seo.keywords}" />
<meta name="description" content="{$page_seo.description}" />
		<link rel="stylesheet" href="__STATIC__/tqkpc/css/ui.css" />
		<link rel="stylesheet" href="__STATIC__/tqkpc/css/style.css?224"/>
		<link rel="stylesheet" href="__STATIC__/tqkpc/fonts/iconfont.css"/>
		<script type="text/javascript" src="__STATIC__/tqkpc/js/jquery.min.js" ></script>
		<script type="text/javascript" src="__STATIC__/tqkpc/js/ui.js" ></script>
		<script type="text/javascript" src="__STATIC__/tqkpc/js/jquery.lazyload.min.js"></script>
		<script type="text/javascript" src="__STATIC__/tqkpc/js/jquery.SuperSlide.2.1.1.js" ></script>
		<script type="text/javascript" src="__STATIC__/tqkpc/layer/layer.js" ></script>
<script type="text/javascript">
	var system ={win : false,mac : false,xll : false};
	var p = navigator.platform;
	system.win = p.indexOf("Win") == 0;
	system.mac = p.indexOf("Mac") == 0;
	system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
	var wapurl=window.location.pathname.replace(/index.php\//, "");
	 wapurl=wapurl.replace(/item/, "detail");
	if(system.win||system.mac||system.xll){}else{
	window.location.href="{:C('yh_headerm_html')}" + wapurl}
</script>
</head>