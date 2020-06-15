<?php
require '../../conn/conn.php';
require '../../conn/function.php';
include('aop/AopClient.php');

$aop = new AopClient;
$aop->alipayrsaPublicKey = $C_aliapp_key2;;
$flag = $aop->rsaCheckV1($_POST, NULL, "RSA2");

$trade_no=$_POST["trade_no"];
$total_fee=$_POST["total_amount"];

if($flag==1){
	$M_id=1;
	
	$body = explode("|",$_POST["body"]);
	$type = $body[0];
	$id = intval($body[1]);
	$genkey = $body[2];
	$email = $body[3];
	$no=intval($body[4]);

	$sql = "select * from sl_list where L_no='" . t($trade_no) . "'";//用户充值
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) <= 0) {
        
        if($type=="news"){
			$sql2="select * from sl_news where N_del=0 and N_id=".$id;
			$result2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			if (mysqli_num_rows($result2) > 0) {
				$N_title=$row2["N_title"];
				$N_pic=$row2["N_pic"];
				$N_price=$row2["N_price"];
				$N_mid=$row2["N_mid"];
			}
			if($N_price==$total_fee){
				mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values(1,'$trade_no','帐号充值','".date('Y-m-d H:i:s')."',".$total_fee.",'')");
				mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values(1,'$trade_no','免登录支付',-'".date('Y-m-d H:i:s')."',".$total_fee.",'')");
				mysqli_query($conn, "insert into sl_orders(O_nid,O_mid,O_time,O_type,O_price,O_num,O_title,O_pic,O_state,O_address,O_content,O_genkey) values($id,1,'".date('Y-m-d H:i:s')."',1,$total_fee,1,'$N_title','$N_pic',1,'$email','$genkey','$genkey')");

				if($N_mid>0){
					mysqli_query($conn, "update sl_member set M_money=M_money+".$total_fee." where M_id=$N_mid");
					mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($N_mid,'".date('YmdHis').rand(10000000,99999999)."','售出文章-".$N_title."','".date('Y-m-d H:i:s')."',$total_fee,'')");
				}

				sendmail("查收您的付费阅读文章", "<p>感谢您购买文章《".$N_title."》阅读</p><p>阅读链接：http://".$D_domain."/?type=newsinfo&id=".$id."&genkey=".$genkey."</p>", $email);
			}

        }else{
			$sql2="select * from sl_product where P_del=0 and P_id=".$id;
			$result2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			if (mysqli_num_rows($result2) > 0) {
				$P_title=$row2["P_title"];
				$P_pic=$row2["P_pic"];
				$P_sell=$row2["P_sell"];
				$P_selltype=$row2["P_selltype"];
				$P_price=$row2["P_price"];
				$P_mid=$row2["P_mid"];
			}

			switch($P_selltype){
			  	case 0:
			  		$O_content=$P_sell;
			  		$O_address=$email;
			  		$O_state=1;
			  	break;
			  	case 1:
			  		for($i=0;$i<$no;$i++){
						$C_id=getrs("select * from sl_card where C_del=0 and C_use=0 and C_sort=".intval($P_sell),"C_id");
						$C_content=getrs("select * from sl_card where C_id=".intval($C_id),"C_content");
						if($C_content==""){
							$O_content=$O_content."商品缺货，请联系客服||";
						}else{
							$O_content=$O_content.$C_content."||";
						}
						mysqli_query($conn,"update sl_card set C_use=1 where C_id=".intval($C_id));
					}
					$O_content=substr($O_content,0,strlen($O_content)-2);
					$O_address=$email;
					$O_state=1;
			  	break;
			  	case 2:
			  		mysqli_query($conn,"update sl_product set P_rest=P_rest-1 where P_id=".$id);
			  		$O_content="实物商品，由商家手动发货";
			  		$O_address=$email;
			  		$O_state=0;
			  	break;
			}

			if($P_price*$no==$total_fee){
				mysqli_query($conn, "update sl_product set P_sold=P_sold+1 where P_id=".$id);
				mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values(1,'$trade_no','帐号充值','".date('Y-m-d H:i:s')."',".$total_fee.",'')");
				mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values(1,'$trade_no','免登录支付','".date('Y-m-d H:i:s')."',-".$total_fee.",'')");
				mysqli_query($conn, "insert into sl_orders(O_pid,O_mid,O_time,O_type,O_price,O_num,O_content,O_title,O_pic,O_address,O_state,O_genkey) values($id,1,'".date('Y-m-d H:i:s')."',0,$P_price,$no,'$O_content','$P_title','$P_pic','$O_address',$O_state,'$genkey')");
				if($P_mid>0){
					mysqli_query($conn, "update sl_member set M_money=M_money+".$total_fee." where M_id=$P_mid");
					mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($P_mid,'".date('YmdHis').rand(10000000,99999999)."','售出商品-".$P_title."','".date('Y-m-d H:i:s')."',$total_fee,'')");
				}
			}
			sendmail("您的购买的商品已发货","<p>商品名称：".$P_title."</p><p>发货内容：".str_replace("||","<br>",$O_content)."</p>",$email);
        }
        
	    sendmail("有用户通过支付宝购物","用户ID：".$M_id."<br>商品名称：".$P_title."<br>购物金额：".$total_fee."元<br>交易单号：".$trade_no,$C_email);
    }
}
?>