<?php  
	date_default_timezone_set('PRC'); 
	header('Content-Type:text/html; charset=gb2312');
 
    $data = array(
	    'server_no' => '100008',
  		'trans_time' => date("YmdHis"),// 
  		'account' => '9202000463',// 
		'amount' => $_GET['price']*100,// 
		'pay_mode'=>"API_QWAB",
 
	);
	
	$key= "afilhfa0uflajg";//加密密钥
	  
	$Signstr = "{" . $data["server_no"] . "}|{" . $data["trans_time"] . "}|{" .$data["account"] . "}|{" . $data["amount"] . "}|{" . $data["pay_mode"] . "}|{" . $key . "}";

	echo $Signstr;

	$Sign = substr(strtoupper(md5($Signstr)),0,16);
	 
    echo ("  ".$Sign);

 	$data['aging']= '1' ;
	$data['app_id']=$_GET['orderid'];
    $data['callback_url']="http://".$_SERVER['HTTP_HOST']."/pay/br_bankwap/returnUrl.php";
	$data['notify_url']="http://".$_SERVER['HTTP_HOST']."/pay/br_bankwap/notifyUrl.php";
	$data['memo']='china';
 
	//调用接口的平台服务地址
	$remote_server = "http://cp.yitianmao.com/cgi-bin/gateway_pay_pho.cgi";

    $Context = "server_no=" . $data["server_no"]. "&trans_time=" . $data["trans_time"] . "&account=" . $data["account"] . "&amount=" . $data["amount"] . "&pay_mode=" . $data["pay_mode"] .
            "&aging=" . $data["aging"] . "&app_id=" . $data["app_id"] . "&callback_url=" . $data["callback_url"] . "&notify_url=" . $data["notify_url"] . "&memo=" . $data["memo"];
    

	$Context1=base64_encode($Context);
    $Context1 = str_ireplace("+","-",$Context1);
	$Context1 = str_ireplace("/","_",$Context1);
	$Context1 = str_ireplace("=","",$Context1);

    $data=array(
	
		 "syscode"=>"20000091",
		 "version"=>"002",
		 "context" => $Context1,
		 "signature"=> $Sign,
	
	);

    $strUrl = "syscode=" . $data["syscode"] . "&version=" . $data["version"] . "&context=" . $data["context"] . "&signature=" . $data["signature"] ;
   
	$ch = curl_init();
	$this_header = array(
		"content-type: application/x-www-form-urlencoded; charset=gb2312"
	);
	curl_setopt($ch, CURLOPT_URL, $remote_server);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $strUrl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$result=curl_exec($ch);    
    $curl_errno = curl_errno($ch);
	 
	file_put_contents('gatepay.log', $result.PHP_EOL, FILE_APPEND);
    curl_close($ch);
  	if ($curl_errno >0) { 
		echo '失败'; 
		return ;

	} 
	 
		$dic=json_decode($result,true);

       if ($dic["errorcode"] != "0000")
        {
           
            echo ("\n请求失败!" . $dic["errorcode"] ."  ". $dic["errormessage"]);
            return;
        }

		$strSign = $dic["signature"];
		$context = base64_decode($dic["context"]);

		  parse_str($context,$dic); 
         
        $Signstr = "{" . $dic["trans_id"] . "}|{" . $dic["amount"] . "}|{" . $dic["pay_url"] . "}|{" . $key . "}";
        $Sign = substr(strtoupper(md5($Signstr)),0,16);
        if ($strSign != $Sign)
        {
            echo("\n签名失败! Get：" . $strSign." Sign: ".$Sign);
            return;
        }  
		$Context1 = str_ireplace("-","+",$dic["pay_url"]);
		$Context1 = str_ireplace("_","/",$Context1);
		$Context1 = str_ireplace("","=",$Context1);
        $pay_url = base64_decode($Context1);
	 
         echo $pay_url;
              
        header('Location:'.$pay_url);


?>
