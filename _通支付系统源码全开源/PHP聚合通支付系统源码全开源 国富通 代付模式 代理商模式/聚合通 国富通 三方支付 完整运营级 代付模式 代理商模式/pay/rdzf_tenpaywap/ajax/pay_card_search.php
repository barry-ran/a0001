<?php
error_reporting(0);
header('Content-Type:text/html;charset=GB2312');
include_once("../config/pay_config.php");
include_once("../ruide/class.ruide.php");
$ruide = new ruide();
$ruide->parter 		= $ruide_merchant_id;		//�̼�Id
$ruide->key 			= $ruide_merchant_key;	//�̼���Կ

$result	= $ruide->search($_POST['order_id']);

$data = '{"success": "'.$result.'","message": "'. $ruide->message .'"}';
die($data);
?>