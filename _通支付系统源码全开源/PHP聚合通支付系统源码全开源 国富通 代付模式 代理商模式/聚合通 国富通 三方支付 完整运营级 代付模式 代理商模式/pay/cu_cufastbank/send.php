<?php

include "lib/config.php";
include "lib/TDESUtils.php";
include "lib/HttpUtils.php";
 
	date_default_timezone_set('PRC'); 
	header('Content-Type:text/html; charset=gb2312');


/**************************请求参数**************************/ 
		 
 
		$account_sign=$_GET['memberId'];//注册商户号
		
		$server_no="200001";//交易代码
		$trans_time=date("YmdHis");//交易时间
		$pay_mode="API_CUQPAY";//支付方式
		$aging="2";//支付时效
		$app_id=$_GET['orderNum'];//商户流水号
		$notify_url=$_GET['notifyUrl'];//通知URL
		$card_name=iconv('utf-8','gb2312',$_GET['accountName']);;//持卡人姓名
		$card_no=$_GET['bankCard'];//持卡卡号
		$card_type=$_GET['cardType'];//卡类型
		$card_expdate=$_GET['expireDate'];//有效期
		$card_cvv=$_GET['cvn2'];//安全码
		$bank_code="";//银行编码
		$bank_name="";//开户银行
		$id_type=$_GET['idType'];//证件类型
		$id_no=$_GET['idNo'];//证件号码
		$mobile=$_GET['phone'];//手机号
		$amount=$_GET['payMoney']*100;//金额
		$contract_id=$_GET['contractId'];//签约协议号
		
				
				if($_GET['command']=='GWQP001'){
					$remote_server = "http://www.yitianmao.com/cgi-bin/qpay_cu_contract.cgi";
					//绑卡
					$parameter = array(
						"syscode"=>$Syscode,
						"version"=>$Version,
						
						"server_no"=> $server_no,//交易代码
						"trans_time" =>$trans_time,//交易时间
						"account" =>$Account,//商户号
						"account_sign" =>$account_sign,//注册商户号
						"pay_mode" =>$pay_mode,//支付方式
						"aging" =>$aging,//支付时效
						"app_id" =>$app_id,//商户流水号
						"notify_url" =>$notify_url,//通知URL
						"card_name" =>$card_name,//持卡人姓名
						"card_no" =>$card_no,//持卡卡号
						"card_type" =>$card_type,//卡类型
						"card_expdate" =>$card_expdate,//有效期
						"card_cvv" =>$card_cvv,//安全码
						"bank_code" =>$bank_code,//银行编码
						"bank_name" =>$bank_name,//开户银行
						"id_type" =>$id_type,//证件类型
						"id_no" =>$id_no,//证件号码
						"mobile" =>$mobile,//手机号
 
					);
					$Signstr = "{".$parameter['server_no']."}|{".$parameter['trans_time']."}|{".$parameter['account']."}|{".$parameter['pay_mode']."}|{".$parameter['aging']."}|{".$parameter['card_no']."}|{".$parameter['card_type']."}|{".$parameter['id_type']."}|{".$parameter['id_no']."}|{".$parameter['mobile']."}|{".$Key."}";
					
					$Context = "syscode=".$parameter['syscode']."&server_no=".$parameter['server_no']."&trans_time=".$parameter['trans_time']."&account=".$parameter['account']."&account_sign=".$parameter['account_sign']."&pay_mode=".$parameter['pay_mode']."&aging=".$parameter['aging']."&app_id=".$parameter['app_id']."&card_name=".$parameter['card_name']."&card_no=".$parameter['card_no']."&card_type=".$parameter['card_type']."&id_type=".$parameter['id_type']."&id_no=".$parameter['id_no']."&mobile=".$parameter['mobile']; 
				 
				}
				 
				if($_GET['command']=='GWQP002'){
					$remote_server = "http://www.yitianmao.com/cgi-bin/qpay_cu_prepay.cgi";
					//绑卡
					$parameter = array(
						"syscode"=>$Syscode,
						"version"=>$Version,
						
						"server_no"=> $server_no,//交易代码
						"trans_time" =>$trans_time,//交易时间
						"account" =>$Account,//商户号
						"account_sign" =>$account_sign,//注册商户号
						"amount" =>$amount,//金额单位分
						"pay_mode" =>$pay_mode,//支付方式
						"aging" =>$aging,//支付时效
						"app_id" =>$app_id,//商户流水号
						"notify_url" =>$notify_url,//通知URL
						"contract_id" =>$contract_id,//签约协议号
						 
 
					);
					$Signstr = "{".$parameter['server_no']."}|{".$parameter['trans_time']."}|{".$parameter['account']."}|{".$parameter['account_sign']."}|{".$parameter['amount']."}|{".$parameter['pay_mode']."}|{".$parameter['aging']."}|{".$parameter['contract_id']."}|{".$Key."}";
					
					$Context = "syscode=".$parameter['syscode']."&server_no=".$parameter['server_no']."&trans_time=".$parameter['trans_time']."&account=".$parameter['account']."&account_sign=".$parameter['account_sign']."&amount=".$parameter['amount']."&pay_mode=".$parameter['pay_mode']."&aging=".$parameter['aging']."&app_id=".$parameter['app_id']."&notify_url=".$parameter['notify_url']."&contract_id=".$parameter['contract_id']; 
					// print_r($parameter);
					// echo "<br>Signstr:".$Signstr;
					// echo "<br>Context:".$Context;
					// die;
				}
				 
	$Sign = substr(strtoupper(md5($Signstr)),0,16);
  
				
				
				 
//调用接口的平台服务地址
	

	
    $Tdes = new CryptDes();
  	$result = $Tdes->encrypt($Context,$Tdes->K16byteTo24str($Key3DES));//加密字符串
    $result =  $Tdes->PackUrlBase64($result);
    $Tdes=null;

	//echo "result ".$result ."<br/>";
	 
	$res=new HttpUtils() ;
 
    $strUrl=$res->Postdata($Syscode,$Version,$result,$Sign);
	
	//echo $strUrl."<br/>";

	list ( $curl_errno, $result )=$res->Post($remote_server,$strUrl);
    $res=null;

	if ( $curl_errno >0) { 
		echo '通讯失败 errorno: '.$curl_errno."<br/>"; 
		return ;
    } 
  
	$strgbk2utf =  iconv("GB2312","UTF-8",$result);
	$dic=json_decode($strgbk2utf,true);
    print_r($dic);
       if ($dic["errorcode"] != "0000")
        {
           
            echo  "\n查询失败!" . $result ."<br/>" ;
            return;
        }

		$strSign = $dic["signature"];
		$Tdes = new CryptDes();
		$context=$Tdes->UnPackUrlBase64($dic["context"]);
		$context = $Tdes->decrypt(($context), $Tdes->K16byteTo24str($Key3DES));//解密字符串
		$Tdes=null;
		parse_str($context,$dic); 
           
         
         echo "查询成功： ".$context."<br/>";
				
				
				
				
				
 
 

?>
 
