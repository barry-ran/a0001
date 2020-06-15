<?php

include "lib/config.php";
include "lib/TDESUtils.php";
include "lib/HttpUtils.php";

	date_default_timezone_set('PRC'); 
	header('Content-Type:text/html; charset=gb2312');


/**************************请求参数**************************/ 
		$key="asdfipkg123";//MD5密钥
		$keydes="44DEAF82111DB2B04882B12D77C3BE34";//3DES密钥
		$syscode="20000020";//系统码
		$version="002";//版本号
		$account="9100000020";//商户号
		$account_sign="10000";//注册商户号
		
		$server_no="200001";//交易代码
		$trans_time=date("Ymdhis",time());//交易时间
		$pay_mode="API_CUQPAY";//支付方式
		$aging="T1";//支付时效
		$app_id=time();//商户流水号
		$notify_url="http://www.hao123.com";//通知URL
		$card_name="李方东";//持卡人姓名
		$card_no="6227003150370038492";//持卡卡号
		$card_type="01";//卡类型
		$card_expdate="";//有效期
		$card_cvv="";//安全码
		$bank_code="";//银行编码
		$bank_name="";//开户银行
		$id_type="01";//证件类型
		$id_no="440204198909163018";//证件号码
		$mobile="13680072070";//手机号
		
				
				if($_GET['command']=='GWQP001'){
					//绑卡
					$parameter = array(
						"syscode"=>$syscode,
						"version"=>$version,
						
						"server_no"=> $server_no,//交易代码
						"trans_time" =>$trans_time,//交易时间
						"account" =>$account,//商户号
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
						"context" =>"syscode=".$parameter['syscode'].
									"&server_no=".$parameter['server_no'].
									"&trans_time=".$parameter['trans_time'].
									"&account=".$parameter['account'].
									"&account_sign=".$parameter['account_sign'].
									"&pay_mode=".$parameter['pay_mode'].
									"&aging=".$parameter['aging'].
									"&app_id=".$parameter['app_id'].
									"&card_name=".$parameter['card_name'].
									"&card_no=".$parameter['card_no'].
									"&card_type=".$parameter['card_type'].
									"&id_type=".$parameter['id_type'].
									"&id_no=".$parameter['id_no'].
									"&mobile=".$parameter['mobile']
									,//业务报文
						"signature" =>substr(strtoupper(md5(
										"{".$parameter['server_no']."}|{".
										"{".$parameter['trans_time']."}|{".
										"{".$parameter['account']."}|{".
										"{".$parameter['pay_mode']."}|{".
										"{".$parameter['aging']."|".
										"{".$parameter['card_no']."}|{".
										"{".$parameter['card_type']."}|{".
										"{".$parameter['id_type']."}|{".
										"{".$parameter['id_no']."}|{".
										"{".$parameter['mobile']."}|{".
										"{".$key."}"
										)),0,16),//交易签名
						 
					);
				 
				}
 
 
				$Signstr =$parameter['signature'];
		 
				 
				
				
				 
//调用接口的平台服务地址
	$remote_server = "http://www.yitianmao.com/cgi-bin/qpay_cu_contract.cgi";

	$Context = $parameter['context']; 

    $Tdes = new CryptDes();
  	$result = $Tdes->encrypt($Context,$Tdes->K16byteTo24str($Key3DES));//加密字符串
    $result =  $Tdes->PackUrlBase64($result);
    $Tdes=null;

	//echo "result ".$result ."<br/>";
	 
	$res=new HttpUtils() ;
 
    $strUrl=$res->Postdata($Syscode,$Version,$result,$Signstr);
	
	//echo $strUrl."<br/>";

	list ( $curl_errno, $result )=$res->Post($remote_server,$strUrl);
    $res=null;

	if ( $curl_errno >0) { 
		echo '通讯失败 errorno: '.$curl_errno."<br/>"; 
		return ;
    } 
  
	$strgbk2utf =  iconv("GB2312","UTF-8",$result);
	$dic=json_decode($strgbk2utf,true);
    
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
         
        $Signstr = "{" . $dic["trans_id"] . "}|{" . $dic["app_id"] . "}|{". $dic["result"] . "}|{" . $dic["amount"] . "}|{". $dic["in_card_no"] . "}|{". $key . "}";
        $Sign = substr(strtoupper(md5($Signstr)),0,16);
        if ($strSign != $Sign)
        {
            echo("\n签名失败： ".$Signstr."  " . $strSign." Sign: ".$Sign."<br/>");
            return;
        }  
         
         echo "查询成功： ".$context."<br/>";
				
				
				
				
				
 
 

?>
 
