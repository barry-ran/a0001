<?php
  // $post= json_encode($_GET);
 // $ppos = json_decode($post,true);
   // $file = fopen("notifyurl.text",'w');
   // fwrite($file,var_export($ppos,true));
   // fclose($file);
   // echo "SUCCESS";
  // die; 
$key = "orderid=".$_GET['orderid']."&opstate=".$_GET['opstate']."&ovalue=".$_GET['ovalue'];
		//ǩ��
		$sign	= md5($key."449a982c3add4b7aac58c8159ff9930c");
  
require_once 'inc.php';
//require_once 'yeepayCommon.php';
require_once '../../app/model/Handleorder.php';    

use WY\app\model\Handleorder;


			// $partner		=	$p1_MerId;  //�̻���
            // $key			=	$merchantKey;		//MD5��Կ����ȫ������
			
			
            // $orderstatus = $_GET["orderstatus"]; // ֧��״̬
            // $ordernumber = $_GET["ordernumber"]; // ������
            // $paymoney = number_format($_GET["paymoney"], 2); //������
            // $sign = $_GET["sign"];	//�ַ����ܴ�
            // $attach = $_GET["attach"];	//��������
           // $signSource = sprintf("partner=%s&ordernumber=%s&orderstatus=%s&paymoney=%s%s", $partner, $ordernumber, $orderstatus, $paymoney, $key); //�����ַ������ܴ���
           
		    if ($_GET['sign'] == $sign){//ǩ����ȷ
            // {
				if($_GET['opstate']==0 || $_GET['opstate']==-3){
					 
					//$ppos['orderNum']="2017121720334550051";
					$orderid=$_GET['orderid'];
					
					$money=$_GET['ovalue'];
					$handle=@new Handleorder($orderid,$money);
					$handle->updateUncard();

				}
				echo "opstate=0";
			}else{
				echo "opstate=-2";
			}
			 
            // }
			
			// else {
			//��֤ʧ��
			// echo "ǩ����֤ʧ��";
			// echo $sign;
			// echo md5($signSource);
			// }
?>
