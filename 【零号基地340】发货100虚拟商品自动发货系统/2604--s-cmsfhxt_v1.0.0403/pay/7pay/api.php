<?php
require_once("../../conn/conn.php");
require_once("../../conn/function.php");

$action=$_GET["action"];
$D_domain=splitx($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"],"/pay",0);

if($action=="pay"){
    $money=round($_POST["fee"],2);
    $return_url=gethttp().$D_domain."/member/list.php";
    $M_id=$_POST["M_id"];
    $no=date("YmdHis").gen_key(10,2);
    $notify_url=gethttp().$D_domain."/pay/7pay/callback.php";

    if($money>0){
        $sign=strtolower(md5("body=账户充值".$money."元&fee=".$money."&no=".$no."&notify_url=".$notify_url."&pid=".$C_7pay_pid."&remark=".$M_id."&return_url=".$return_url."&key=".$C_7pay_pkey));
        Header("Location: http://7-pay.cn/pay.php?body=账户充值".$money."元&fee=".$money."&no=".$no."&notify_url=".$notify_url."&pid=".$C_7pay_pid."&remark=".$M_id."&return_url=".$return_url."&sign=".$sign);
        die();
    }else{
        box("金额需大于0元","back","error");
    }
}

if($action=="unlogin"){
	$type=$_POST["type"];
    if(is_array($_POST["email"])){
        for ($i=0 ;$i<count($_POST["email"]);$i++ ) {
            $email=$email.$_POST["email"][$i]." ";
        }
    }else{
        $email=$_POST["email"];
    }

    $id=intval($_POST["id"]);
    $M_id=intval($_POST["M_id"]);
    $num=intval($_POST["num"]);
    if($num==0){
        $num=1;
    }
    $no = date("YmdHis");
    $genkey=$_POST["genkey"];
    $body=$type."|".$id."|".$genkey."|".$email."|".$num."|".$M_id."|".intval($_SESSION["uid"]);

    $sql="Select * from sl_member where M_id=".intval($M_id);
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $M_id=$row["M_id"];
    $M_email=$row["M_email"];
    $M_money=$row["M_money"];
    $M_viptime=$row["M_viptime"];
    $M_viplong=$row["M_viplong"];

    if($M_viplong-(time()-strtotime($M_viptime))/86400>0){
        $M_vip=1;
        if($M_viplong>30000){
            $N_discount=$C_n_discount2/10;
            $P_discount=$C_p_discount2/10;
        }else{
            $N_discount=$C_n_discount/10;
            $P_discount=$C_p_discount/10;
        }
    }else{
        $M_vip=0;
        $N_discount=1;
        $P_discount=1;
    }

    $notify_url=gethttp().$D_domain."/pay/7pay/callback2.php";

    if($type=="news"){
        $sql="select * from sl_news where N_id=".$id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $subject=mb_substr($row["N_title"],0,10,"utf-8")."...-付费阅读";
        $money=$row["N_price"]*$N_discount;
        $return_url=urlencode(gethttp().$D_domain."/pay/7pay/return.php?type=news&id=$id&genkey=$genkey");
    }
    
    if($type=="product"){
        $sql="select * from sl_product where P_id=".$id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $subject=mb_substr($row["P_title"],0,10,"utf-8")."...-购买";
        $money=$row["P_price"]*$num*$P_discount;
        $return_url=urlencode(gethttp().$D_domain."/pay/7pay/return.php?type=product&genkey=$genkey&id=$id");
    }

    if($money>0){
        $sign=strtolower(md5("body=".$subject."&fee=".$money."&no=".$no."&notify_url=".$notify_url."&pid=".$C_7pay_pid."&remark=".$body."&return_url=".$return_url."&key=".$C_7pay_pkey));
        Header("Location: http://7-pay.cn/pay.php?body=".$subject."&fee=".$money."&no=".$no."&notify_url=".$notify_url."&pid=".$C_7pay_pid."&remark=".$body."&return_url=".$return_url."&sign=".$sign);
        die();
    }else{
        box("订单金额需大于0元","back","error");
    }
}

?>