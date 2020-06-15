
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=0.8,maximum-scale=0.8,user-scalable=no;">
<title>聚合通，让支付更简单</title>
 
<link rel="stylesheet" type="text/css" href="css/css.css">
 
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
 
</head>

<body>

 <script type="text/javascript">

        if (!window.jQuery) {
            document.write('<script type="text/javascript" src="/script/jquery.js"><' + '/script>');
        }
        /*if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            window.location.href = "Mobile.php";
        }*/

 </script>

 

<form name='type' method="get" action="pay.php" target="_blank">
<input size="50" type="hidden" name="total_fee" value="10.00" />
<!-- 内容 begin  -->
<div id="content">

<div class="sb">

<div class="centersb" id="orderDetails">

<ul>

	<li style="font-size: 18px;"><strong>商品金额：</strong><span id="orderId" style="color:#F00">10元</span></li>

	<li><strong>商品名称：</strong><span id="goodsName"><a href="http://www.1yytd.com" title="pay">在线体验</a></span></li>

	<li><strong>商户信息：</strong>聚合通 在线体验</li>



</ul>
</div>

<div class="rightsb">
<p><font color="#FF6600" size="+2" style="font-weight: bold;"
	id="countNum">&yen; 10.00</font>元</p>
<div style="background: #0590da; text-align: center; width: 90px; height: 26px; position: relative; top: 25px; left: 30px; color:#f5f5f5;"
	onClick="showMoreDetails();">订单详情</div>
</div>

</div>



<div class="	">


<style type="text/css">
	  .credit-icon{background: url(images/credit.png) no-repeat; display:inline-block; width:13px; height:18px;position:absolute;  cursor:pointer;}
</style>
<div class="zhifu"><span id="payTitle" style="font-size: 17px;">快捷支付：</span>



    
    
    <!-- 支付类型 -->
    
    <div id="payTypeList" class="bankWrap" style="margin-top:20px; height:auto; overflow:hidden;">
    
    <ul>
    
    	<li>
            <label>
                <input type="radio" checked name="pd_FrpId" value="alipay" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/alipay.png) no-repeat center center; margin-left:10px" title="支付宝"></div>
           </label>
        </li>
    	<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="weixin" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/wxsm.png) no-repeat center center; margin-left:10px" title="微信扫码支付"></div>
           </label>
        </li>
		<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="wxh5" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/wxwap.png) no-repeat center center; margin-left:10px" title="微信H5支付"></div>
           </label>
        </li>
		<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="qqrcode" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/qqsm.png) no-repeat center center; margin-left:10px" title="QQ扫码支付"></div>
           </label>
        </li>
		<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="qqwallet" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/qq1.gif) no-repeat center center; margin-left:10px" title="QQ钱包支付"></div>
           </label>
        </li>
		<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="tenpaywap" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/qqwap.png) no-repeat center center; margin-left:10px" title="QQWAP"></div>
           </label>
        </li>
        <li><a href="fastbank/" target="_blank">
            <label>
                
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/ylzx.png) no-repeat center center; margin-left:10px" title="快捷支付"></div>
           </label></a>
        </li>
    </ul>
    </div>
</div>
 
<div class="zhifu"><span id="payTitle" style="font-size: 17px;">公众号支付：</span>



    
    
    <!-- 支付类型 -->
    
    <div id="payTypeList" class="bankWrap" style="margin-top:20px">
    
    <ul>
     
    	<li>
            <label>
                <input type="radio"  name="pd_FrpId" value="gzhpay" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/wxgzh.png) no-repeat center center; margin-left:10px" title="微信扫码支付"></div>
           </label>
        </li>
       
    </ul>
    </div>
</div>
<div style="height:30px; width:100%"></div>
<div class="zhifu"><span id="payTitle" style="font-size: 17px;">网银支付OR信用卡支付：</span>

<div id="payTypeList" class="bankWrap" style="margin-top:20px; height:auto; overflow:hidden;">
    
    <ul>
     
    	<li>
           <label>
                <input type="radio"  name="pd_FrpId" value="bank" style="margin-top:10px;float:left; height:13px;" />
                <div class="iw" style=" padding-top:3px; padding-bottom:3px;background:url(images/bank.png) no-repeat center center; margin-left:10px;    background-size:auto 100%;" title="网银支付"></div>
           </label>
        </li>
       
    </ul>
    </div><br>
 
<!-- 支付类型 -->

<div id="payTypeList" class="bankWrap banklist" style="margin-top:20px; display:none;">

<ul>

    <li>
		<label>
	        <input type="radio" name="pd_code" value="ICBC"  style="margin-top:10px;float:left; height:13px;" />
            <div class="iw ICBC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="工商银行"></div>
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="CCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="建设银行"></div>
	   </label>
       
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="ABC" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw ABC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="农业银行"></div>
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="CMB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CMBCHINA" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="招商银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="BOCSH" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw BOC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中国银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="BOCOM" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw BOCO" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="交通银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="PSBC" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw POST" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中国邮政储蓄"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="CEB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CEB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="光大银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="GDB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw GDB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="广东发展银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="CIB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CIB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="兴业银行"></div>
	   </label>
	</li>
    
    <li>
		<label>
	        <input type="radio" name="pd_code" value="SPDB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SPDB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海浦东发展银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="CMBC" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw CMBC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="民生银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="CNCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw ECITIC" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="中信银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="PAB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw PINGANBANK" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="平安银行"></div>
            
	   </label>
	</li>
     
    <li>
		<label>
	        <input type="radio" name="pd_code" value="BOS" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SHB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海银行"></div>
            
	   </label>
	</li>
    <li>
		<label>
	        <input type="radio" name="pd_code" value="SRCB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw SRCB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="上海农村商业银行"></div>
            
	   </label>
	</li>
      
    <li>
		<label>
	        <input type="radio" name="pd_code" value="HXB" style="margin-top:10px;float:left; height:13px;"  />
            <div class="iw HXB" style=" padding-top:3px; padding-bottom:3px; margin-left:10px" title="华夏银行"></div>
            
	   </label>
	</li>
  
</ul>

</div>

</div>
<table
	style="width: 100%; height: 50px; border: 0;">

	<tr style="background-color: #fff;border:0">

		<td style="background-color: #fff;border:0" align="right"><input type="image" id="btn_pay" src="images/pay.png" onClick="return pay();" /></td>

	</tr>

</table>

</div>

</div>






</form>
<script>
$("input[type='radio']").click(function(){

	if($(this).val()=='bank' || $("input[value='bank']:checked").val()=='bank'){
		$('.banklist').show();
	}else{
		$('.banklist').hide();
	}
});
</script>

<!-- 内容 end -->
 

</body>
</html>