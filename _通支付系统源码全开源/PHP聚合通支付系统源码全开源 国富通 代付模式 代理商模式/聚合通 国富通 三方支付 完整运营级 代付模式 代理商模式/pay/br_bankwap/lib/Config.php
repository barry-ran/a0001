<?php  
	date_default_timezone_set('PRC'); 
	header('Content-Type:text/html; charset=gb2312');

   	$Syscode ="20000067";
    $Version = "002";
	$Account = '9201000486';

    $PayCode   = "100008";
	$QueryCode = "100009";
    $OutCode= "110301";

	$Key = "asdlajszpay2up";//加密密钥

	$Key3DES="AA4ED2F5DB86A1B234629FAB172976DC";
	  
    $Pay_server = "http://www.yitianmao.com/cgi-bin/gateway_pay.cgi";  
	$Query_server = "http://www.yitianmao.com/cgi-bin/gateway_pay.cgi";  

	$Out_Pay ="http://www.yitianmao.com/cgi-bin/opay_single_im.cgi";
    $Out_Query="http://www.yitianmao.com/cgi-bin/opay_single_query_im.cgi";


?>
