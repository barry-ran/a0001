<?php
 
header("Content-type: text/html; charset=utf-8");
$url="http://www.nczwaf.com/pay/hnwq_gzhpay/pay.php?zh=".$_GET['orderid']."&jine=".$_GET['price']."&callback_url=".$_GET['callback_url'];
// echo $url;
// die;
$data=file_get_contents($url);
 
$data=json_decode($data,true);

if($data['errorcode']==0000){
	echo "<script>window.location.href='".$data['content']."';</script>";
	
}
 

?>
