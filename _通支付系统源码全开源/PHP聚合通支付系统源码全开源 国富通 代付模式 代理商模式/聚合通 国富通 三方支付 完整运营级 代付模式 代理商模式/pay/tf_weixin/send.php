<?php

header ( 'Content-type:text/html;charset=UTF-8' );
include_once("lib/unionpay_submit.class.php");
/**************************请求参数**************************/ 
  
		$parameter = array(
				
				"bankLink"=> $_GET['bankcode'],//银联号 
				//"bankLink"=> '01050000',//银联号 
				"cardType"=> '0',//卡类型 
				"command"=>"BMPC004",//指令
				"currency"=> "CNY",//币种 
				"dateTime" =>date("Ymdhis",time()),
				"groupCode"=>"G910000000001078",//商户号
				"merchantCode"=> "M00000000003118",//商户编号 
				"notifyUrl"=> "http://".$_SERVER['HTTP_HOST']."/pay/tf_weixin/notifyUrl.php",//回调URL 
				"orderNum" =>$_GET['orderid'],
				"payMoney" =>$_GET['price']*100,
				"productName" =>$_GET['orderid'],
				"returnUrl"=> $_GET['returnUrl'],//成功返回URL
				"signType"=>"MD5",
				"terminalCode"=> "T0000000004788",//终端编号 
				//"randomCode"=> "123456789",// 
				
		);
	 
		// print_r($parameter);
		// die;
		//建立请求
		
		$Submit = new UnionpaySubmit(); 
		
		$html_text = $Submit->buildRequestForm($parameter,"POST", "确认");
		$arr=json_decode($html_text,true);
 //print_r($arr);


 
	//$data['pmt_tag']			= "Weixin";
	$title="微信";
	$code="scan_weixin";
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width,height=device-height,inital-scale=0.8,maximum-scale=0.8,user-scalable=no;">
    <title><?php echo $title?>扫码</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link href="css/css.css" type="text/css" rel="stylesheet" />
    <!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.qrcode.min.js"></script>


    <!--<script src="http://cdn.staticfile.org/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>-->
    <script src="js/Base64.js"></script>
    <script src="js/fingerprint2.js"></script>

</head>
<body>
    <div class="sweep">
        <div class="wrap">
            <div class="h100" id="res">
                <div class="m26">
                    <h1><div id="msg">订单提交成功，请您尽快付款！</div></h1>
                    <div class="num"><span><font color='Red' size='4px'>订单<?php echo $_GET['orderid']?></font></span><span class="color1 ml16">使用手机登陆<?php echo $title ?>扫描二维码</span></div>
                </div>
            </div>
            <!--订单信息代码结束-->
            <!--扫描代码-->
            <div class="s-con" id="codem">
                <div class="title">
                    <span class="blue" style="font-size:20px;">
                        <span>应付金额：</span><span class="orange"><?php echo $_GET['price']?></span> 元
                        <br /><span style="font-size:12px;">此交易委托<?php echo $title?>收款</span>
                    </span>
                </div>
                <div class="<?php echo $code?>">
                    <div id="divQRCode" class="divQRCode"></div>
                    <div class="question">
                        <div class="new"></div>
                    </div>
                </div>
                <div id="yzchdiv">
                    <input id="orderno" type="hidden" value="<?php echo $arr['orderNum']?>" />
                    <input id="hidUrl" type="hidden" value="<?php echo $arr['payUrl']?>" />
                </div>
                <!--扫描代码结束-->
                <!--底部代码-->
                <div class="s-foot">  Copyright?2016-2017 All Rights Reserved.</div>
                <!--底部代码结束-->
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {


        var hdurl = $('#hidUrl').val();



        var isIe = /msie/.test(navigator.userAgent.toLowerCase());

        // alert(isIe);

        var temp = 'canvas';
        if (isIe) {
            temp = 'table';
        }

        var fp = new Fingerprint2();
        fp.get(function(result) {
            if (typeof window.console !== "undefined") {

                console.log(result);
            }
            var orderno = $('#orderno').val();


            if (hdurl != null && hdurl != '') {
                //hdurl = BASE64.decoder(hdurl);
               
                $('#divQRCode').qrcode({
                    render: temp, //table方式
                    width: 288, //宽度
                    height: 288, //高度
                    text: hdurl //任意内容
                });
                if (temp == 'table') {
                    $('#divQRCode').css('top', '-136px');
                    $('#divQRCode').css('left', '239px');
                }
            }



        });


         refresh();
        function refresh() {
            var orderno = $('#orderno').val();
            $.ajax({
                url: 'returnUrl.php?ordernumber=' + orderno,
                type: 'GET',
                cache: false,
                success: function(data) {
				 
                    if (data==1){
						alert("支付成功！");
						window.location = '<?php echo $_GET['returnUrl'];?>';
					} 
                       
                }
            });
        }
        setInterval(refresh, 3000);
    });
</script>
