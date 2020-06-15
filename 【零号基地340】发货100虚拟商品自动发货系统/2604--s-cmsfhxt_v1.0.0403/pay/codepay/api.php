<?php
require_once("../../conn/conn.php");
require_once("../../conn/function.php");

if(checkauth()){
	plug("x6","../../conn/plug/");
	require "../../conn/plug/x6.php";
}else{
	die("{\"msg\":\"免费版暂不支持免签支付\"}");
}
?>