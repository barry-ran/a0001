<?php
  $post= json_encode($_GET);
 $ppos = json_decode($post,true);
   $file = fopen("notifyurl.txt",'w');
   fwrite($file,var_export($ppos,true));
   fclose($file);
   echo "SUCCESS";
  die; 
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
           
		   // if ($sign == md5($signSource))//ǩ����ȷ
            // {

			if ($_POST['platPayResultRemark']){
				
			 
				$orderid=$_GET["transp"];
				
				$money=$_GET["fee"];
				$handle=@new Handleorder($orderid,$money);
				$handle->updateUncard();
				
			}

			 echo "SUCCESS";
            // }
			
			// else {
			//��֤ʧ��
			// echo "ǩ����֤ʧ��";
			// echo $sign;
			// echo md5($signSource);
			// }
?>
