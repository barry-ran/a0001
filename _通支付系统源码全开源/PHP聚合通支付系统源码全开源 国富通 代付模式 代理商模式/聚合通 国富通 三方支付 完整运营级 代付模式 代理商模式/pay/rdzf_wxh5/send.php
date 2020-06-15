<?php

include_once("config/pay_config.php");
 
/*
 * 获取表单数据
 * */
$order_id = $_GET['orderid']; //您的订单Id号，你必须自己保证订单号的唯一性，瑞德云计费不会限制该值的唯一性
$payType = 'bank';  //充值方式：bank为网银，card为卡类支付
$account = $_GET['orderid'];  //充值的账号
$amount = $_GET['price'];   //充值的金额

 
switch($_GET['bankcode']){
	case 'wxh5':
		$bankType=1007; //银行类型
		break;
	default:
}
 
    /*
     * 提交数据
     * */
    include_once("ruide/class.bankpay.php");
    $bankpay = new bankpay();
    $bankpay->parter = $ruide_merchant_id;  //商家Id
    $bankpay->key = $ruide_merchant_key; //商家密钥
    $bankpay->type = $bankType;   //商家密钥
    $bankpay->value = $amount;    //提交金额
    $bankpay->orderid = $order_id;   //订单Id号
    $bankpay->callbackurl = $ruide_callback_url; //下行url地址
    $bankpay->hrefbackurl = $ruide_bank_hrefbackurl; //下行url地址
    //发送
    $bankpay->send();
 
?>