<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>{$page_seo.title}</title>
		<meta name="keywords" content="{$page_seo.keywords}" />
		<meta name="description" content="{$page_seo.description}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no" />
		<meta name="full-screen" content="yes">
        <meta name="x5-fullscreen" content="true">
		<link rel="stylesheet" href="__STATIC__/tqkwap/fonts/iconfont.css" />
		<link rel="stylesheet" href="__STATIC__/tqkwap/css/amazeui.min.css">
		<link rel="stylesheet" href="__STATIC__/tqkwap/css/style.css" />
	</head>
	<body class="wbg-ef">
		<!--header-->
	<header data-am-widget="header" class="am-header am-header-default am-header-fixed bar-nav">
			<form action="{:U('cate/index')}" id="so" method="get">
	    		<div class="searchtop">
	    			<span class="iconfont icon-search"></span>
				    <input type="text" value="{$k}" onblur="$('#so').submit()" name="k" placeholder="搜搜看您想要的商品优惠券">
	    		</div>
				<button type="submit" class="headsub">搜索</button>
			</form>
			<include file="public:nav" />
	</header>