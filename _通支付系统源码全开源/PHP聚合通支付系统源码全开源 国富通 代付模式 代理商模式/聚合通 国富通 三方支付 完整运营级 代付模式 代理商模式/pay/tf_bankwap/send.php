<?php
 
header ( 'Content-type:text/html;charset=UTF-8' );
include_once("lib/unionpay_submit.class.php");
/**************************请求参数**************************/ 
 
switch ($_GET['bankcode'])
{
case "ICBC"://工商银行
  $_GET['bankcode']="01020000";
  break;  
case "CCB"://建设银行
  $_GET['bankcode']="01050000";
  break;  
case "ABC"://农业银行
  $_GET['bankcode']="01030000";
  break;  
case "CMB"://招商银行
  $_GET['bankcode']="03080000";
  break;  
case "BOCSH"://中国银行
  $_GET['bankcode']="01040000";
  break;  
case "BOCOM"://交通银行
  $_GET['bankcode']="03010000";
  break;  
case "PSBC"://中国邮政储蓄
  $_GET['bankcode']="01000000";
  break;  
case "CEB"://光大银行
  $_GET['bankcode']="03030000";
  break;  
case "GDB"://广东发展银行
  $_GET['bankcode']="03060000";
  break;  
case "CIB"://兴业银行
  $_GET['bankcode']="03090000";
  break;  
case "SPDB"://上海浦东发展银行
  $_GET['bankcode']="03100000";
  break;  
case "CMBC"://民生银行
  $_GET['bankcode']="03050000";
  break;  
case "CNCB"://中信银行
  $_GET['bankcode']="03020000";
  break;  
case "PAB"://平安银行
  $_GET['bankcode']="03070000";
  break;  
 
case "BOS"://上海银行
  $_GET['bankcode']="";
  break;  
case "SRCB"://上海农村商业银行
  $_GET['bankcode']="";
  break;  
case "HXB"://华夏银行
  $_GET['bankcode']="03040000";
  break;    
  
default:
 
}
 
		if($_GET['bankcode']==""){
			echo "银行通道关闭";
			return;
		}
		 
		$parameter = array(
				"command"=>"UNWP001",//指令
				"groupCode"=>"G910000000001078",//商户号
				"signType"=>"MD5",
				"dateTime" =>date("Ymdhis",time()),
				
				"merchantCode"=> "M00000000003118",//商户编号 
				"terminalCode"=> "T0000000004788",//终端编号 
				"orderNum" =>$_GET['orderid'],
				"payMoney" =>$_GET['price']*100,
				"productName" =>$_GET['orderid'],
				"notifyUrl"=> "http://".$_SERVER['HTTP_HOST']."/pay/tf_bankwap/notifyUrl.php",//回调URL 
				"returnUrl"=> "http://".$_SERVER['HTTP_HOST']."/pay/tf_bankwap/returnUrl.php",//成功返回URL
				"currency"=> "CNY",//币种 
				"cardType"=> '0',//卡类型 
				"bankLink"=> $_GET['bankcode'],//银联号 
 
		);
 
		ksort($parameter, SORT_NATURAL);
		// print_r($parameter);
		// die;
		//建立请求
		
		$Submit = new UnionpaySubmit(); 
		
		$html_text = $Submit->buildRequestForm($parameter,"POST", "确认");
		echo $html_text;
 

		

 

?>
 
