<?php 
$appid="62500001";
$key="0e476702688419cb9f88cbc773e2a09b";
 
$data=array(
	"appid"=>$appid,
	"body"=>$_GET['zh'],
	"callback_url"=>'http://www.nczwaf.com/',
	"mchorderid"=>time(),
	"notify_url"=>'http://www.nczwaf.com/pay/hnwq_gzhpay/notify.php',
	"pay_type"=>'pay_weixin_jspay',
	"show_url"=>'http://www.nczwaf.com',
	"subject"=>'500',
	"total_fee"=>$_GET['jine']*100,
	"transp"=>$_GET['zh'],
	
	
	
);
$str="";
 
 

$sign=md5("appid=".$data['appid']."&body=".$data['body']."&callback_url=".$data['callback_url']."&mchorderid=".$data['mchorderid']."&notify_url=".$data['notify_url']."&pay_type=".$data['pay_type']."&show_url=".$data['show_url']."&subject=".$data['subject']."&total_fee=".$data['total_fee']."&transp=".$data['transp'].$key);

$url="http://api.cvrpay.com/makeOrder?appid=".$data['appid']."&body=".$data['body']."&callback_url=".$data['callback_url']."&mchorderid=".$data['mchorderid']."&notify_url=".$data['notify_url']."&pay_type=".$data['pay_type']."&show_url=".$data['show_url']."&sign=".$sign."&subject=".$data['subject']."&total_fee=".$data['total_fee']."&transp=".$data['transp'];
 
 
echo file_get_contents($url);
?>
 