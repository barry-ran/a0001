<?php 
if($C_memberon==0){
	box("会员中心未开放","../","error");
}

if ($_SESSION["M_login"]=="" || $_SESSION["M_pwd"]=="" || $_SESSION["M_id"]==""){
	die("<script>window.location.href='login.php'</script>");
}else{
	$M_login=htmlspecialchars($_SESSION["M_login"]);
	$M_id=$_SESSION["M_id"];
	$sql="Select * from sl_member where M_id=$M_id and M_login='".$_SESSION["M_login"]."' and M_pwd='".$_SESSION["M_pwd"]."'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$M_email=htmlspecialchars($row["M_email"]);
		$M_shop=$row["M_shop"];
		$M_head=$row["M_head"];
		$M_money=$row["M_money"];
		$M_fen=$row["M_fen"];
		$M_from=$row["M_from"];
		$M_pwd=$row["M_pwd"];

		$M_openid=$row["M_openid"];
		$M_wxid=$row["M_wxid"];

		$M_viptime=$row["M_viptime"];
		$M_viplong=$row["M_viplong"];
		$M_type=$row["M_type"];
		$M_sellertime=$row["M_sellertime"];
		$M_sellerlong=$row["M_sellerlong"];

		if($M_viplong-(time()-strtotime($M_viptime))/86400>0){
			$M_vip=1;
			$M_viptitle="VIP会员";
		}else{
			$M_vip=0;
			$M_viptitle="普通会员";
		}
	}else{
		die("<script>window.location.href='login.php'</script>");
	}
}
?>