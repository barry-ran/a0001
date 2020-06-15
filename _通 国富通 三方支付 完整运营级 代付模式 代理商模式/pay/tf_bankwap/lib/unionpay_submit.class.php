<?php

class UnionpaySubmit {

	
	/**
	 *网关地址（新）
	 */
	var $unionpay_gateway_new = 'http://channel.maokung.com/r/ra/pay/downChannel/gateway/unionWap';
	//var $unionpay_gateway_new = 'http://139.224.195.30:13801/r/ra/pay/downChannel/partnerBusiness';

	
	

	function buildRequestForm($para, $method, $button_name) {
		//待请求参数数组
		
		
		$sHtml = "<form id='unionpaysubmit' name='unionpaysubmit' action='".$this->unionpay_gateway_new."' method='".$method."'>";
		$signval="";
		while (list ($key, $val) = each ($para)) {
		   $val=$this->yz($val);//过滤	
			if($key!="randomCode"){
              $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/><br/>";
			}
			$signval.=$val;//$this->utf8_unicode($val);
        }
		
        //$signval=$signval.
		//submit按钮控件请不要含有name属性
		$signval=$signval."MgtygbF676h89g2svbz";
        $sHtml = $sHtml."<input type='hidden' name='sign' value='".md5($signval)."'></form>";
		// print_R($sHtml);
		// die;
		$sHtml = $sHtml."<script>document.forms['unionpaysubmit'].submit();</script>";
		
		return $sHtml;
	}
	/*function htou($c) {
	  $n = (ord($c[0]) & 0x1f) << 12;
	  $n += (ord($c[1]) & 0x3f) << 6;
	  $n += ord($c[2]) & 0x3f;
	  return $n;
	}
	//在代码中隐藏utf8格式的字符串
	function utf8_unicode($str) {
	  $encode='';
	  for($i=0;$i<strlen($str);$i++) {
		if(ord(substr($str,$i,1))> 0xa0) {
		  $encode.='&#'.$this->htou(substr($str,$i,3)).';';
		  $i+=2;
		} else {
		  $encode.='&#'.ord($str[$i]).';';
		}
	  }
	  return $encode;
	}*/
	
	function yz($str){ //防sql注入
	   return addslashes(strip_tags(htmlspecialchars(trim($str))));
	}

	
	
}
?>