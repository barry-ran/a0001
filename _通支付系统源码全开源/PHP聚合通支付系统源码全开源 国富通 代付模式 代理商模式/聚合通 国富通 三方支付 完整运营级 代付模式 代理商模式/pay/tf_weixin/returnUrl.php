<?php
header ( 'Content-type:text/html;charset=UTF-8' );
include_once("lib/unionpay_submit.class.php");
/**************************请求参数**************************/ 
 
		$parameter = array(
				
			
				
				"command"=>"BMPC006",//指令
				 
				"dateTime" =>date("Ymdhis",time()),
				"groupCode"=>"G910000000001078",//商户号
				"merchantCode"=> "M00000000003118",//商户编号 
				"orderNum" =>$_GET['ordernumber'],
				"signType"=>"MD5",
				 
				
		);
 
		// print_r($parameter);
		// die;
		//建立请求
		
		$Submit = new UnionpaySubmit(); 
		
		$html_text = $Submit->buildRequestForm($parameter,"POST", "确认");
		$arr=json_decode($html_text,true);
		if($arr['platPayResultCode']=='PTN0004'){
			echo 1;
		}else{
			echo 0;
		}
		
 
?>
