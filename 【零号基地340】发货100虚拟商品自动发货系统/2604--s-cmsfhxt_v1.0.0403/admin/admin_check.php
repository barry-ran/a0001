<?php
if($_SESSION["A_login"]=="" || $_SESSION["A_pwd"]==""){
	Header("Location: login.php");
    die();
}else{
	$sql="select * from sl_admin where A_login='".$_SESSION["A_login"]."' and A_pwd='".$_SESSION["A_pwd"]."' and A_del=0";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if(mysqli_num_rows($result) > 0) {
		
	}else{
		Header("Location: login.php");
    	die();
	}
}
?>