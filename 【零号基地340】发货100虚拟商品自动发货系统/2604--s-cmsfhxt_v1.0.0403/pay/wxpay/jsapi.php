<?php
require_once("../../conn/conn.php");
require_once("../../conn/function.php");

$D_domain=splitx($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"],"/pay",0);

$M_id=intval($_REQUEST["M_id"]);
$fee=$_REQUEST["fee"];
$genkey=$_REQUEST["genkey"];

$APPID = $C_wx_appid;
$MCHID = $C_wx_mchid;
$KEY = $C_wx_key;
$APPSECRET = $C_wx_appsecret;
	
$NOTIFY_URL = gethttp().$D_domain."/pay/wxpay/notify_url.php";

if($genkey==""){
	$body="用户充值" . $fee . "元";
	$attach=$M_id;
	$total_fee=$fee*100;
}else{
	$type=$_REQUEST["type"];
    if(is_array($_REQUEST["email"])){
        for ($i=0 ;$i<count($_REQUEST["email"]);$i++ ) {
            $email=$email.$_REQUEST["email"][$i]." ";
        }
    }else{
        $email=$_REQUEST["email"];
    }
    $id=intval($_REQUEST["id"]);
    $M_id=intval($_REQUEST["M_id"]);
    $num=intval($_REQUEST["num"]);
    $attach=$type."|".$id."|".$genkey."|".$email."|".$num."|".$M_id."|".intval($_SESSION["uid"]);

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

    if($type=="news"){
        $sql="select * from sl_news where N_id=".$id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $body=mb_substr($row["N_title"],0,10,"utf-8")."...-付费阅读";
        $total_fee=$row["N_price"]*100*$N_discount;
    }
    if($type=="product"){
        $sql="select * from sl_product where P_id=".$id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $body=mb_substr($row["P_title"],0,10,"utf-8")."...-购买";
        $total_fee=$row["P_price"]*100*$num*$P_discount;
    }
}
$product_id=1;
$out_trade_no = date("YmdHis");

$Code = $_GET["code"];
$info=getbody("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$APPID."&secret=".$APPSECRET."&code=".$Code."&grant_type=authorization_code","");

$openid=json_decode($info)->openid;

$sign=strtoupper(MD5("appid=".$APPID."&attach=".$attach."&body=".$body."&mch_id=".$MCHID."&nonce_str=".$out_trade_no."&notify_url=".$NOTIFY_URL."&openid=".$openid."&out_trade_no=".$out_trade_no."&spbill_create_ip=127.0.0.1&total_fee=".$total_fee."&trade_type=JSAPI&key=".$KEY));

$info=getbody("https://api.mch.weixin.qq.com/pay/unifiedorder","<xml><appid>".$APPID."</appid><attach>".$attach."</attach><body>".$body."</body><mch_id>".$MCHID."</mch_id><nonce_str>".$out_trade_no."</nonce_str><notify_url>".$NOTIFY_URL."</notify_url><openid>".$openid."</openid><out_trade_no>".$out_trade_no."</out_trade_no><spbill_create_ip>127.0.0.1</spbill_create_ip><total_fee>".$total_fee."</total_fee><trade_type>JSAPI</trade_type><sign>".$sign."</sign></xml>");

$postObj = simplexml_load_string($info);

$prepay_id=$postObj->prepay_id;

$timeStamp=time();
$nonceStr=gen_key(20);
$signType="MD5";

$paySign=strtoupper(MD5("appId=".$APPID."&nonceStr=".$nonceStr."&package=prepay_id=".$prepay_id."&signType=MD5&timeStamp=".$timeStamp."&key=".$KEY));

$jsApiParameters='{"appId":"'.$APPID.'","timeStamp":"'.$timeStamp.'","nonceStr":"'.$nonceStr.'","package":"prepay_id='.$prepay_id.'","signType":"MD5","paySign":"'.$paySign.'"}';
if($genkey==""){
	Header("Location: ../../member/pay.php?jsApiParameters=".$jsApiParameters."&O_id=".$O_id."&money=".$fee);
}else{
	Header("Location: ../../conn/unlogin.php?jsApiParameters=".$jsApiParameters."&id=".$id."&type=".$type."&genkey=".$genkey);
}
?>