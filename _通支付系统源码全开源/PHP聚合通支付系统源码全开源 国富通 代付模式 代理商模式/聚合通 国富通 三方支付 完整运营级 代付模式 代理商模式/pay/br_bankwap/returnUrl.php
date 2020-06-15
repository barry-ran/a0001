<?php
require_once 'inc.php';
use WY\app\model\Pushorder;
		$Context1 = str_ireplace("-","+",$_POST['context']);
		$Context1 = str_ireplace("_","/",$Context1);
		$Context1 = str_ireplace("","=",$Context1);
        $data = base64_decode($Context1);
 
$arr=explode("&",$data);
foreach($arr as $v){
	$arr2='';
	$arr2=explode("=",$v);
 
	$data2[$arr2[0]]=$arr2[1];
}

$orderid=isset($data2['app_id']) ? $data2['app_id'] : '';
$push=new Pushorder($orderid);
$push->sync();
?>
