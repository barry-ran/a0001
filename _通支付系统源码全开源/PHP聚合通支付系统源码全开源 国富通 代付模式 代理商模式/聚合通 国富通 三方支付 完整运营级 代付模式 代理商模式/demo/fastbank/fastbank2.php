
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<title>聚合通，快捷支付演示-状态查询</title>
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
		<td><input type="text" name="command" value="2"></td>
	</tr>
	<tr>
		<td width="100">用户ID</td>
		<td width="400"><input type="text" name="memberId" value="10000"></td>
	</tr>
	<tr>
		<td>银行卡号</td>
		<td><input type="text" name="bankCard" value=""></td>
	</tr>
	<tr>
		<td> </td>
		<td><input type="submit" name="submit" value="提交"></td>
	</tr>
 
</table>
</form>
 
</body>
</html>