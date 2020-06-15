<?php
require 'conn/conn.php';
require 'conn/function.php';
$type=$_GET["type"];
$id=intval($_GET["id"]);
$genkey=t($_POST["genkey"]);

$O_id=intval($_GET["O_id"]);
if($O_id==0){
	$no=intval($_POST["no"]);
	if($no==0 && $type=="productinfo"){
		box("购买数量不可为空！","./?type=productinfo&id=$id","error");
	}
	$address=intval($_POST["A_address"]);
}else{
	$no=getrs("select * from sl_orders where O_id=".$O_id,"O_num");
	$address=getrs("select * from sl_orders where O_id=".$O_id,"O_address");
}


if($_SESSION["M_id"]==""){
		box("请先登录会员帐号！","member/login.php?from=".urlencode("../?type=".$type."&id=".$id),"error");
	}else{
		$sql="Select * from sl_member where M_id=".intval($_SESSION["M_id"]);
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$M_id=$row["M_id"];
		$M_email=$row["M_email"];
		$M_money=$row["M_money"];
		$M_viptime=$row["M_viptime"];
		$M_viplong=$row["M_viplong"];

		if($M_viplong-(time()-strtotime($M_viptime))/86400>0){
			$M_vip=1;
			$N_discount=$C_n_discount/10;
			$P_discount=$C_p_discount/10;
		}else{
			$M_vip=0;
			$N_discount=1;
			$P_discount=1;
		}
	}


if($type=="cartbuy"){//通过购物车支付
	$fee=0;
	$ids=$_POST["O_ids"];
	if(count($ids)>0) {
		for ($i=0 ;$i<count($ids);$i++ ) {
			$sql="select * from sl_product,sl_orders where O_del=0 and P_del=0 and O_pid=P_id and O_id=".$ids[$i];
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			if (mysqli_num_rows($result) > 0) {
				$fee=$fee+round($row["P_price"]*$P_discount*$row["O_num"],2);
			}
		}

		if($M_money-$fee>=0 && $fee>0){//账户余额足够
			mysqli_query($conn, "update sl_member set M_money=M_money-".$fee." where M_id=".$M_id);//扣除余额
			for ($i=0 ;$i<count($ids);$i++) {
				$sql="select * from sl_product,sl_orders where O_del=0 and P_del=0 and O_pid=P_id and O_id=".$ids[$i];
				$result = mysqli_query($conn, $sql);
				  $row = mysqli_fetch_assoc($result);
				  if (mysqli_num_rows($result) > 0) {
				  	$P_id=$row["P_id"];
				    $P_title=$row["P_title"];
				    $P_pic=$row["P_pic"];
				    $P_sell=$row["P_sell"];
				    $P_selltype=$row["P_selltype"];
				    $P_mid=$row["P_mid"];
				    $P_price=$row["P_price"]*$P_discount;
				    $no=$row["O_num"];
				    $address=$row["O_address"];
				    $feex=round($row["P_price"]*$P_discount*$no,2);
				  }

				  switch($P_selltype){
				  	case 0:
				  		$O_content=$P_sell;
				  		$O_address=getrs("select * from sl_member where M_id=".intval($_SESSION["M_id"]),"M_email");
				  		$O_state=1;
				  	break;
				  	case 1:
				  		for($i=0;$i<$no;$i++){
							$C_id=getrs("select C_id from sl_card where C_del=0 and C_use=0 and C_sort=".intval($P_sell)." order by rand() limit 1","C_id");
							$C_content=getrs("select * from sl_card where C_id=".intval($C_id),"C_content");
							if($C_content==""){
								$O_content=$O_content."商品缺货，请联系客服||";
							}else{
								$O_content=$O_content.$C_content."||";
							}
							mysqli_query($conn,"update sl_card set C_use=1 where C_id=".intval($C_id));
						}
						$O_content=substr($O_content,0,strlen($O_content)-2);
						$O_address=getrs("select * from sl_member where M_id=".intval($_SESSION["M_id"]),"M_email");
						$O_state=1;
				  	break;
				  	case 2:
					  	if($address==0){
					  		box("请先完善您的收货信息","member/address.php","error");
					  	}else{
					  		mysqli_query($conn,"update sl_product set P_rest=P_rest-$no where P_id=".$P_id);
					  		$O_content="实物商品，由商家手动发货";
					  		$O_address=getrs("select * from sl_address where A_id=".$address,"A_address")." ".getrs("select * from sl_address where A_id=".$address,"A_name")." ".getrs("select * from sl_address where A_id=".$address,"A_phone");
					  		$O_state=0;
					  	}
				  	break;
				  }
				mysqli_query($conn, "update sl_orders set O_state=1,O_content='$O_content' where O_id=".$ids[$i]);
				mysqli_query($conn, "update sl_product set P_sold=P_sold+$no where P_id=".$P_id);
				mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($M_id,'".date('YmdHis').rand(10000000,99999999)."','购买商品-".$P_title."','".date('Y-m-d H:i:s')."',-$feex,'')");
				
				if($P_mid>0){
					mysqli_query($conn, "update sl_member set M_money=M_money+".$feex." where M_id=$P_mid");
					mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($P_mid,'".date('YmdHis').rand(10000000,99999999)."','售出商品-".$P_title."','".date('Y-m-d H:i:s')."',$feex,'')");
				}
				$O_contents=$O_contents."<p>商品名称：".$P_title."</p><p>发货内容：".$O_content."</p>";
			}
			//统一内容
			if($O_contents!=""){
				sendmail("您的购买的商品已发货",$O_contents,$O_address);
			}
			box("购买成功！" , "member/product.php", "success");

		}else{
			box("账户余额不足，请先充值！" , "member/pay.php?money=".($fee-$M_money), "error");
		}
	} else {
		box("请选择要支付的商品","back","error");
	}
}

if($type=="newsinfo"){
	die("<script>window.location.href='conn/unlogin.php?type=news&id=$id&genkey=$genkey';</script>");
}

if($type=="productinfo"){
	die("<script>window.location.href='conn/unlogin.php?type=product&id=$id&genkey=$genkey';</script>");
}
?>