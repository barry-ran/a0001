<?php
 
header ( 'Content-type:text/html;charset=UTF-8' );
include_once("lib/unionpay_submit.class.php");
/**************************请求参数**************************/ 
		$merchantCode="M00000000003118";//商户编号
		$groupCode="G910000000001078";//商户号
		$terminalCode="T0000000004788";//终端编号
		
		$command=$_GET['command'];//指令
		$memberId=$_GET['memberId'];//用户ID
		$bankCard=$_GET['bankCard'];//银行卡号
		$orderNum=$_GET['orderNum'];//订单号
		$idType=$_GET['idType'];//证件类型
		$idNo=$_GET['idNo'];//证件编号
		$accountName=$_GET['accountName'];//姓名
		$phone=$_GET['phone'];//预留手机号
		$bankCard=$_GET['bankCard'];//银行卡号
		$cardType=$_GET['cardType'];//卡类型
		$expireDate=$_GET['expireDate'];//4位定长2015年7月为0715
		$cvn2=$_GET['cvn2'];//银行卡cvn2
		$contractId=$_GET['contractId'];//用户绑卡协议号
		$productName=$_GET['productName'];//商品名称
		$notifyUrl=$_GET['notifyUrl'];//异步回调URL
		$currency=$_GET['currency'];//币种
		$clientIP=$_GET['clientIP'];//客户IP
		$payMoney=$_GET['payMoney']*100;//商品价格
		$checkCode=$_GET['checkCode'];//验证码
		
		// if($_GET['bankcode']==""){
			// echo "银行通道关闭";
			// return;
		// }
		
		
				
				if($command=='GWQP001'){
					//绑卡
					$parameter = array(
						"command"=>$command,//指令
						"groupCode"=>$groupCode,//商户号
						"signType"=>"MD5",
						"dateTime" =>date("Ymdhis",time()),
						
						"merchantCode"=> $merchantCode,//商户编号 
						"orderNum" =>$orderNum,//订单号
						"memberId"=> $memberId,//用户ID
						"idType"=> $idType,//证件类型
						"idNo"=> $idNo,//证件编号
						"accountName"=> $accountName,//姓名
						"phone"=> $phone,//预留手机号
						"bankCard"=> $bankCard,//银行卡号
						"cardType"=> $cardType,//卡类型
						"expireDate"=> $expireDate,//4位定长2015年7月为0715
						"cvn2"=> $cvn2,//银行卡cvn2
					);
					
				}
				
				
				
				if($command=='GWQP002'){
					//查卡
					$parameter = array(
						"command"=>$command,//指令
						"groupCode"=>$groupCode,//商户号
						"signType"=>"MD5",
						"dateTime" =>date("Ymdhis",time()),
						
						 "merchantCode"=> $merchantCode,//商户编号 
						 "memberId"=> $memberId,//用户ID
						 "bankCard"=> $bankCard,//银行卡号
					 );
				}
				
				if($command=='GWQP003'){
					//异步通知
					$parameter = array(
						"command"=>$command,//指令
						"groupCode"=>$groupCode,//商户号
						"signType"=>"MD5",
						"dateTime" =>date("Ymdhis",time()),
						
					);
				}
				
				if($command=='GWQP005'){
					//验证码
					$parameter = array(
						"command"=>$command,//指令
						"groupCode"=>$groupCode,//商户号
						"signType"=>"MD5",
						"dateTime" =>date("Ymdhis",time()),
						
						"merchantCode"=> $merchantCode,//商户编号 
						"terminalCode"=> $terminalCode,//终端编号 
						"orderNum" =>$orderNum,//订单号
						"contractId"=> $contractId,//用户绑卡协议号
						"payMoney" =>$payMoney,//商品价格
						"productName" =>$productName,//商品名称
						"notifyUrl"=> "http://".$_SERVER['HTTP_HOST']."/pay/tf_fastbank/notifyUrl.php",//回调URL 
						"currency"=> $currency,//币种 
						"clientIP"=> $clientIP,//客户IP 
 
					);
					
				}
				if($command=='GWQP006'){
					//快捷支付
					$parameter = array(
						"command"=>$command,//指令
						"groupCode"=>$groupCode,//商户号
						"signType"=>"MD5",
						"dateTime" =>date("Ymdhis",time()),
						
						"merchantCode"=> $merchantCode,//商户编号 
						"terminalCode"=> $terminalCode,//终端编号 
						"checkCode"=> $checkCode,//验证码 
						"orderNum" =>$orderNum,//订单号
						"contractId"=> $contractId,//用户绑卡协议号
						"payMoney" =>$payMoney,//商品价格
						"productName" =>$productName,//商品名称
						"notifyUrl"=> "http://".$_SERVER['HTTP_HOST']."/pay/tf_fastbank/notifyUrl.php",//回调URL 
						"currency"=> $currency,//币种 
						"clientIP"=> $clientIP,//客户IP 
 
					);
					
				}
				
				if($command=='GWQP007'){
					//订单查询
					$parameter = array(
						"command"=>$command,//指令
						"groupCode"=>$groupCode,//商户号
						"signType"=>"MD5",
						"dateTime" =>date("Ymdhis",time()),
						
						"merchantCode"=> $merchantCode,//商户编号
						"orderNum" =>$orderNum,//订单号
					);
					
				}
				
				if($command=='GWQP010'){
					//解除绑定
					$parameter = array(
						"command"=>$command,//指令
						"groupCode"=>$groupCode,//商户号
						"signType"=>"MD5",
						"dateTime" =>date("Ymdhis",time()),
						
						"merchantCode"=> $merchantCode,//商户编号
						"contractId"=> $contractId,//用户绑卡协议号
						"memberId"=> $memberId,//用户ID
						
					);
				}
				
				
				
				 

				
				
				
				
				
				
				
				
		
		ksort($parameter, SORT_NATURAL);
		
		$signval="";
		while (list ($key, $val) = each ($parameter)) {
		   $val=yz($val);//过滤	
			$signval.=$val;//$this->utf8_unicode($val);
        }
		$signval=$signval."MgtygbF676h89g2svbz";
		$parameter['sign']=md5($signval);
		
		$url = "http://139.224.195.30:8090/r/ra/pay/downChannel/partnerBusiness";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
		$output = curl_exec($ch);
		curl_close($ch);
		//打印获得的数据
		echo $output;

		die;
		//建立请求
		
		// $Submit = new UnionpaySubmit(); 
		
		// $html_text = $Submit->buildRequestForm($parameter,"POST", "确认");
		// echo $html_text;
 


function yz($str){ //防sql注入
	   return addslashes(strip_tags(htmlspecialchars(trim($str))));
	}
 

?>
 
