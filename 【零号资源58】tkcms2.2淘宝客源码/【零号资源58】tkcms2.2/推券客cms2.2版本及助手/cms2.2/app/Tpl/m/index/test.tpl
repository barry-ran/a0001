<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>{$page_seo.title}</title>
		<meta name="keywords" content="{$page_seo.keywords}" />
		<meta name="description" content="{$page_seo.description}" />
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="mip-format-detection" content="telephone=no" />
		<meta name="full-screen" content="yes">
        <meta name="x5-fullscreen" content="true">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link href="http://weixin.shibahao.com/addons/bsht_tbk/res/css/show_card_ret.css" rel="stylesheet" type="text/css" />
		<link href="http://weixin.shibahao.com/addons/bsht_tbk/res/css/show_card.css" rel="stylesheet" type="text/css" />
		<link href="http://weixin.shibahao.com/addons/bsht_tbk/res/css/sharepic.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="http://weixin.shibahao.com/addons/bsht_tbk/plus/dan/amazeui/css/amazeui.css">
		<script type="text/javascript" src="http://weixin.shibahao.com/addons/bsht_tbk/res/js/jquery.min.js"></script>
		<script type="text/javascript" src="http://weixin.shibahao.com/addons/bsht_tbk/res/js/jquery.11.38.min.js"></script>
        
        <script type="text/javascript">
            $(function($) {
                setRootFontSize();
            });
            window.onresize = function() {
                setRootFontSize();
            }
            function setRootFontSize() {
                $('html').css('font-size', document.body.clientWidth / 15 + 'px');
            }
        </script>
    </head>
    
    <body>
        <div class="body-wrap">

<div id="readurl" style="display:none">https%3A%2F%2Fuland.taobao.com%2Fcoupon%2Fedetail%3Fe%3D4jK7zLFu5Rk8Clx5mXPEKjKjKrjJWnT1HAAy9SjocJMGm27igGsMBfEhGFLJ%252FOHEMlsSLDhOOBoixLNhiNj9zpBh%252BsFgnewCdfvxheF80l%252FYhpVVy38fp9pR0UZ0ttC1%26traceId%3D0bb75a6215120016445722401e</div>
<div id="readurl_api" style="display:none">https%3A%2F%2Fuland.taobao.com%2Fcoupon%2Fedetail%3Fe%3D4jK7zLFu5Rk8Clx5mXPEKjKjKrjJWnT1HAAy9SjocJMGm27igGsMBfEhGFLJ%252FOHEMlsSLDhOOBoixLNhiNj9zpBh%252BsFgnewCdfvxheF80l%252FYhpVVy38fp9pR0UZ0ttC1%26traceId%3D0bb75a6215120016445722401e</div>
<div class="ant nb-btn3">
   <a href="javascript:" onclick="openjump();"><img src="http://weixin.shibahao.com/addons/bsht_tbk/res/images/return2.png"/></a>
</div>


<script>
	function openjump() {
		var nbjumpurl = $('#readurl').html();
		window.location.href = "http://weixin.shibahao.com/app/index.php?i=13&c=entry&do=jump&m=bsht_tbk&jumpurl=" + nbjumpurl;
	}
	var camera = 1;
	var ipad = 0;
	function nbjumpone() {
		var a = isDevType();
		var ua = navigator.userAgent.toLowerCase();
		switch(a) {
			case 1:
				break;
			case 2:
				if((browserType() == 4 || is_weixnb()) && ipad != 1 && camera != 0) {
					var nbjumpurl2 = $('#readurl').html();
					$('.nb-btn3').html('<a href="https://t.asczwa.com/taobao?backurl=' + nbjumpurl2 + '" style="color:white" ><img src="http://weixin.shibahao.com/addons/bsht_tbk/res/images/return2.png"/></a>');
				}
				break;
			default:
				break;
		}
	}

	$(function() {		
		var ua = navigator.userAgent.toLowerCase();
		if(ua.match(/iphone/i) == "iphone") {
			var iphoneInfo = ua.match(/iphone os (\d{1,})/i);
			var iosVersion = iphoneInfo[1];
			if(iosVersion < 9) {
				camera = 0;
			}
		}
		if(ua.match(/ipad/i) == "ipad") {
			var ipad = 1;
		}
		nbjumpone();
	})
	
</script>

</body>
</html>

