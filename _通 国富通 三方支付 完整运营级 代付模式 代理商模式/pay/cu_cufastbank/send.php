<?php

include "lib/config.php";
include "lib/TDESUtils.php";
include "lib/HttpUtils.php";
 
	date_default_timezone_set('PRC'); 
	header('Content-Type:text/html; charset=gb2312');


/**************************�������**************************/ 
		 
 
		$account_sign=$_GET['memberId'];//ע���̻���
		
		$server_no="200001";//���״���
		$trans_time=date("YmdHis");//����ʱ��
		$pay_mode="API_CUQPAY";//֧����ʽ
		$aging="2";//֧��ʱЧ
		$app_id=$_GET['orderNum'];//�̻���ˮ��
		$notify_url=$_GET['notifyUrl'];//֪ͨURL
		$card_name=iconv('utf-8','gb2312',$_GET['accountName']);;//�ֿ�������
		$card_no=$_GET['bankCard'];//�ֿ�����
		$card_type=$_GET['cardType'];//������
		$card_expdate=$_GET['expireDate'];//��Ч��
		$card_cvv=$_GET['cvn2'];//��ȫ��
		$bank_code="";//���б���
		$bank_name="";//��������
		$id_type=$_GET['idType'];//֤������
		$id_no=$_GET['idNo'];//֤������
		$mobile=$_GET['phone'];//�ֻ���
		$amount=$_GET['payMoney']*100;//���
		$contract_id=$_GET['contractId'];//ǩԼЭ���
		
				
				if($_GET['command']=='GWQP001'){
					$remote_server = "http://www.yitianmao.com/cgi-bin/qpay_cu_contract.cgi";
					//��
					$parameter = array(
						"syscode"=>$Syscode,
						"version"=>$Version,
						
						"server_no"=> $server_no,//���״���
						"trans_time" =>$trans_time,//����ʱ��
						"account" =>$Account,//�̻���
						"account_sign" =>$account_sign,//ע���̻���
						"pay_mode" =>$pay_mode,//֧����ʽ
						"aging" =>$aging,//֧��ʱЧ
						"app_id" =>$app_id,//�̻���ˮ��
						"notify_url" =>$notify_url,//֪ͨURL
						"card_name" =>$card_name,//�ֿ�������
						"card_no" =>$card_no,//�ֿ�����
						"card_type" =>$card_type,//������
						"card_expdate" =>$card_expdate,//��Ч��
						"card_cvv" =>$card_cvv,//��ȫ��
						"bank_code" =>$bank_code,//���б���
						"bank_name" =>$bank_name,//��������
						"id_type" =>$id_type,//֤������
						"id_no" =>$id_no,//֤������
						"mobile" =>$mobile,//�ֻ���
 
					);
					$Signstr = "{".$parameter['server_no']."}|{".$parameter['trans_time']."}|{".$parameter['account']."}|{".$parameter['pay_mode']."}|{".$parameter['aging']."}|{".$parameter['card_no']."}|{".$parameter['card_type']."}|{".$parameter['id_type']."}|{".$parameter['id_no']."}|{".$parameter['mobile']."}|{".$Key."}";
					
					$Context = "syscode=".$parameter['syscode']."&server_no=".$parameter['server_no']."&trans_time=".$parameter['trans_time']."&account=".$parameter['account']."&account_sign=".$parameter['account_sign']."&pay_mode=".$parameter['pay_mode']."&aging=".$parameter['aging']."&app_id=".$parameter['app_id']."&card_name=".$parameter['card_name']."&card_no=".$parameter['card_no']."&card_type=".$parameter['card_type']."&id_type=".$parameter['id_type']."&id_no=".$parameter['id_no']."&mobile=".$parameter['mobile']; 
				 
				}
				 
				if($_GET['command']=='GWQP002'){
					$remote_server = "http://www.yitianmao.com/cgi-bin/qpay_cu_prepay.cgi";
					//��
					$parameter = array(
						"syscode"=>$Syscode,
						"version"=>$Version,
						
						"server_no"=> $server_no,//���״���
						"trans_time" =>$trans_time,//����ʱ��
						"account" =>$Account,//�̻���
						"account_sign" =>$account_sign,//ע���̻���
						"amount" =>$amount,//��λ��
						"pay_mode" =>$pay_mode,//֧����ʽ
						"aging" =>$aging,//֧��ʱЧ
						"app_id" =>$app_id,//�̻���ˮ��
						"notify_url" =>$notify_url,//֪ͨURL
						"contract_id" =>$contract_id,//ǩԼЭ���
						 
 
					);
					$Signstr = "{".$parameter['server_no']."}|{".$parameter['trans_time']."}|{".$parameter['account']."}|{".$parameter['account_sign']."}|{".$parameter['amount']."}|{".$parameter['pay_mode']."}|{".$parameter['aging']."}|{".$parameter['contract_id']."}|{".$Key."}";
					
					$Context = "syscode=".$parameter['syscode']."&server_no=".$parameter['server_no']."&trans_time=".$parameter['trans_time']."&account=".$parameter['account']."&account_sign=".$parameter['account_sign']."&amount=".$parameter['amount']."&pay_mode=".$parameter['pay_mode']."&aging=".$parameter['aging']."&app_id=".$parameter['app_id']."&notify_url=".$parameter['notify_url']."&contract_id=".$parameter['contract_id']; 
					// print_r($parameter);
					// echo "<br>Signstr:".$Signstr;
					// echo "<br>Context:".$Context;
					// die;
				}
				 
	$Sign = substr(strtoupper(md5($Signstr)),0,16);
  
				
				
				 
//���ýӿڵ�ƽ̨�����ַ
	

	
    $Tdes = new CryptDes();
  	$result = $Tdes->encrypt($Context,$Tdes->K16byteTo24str($Key3DES));//�����ַ���
    $result =  $Tdes->PackUrlBase64($result);
    $Tdes=null;

	//echo "result ".$result ."<br/>";
	 
	$res=new HttpUtils() ;
 
    $strUrl=$res->Postdata($Syscode,$Version,$result,$Sign);
	
	//echo $strUrl."<br/>";

	list ( $curl_errno, $result )=$res->Post($remote_server,$strUrl);
    $res=null;

	if ( $curl_errno >0) { 
		echo 'ͨѶʧ�� errorno: '.$curl_errno."<br/>"; 
		return ;
    } 
  
	$strgbk2utf =  iconv("GB2312","UTF-8",$result);
	$dic=json_decode($strgbk2utf,true);
    print_r($dic);
       if ($dic["errorcode"] != "0000")
        {
           
            echo  "\n��ѯʧ��!" . $result ."<br/>" ;
            return;
        }

		$strSign = $dic["signature"];
		$Tdes = new CryptDes();
		$context=$Tdes->UnPackUrlBase64($dic["context"]);
		$context = $Tdes->decrypt(($context), $Tdes->K16byteTo24str($Key3DES));//�����ַ���
		$Tdes=null;
		parse_str($context,$dic); 
           
         
         echo "��ѯ�ɹ��� ".$context."<br/>";
				
				
				
				
				
 
 

?>
 
