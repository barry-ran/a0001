<?php
require '../conn/conn.php';
require '../conn/function.php';

$action=$_GET["action"];

switch($action){
	case "get_auth":
	$authcode=$_POST["authcode"];
	$info=getbody("http://www.fahuo100.cn/api/index.php?action=getauth","domain=$C_domain&authcode=$authcode");
	if($info=="success"){
		mysqli_query($conn, "update sl_config set C_authcode='$authcode'");
		setcookie("auth", "success");
		die($info);
	}else{
		die($info);
	}
	break;
}
?>