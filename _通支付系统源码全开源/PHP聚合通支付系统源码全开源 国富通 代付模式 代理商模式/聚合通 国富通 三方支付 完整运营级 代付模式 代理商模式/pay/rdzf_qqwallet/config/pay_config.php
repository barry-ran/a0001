<?php
//=======================卡类支付和网银支付公用配置==================
//瑞德云计费商户ID
$ruide_merchant_id		= '3548';

//瑞德云计费通信密钥
$ruide_merchant_key		= '449a982c3add4b7aac58c8159ff9930c';	//hc6NOTDETVQe9Lgr

 

//======================网银支付配置=================================
//接收瑞德云计费网银支付接口的地址
$ruide_callback_url	= "http://".$_SERVER['HTTP_HOST']."/pay/rdzf_qqwallet/notifyUrl.php";


//网银支付跳转回的页面地址
$ruide_bank_hrefbackurl	= $_GET['returnUrl'];


?>