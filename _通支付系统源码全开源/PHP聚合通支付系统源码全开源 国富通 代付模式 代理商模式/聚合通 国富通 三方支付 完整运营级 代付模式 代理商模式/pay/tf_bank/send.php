<?php
 
header ( 'Content-type:text/html;charset=UTF-8' );
include_once("lib/unionpay_submit.class.php");
/**************************�������**************************/ 
 
switch ($_GET['bankcode'])
{
case "ICBC"://��������
  $_GET['bankcode']="01020000";
  break;  
case "CCB"://��������
  $_GET['bankcode']="01050000";
  break;  
case "ABC"://ũҵ����
  $_GET['bankcode']="01030000";
  break;  
case "CMB"://��������
  $_GET['bankcode']="03080000";
  break;  
case "BOCSH"://�й�����
  $_GET['bankcode']="01040000";
  break;  
case "BOCOM"://��ͨ����
  $_GET['bankcode']="03010000";
  break;  
case "PSBC"://�й���������
  $_GET['bankcode']="01000000";
  break;  
case "CEB"://�������
  $_GET['bankcode']="03030000";
  break;  
case "GDB"://�㶫��չ����
  $_GET['bankcode']="03060000";
  break;  
case "CIB"://��ҵ����
  $_GET['bankcode']="03090000";
  break;  
case "SPDB"://�Ϻ��ֶ���չ����
  $_GET['bankcode']="03100000";
  break;  
case "CMBC"://��������
  $_GET['bankcode']="03050000";
  break;  
case "CNCB"://��������
  $_GET['bankcode']="03020000";
  break;  
case "PAB"://ƽ������
  $_GET['bankcode']="03070000";
  break;  
 
case "BOS"://�Ϻ�����
  $_GET['bankcode']="";
  break;  
case "SRCB"://�Ϻ�ũ����ҵ����
  $_GET['bankcode']="";
  break;  
case "HXB"://��������
  $_GET['bankcode']="03040000";
  break;    
  
default:
 
}
		
		if($_GET['bankcode']==""){
			echo "����ͨ���ر�";
			return;
		}
		 
		$parameter = array(
				
				"bankLink"=> $_GET['bankcode'],//������ 
				//"bankLink"=> '01050000',//������ 
				"cardType"=> '0',//������ 
				"command"=>"GWUP001",//ָ��
				"currency"=> "CNY",//���� 
				"dateTime" =>date("Ymdhis",time()),
				"groupCode"=>"G910000000001078",//�̻���
				"merchantCode"=> "M00000000003118",//�̻���� 
				"notifyUrl"=> "http://".$_SERVER['HTTP_HOST']."/pay/tf_bank/notifyUrl.php",//�ص�URL 
				"orderNum" =>$_GET['orderid'],
				"payMoney" =>$_GET['price']*100,
				"productName" =>$_GET['orderid'],
				"returnUrl"=> $_GET['returnUrl'],//�ɹ�����URL
				"signType"=>"MD5",
				"terminalCode"=> "T0000000004788",//�ն˱�� 
				//"randomCode"=> "123456789",// 
				
		);
	 
		// print_r($parameter);
		// die;
		//��������
		
		$Submit = new UnionpaySubmit(); 
		
		$html_text = $Submit->buildRequestForm($parameter,"POST", "ȷ��");
		echo $html_text;
 



 

?>
 
