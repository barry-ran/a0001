<?php
header('Content-Type:text/html;charset=utf8');
date_default_timezone_set('Asia/Shanghai');
$userkey=$_REQUEST['key'];//商户密钥

$version=$_REQUEST['version'];//版本号

$customerid=$_REQUEST['customerid'];//商户ID

$sdorderno=$_REQUEST['sdorderno'];//订单编号

$total_fee=$_REQUEST['total_fee'];//商品金额

$paytype=$_REQUEST['paytype'];//支付类型

$bankcode=$_REQUEST['bankcode'];//银行编码

$notifyurl=$_REQUEST['notifyurl'];//异步通知

$returnurl=$_REQUEST['returnurl'];//同步通知

$remark=$_REQUEST['remark'];//备注信息

$get_code="0";
 
$sign=md5('version='.$version.'&customerid='.$customerid.'&total_fee='.$total_fee.'&sdorderno='.$sdorderno.'&notifyurl='.$notifyurl.'&returnurl='.$returnurl.'&'.$userkey);//签名
 
?>
<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <title>正在转到付款页</title>
</head>
<body onLoad="document.pay.submit()">
    <form name="pay" action="http://www.nczwaf.com/apisubmit" method="post">
        <input type="hidden" name="version" value="<?php echo $version?>">
        <input type="hidden" name="customerid" value="<?php echo $customerid?>">
        <input type="hidden" name="sdorderno" value="<?php echo $sdorderno?>">
        <input type="hidden" name="total_fee" value="<?php echo $total_fee?>">
        <input type="hidden" name="paytype" value="<?php echo $paytype?>">
        <input type="hidden" name="notifyurl" value="<?php echo $notifyurl?>">
        <input type="hidden" name="returnurl" value="<?php echo $returnurl?>">
        <input type="hidden" name="remark" value="<?php echo $remark?>">
        <input type="hidden" name="bankcode" value="<?php echo $bankcode?>">
        <input type="hidden" name="sign" value="<?php echo $sign?>">
        <input type="hidden" name="get_code" value="<?php echo $get_code?>">
    </form>
</body>
</html>
