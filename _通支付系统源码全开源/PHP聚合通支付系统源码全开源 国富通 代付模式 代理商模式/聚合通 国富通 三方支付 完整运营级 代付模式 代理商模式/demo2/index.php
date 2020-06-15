
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>聚合通，让支付更简单</title>
</head>
<body>
<form method="post" action="pay.php" >
<table style=" width:500px; margin:auto;">
	<tr>
		<td>版本</td>
		<td><input type="text" name="version" value="1.0"></td>
	</tr>
	<tr>
		<td width="100">商户ID</td>
		<td width="400"><input type="text" name="customerid" value="10000"></td>
	</tr>
	<tr>
		<td>商户密钥</td>
		<td><input type="text" name="key" value="7897062fc648ca140512b0c7bf66ff67009e1e86"></td>
	</tr>
	<tr>
		<td>订单编号</td>
		<td><input type="text" name="sdorderno" value="<?php echo time()+mt_rand(1000,9999);?>"></td>
	</tr>
	<tr>
		<td>商品金额</td>
		<td><input type="text" name="total_fee" value="0.10"></td>
	</tr>
	<tr>
		<td>支付类型</td>
		<td><input type="text" name="paytype" value="bank"></td>
	</tr>
	<tr>
		<td>银行编码</td>
		<td><input type="text" name="bankcode" value="ABC"></td>
	</tr>
	<tr>
		<td>异步通知</td>
		<td><input type="text" name="notifyurl" value="http://www.nczwaf.com/demo2/notify.php"></td>
	</tr>
	<tr>
		<td>同步通知</td>
		<td><input type="text" name="returnurl" value="http://www.nczwaf.com/demo2/return.php"></td>
	</tr>
	<tr>
		<td>备注信息</td>
		<td><input type="text" name="remark" value=""></td>
	</tr>
	<tr>
		<td> </td>
		<td><input type="submit" name="submit" value="提交"></td>
	</tr>
</table>
</form>
</body>
</html>