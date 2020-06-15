
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<title>聚合通，快捷支付演示-快捷支付</title>
<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
</head>
<body>
<form method="post" action="http://pay.gzspkp.cn/fastbanksubmit" >
<table style=" width:500px; margin:auto;">
	<tr>
		<td width="100">商户ID</td>
		<td width="400"><input type="text" name="customerid" value="10000"></td>
	</tr>
	<tr>
		<td>商户密钥</td>
		<td><input type="text" name="key" value="7897062fc648ca140512b0c7bf66ff67009e1e86"></td>
	</tr>
	<tr>
		<td>支付类型</td>
		<td><input type="text" name="paytype" value="fastbank"></td>
	</tr>
	<tr>
		<td>接口编码</td>
		<td><input type="text" name="command" value="6"></td>
	</tr>
	<tr>
		<td>订单编号</td>
		<td><input type="text" name="orderNum" value="<?php echo time()+mt_rand(1000,9999);?>"></td>
	</tr>
	<tr>
		<td>用户绑卡协议号</td>
		<td><input type="text" name="contractId" value=""></td>
	</tr>
	<tr>
		<td>支付金额</td>
		<td><input type="text" name="payMoney" value="1"></td>
	</tr>
	<tr>
		<td>商品名称</td>
		<td><input type="text" name="productName" value="1"></td>
	</tr>
	<tr>
		<td>回调地址</td>
		<td><input type="text" name="notifyUrl" value="http://www.nczwaf.com/demo/fastbank/notify.php"></td>
	</tr>
	<tr>
		<td>交易币种</td>
		<td><input type="text" name="currency" value="CNY"></td>
	</tr>
	<tr>
		<td>客户 IP</td>
		<td><input type="text" name="clientIP" value="127.0.0.1"></td>
	</tr>
	<tr>
		<td>手机验证码</td>
		<td><input type="text" name="checkCode" value=""><input type="button" onclick="send();" value="获取验证码"></td>
	</tr>
	<tr>
		<td> </td>
		<td><input type="submit" name="submit" value="提交"></td>
	</tr>
 
</table>
</form>
<script>

function send(){
 
	var customerid=$("input[name='customerid']").val();
	var key=$("input[name='key']").val();
	var paytype=$("input[name='paytype']").val();
	var command=5;
	var orderNum=$("input[name='orderNum']").val();
	var contractId=$("input[name='contractId']").val();
	var payMoney=$("input[name='payMoney']").val();
	var productName=$("input[name='productName']").val();
	var notifyUrl=$("input[name='notifyUrl']").val();
	var currency=$("input[name='currency']").val();
	var clientIP=$("input[name='clientIP']").val();
	var checkCode=$("input[name='checkCode']").val();

	$.post("http://www.nczwaf.com/fastbanksubmit",{customerid:customerid,key:key,paytype:paytype,command:command,orderNum:orderNum,contractId:contractId,payMoney:payMoney,productName:productName,notifyUrl:notifyUrl,currency:currency,clientIP:clientIP,checkCode:checkCode},function(d){
		alert(d.platRespMessage);
	},"JSON");
}
</script>
</body>
</html>