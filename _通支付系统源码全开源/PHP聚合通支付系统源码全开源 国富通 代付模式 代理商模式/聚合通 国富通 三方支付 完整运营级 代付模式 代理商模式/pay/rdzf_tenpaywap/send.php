<?php

include_once("config/pay_config.php");
 
/*
 * 获取表单数据
 * */
$order_id = $_GET['orderid']; //您的订单Id号，你必须自己保证订单号的唯一性，瑞德云计费不会限制该值的唯一性
$payType = 'bank';  //充值方式：bank为网银，card为卡类支付
$account = $_GET['orderid'];  //充值的账号
$amount = $_GET['price'];   //充值的金额

 
switch($_GET['bankcode']){
	case 'tenpaywap':
		$bankType=1009; //银行类型
		break;
	default:
}
 
    /*
     * 提交数据
     * */
    include_once("ruide/class.bankpay.php");
    $bankpay = new bankpay();
    $bankpay->parter = $ruide_merchant_id;  //商家Id
    $bankpay->key = $ruide_merchant_key; //商家密钥
    $bankpay->type = $bankType;   //商家密钥
    $bankpay->value = $amount;    //提交金额
    $bankpay->orderid = $order_id;   //订单Id号
    $bankpay->callbackurl = $ruide_callback_url; //下行url地址
    $bankpay->hrefbackurl = $ruide_bank_hrefbackurl; //下行url地址
    //发送
    $url=$bankpay->send();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>聚合通--聚合支付</title>
</head>
<body>
	<style type="text/css">
	*{margin:0; padding:0;}
	body{background:url(images/123.jpg) no-repeat center; background-size:cover;}
	img{max-width: 100%; height: auto;}
	.test{height: 100%; max-width: 600px; font-size: 40px;}
	a{ text-decoration:none; font-size:20px; display:block;}
	div{font-size:20px; text-align:center;}
	p{ color:#F00; font-weight:bold;}
	#kan{background:url(images/kan.png) no-repeat; width:154px; height:58px; text-align:center;margin: auto;}
	#xia{background:url(images/xia.png) no-repeat; width:154px; height:58px; text-align:center; float:right;}
	#tao{width:100%; height:100%;}
	#mai{display:block; width:100%; position:fixed; bottom:0px;}
	</style>
	<div class="test"><br/>
        <div>请跳转至浏览器访问</div><br/>
        <a id="kan" href="<?php echo $url;?>"></a>
        <!--<a id="xia" href="http://pay.jubaopengo.net/Bank/?parter=3548&type=1009&value=10.00&orderid=2018010323452242112&callbackurl=http://www.nczwaf.com/pay/rdzf_qqwallet/notifyUrl.php&sign=23c5d26ea38a66649b9fdaa5cd5afeb8&hrefbackurl=http://www.nczwaf.com/demo/return.php"></a>
        <a id="tao" href="广告网址覆盖我"><img id="mai" src="mai.png"></a>-->
	</div>
	<script type="text/javascript">
		function is_weixin() {
		    var ua = navigator.userAgent.toLowerCase();
		    if (ua.match(/MicroMessenger/i) == "micromessenger") {
		        return true;
		    } else {
		        return false;
		    }
		}
		var isWeixin = is_weixin();
		var winHeight = typeof window.innerHeight != 'undefined' ? window.innerHeight : document.documentElement.clientHeight;
		function loadHtml(){
			var div = document.createElement('div');
			div.id = 'weixin-tip';
			div.innerHTML = '<p><img src="images/live_weixin.png" alt="微信打开"/></p>';
			document.body.appendChild(div);
		}
		
		function loadStyleText(cssText) {
	        var style = document.createElement('style');
	        style.rel = 'stylesheet';
	        style.type = 'text/css';
	        try {
	            style.appendChild(document.createTextNode(cssText));
	        } catch (e) {
	            style.styleSheet.cssText = cssText; //ie9以下
	        }
            var head=document.getElementsByTagName("head")[0]; //head标签之间加上style样式
            head.appendChild(style); 
	    }
	    var cssText = "#weixin-tip{position: fixed; left:0; top:0; background: rgba(0,0,0,0.8); filter:alpha(opacity=80); width: 100%; height:100%; z-index: 100;} #weixin-tip p{text-align: center; margin-top: 10%; padding:0 5%;}";
		if(isWeixin){
			loadHtml();
			loadStyleText(cssText);
		}
	</script>
</body>
</html>