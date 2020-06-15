<?php

class UnionpaySubmit {

	
	/**
	 *网关地址（新）
	 */
	//var $unionpay_gateway_new = 'http://139.224.195.30:13801/r/ra/pay/downChannel/gateway/ebankUionPay';
	var $unionpay_gateway_new = 'http://139.224.195.30:13801/r/ra/pay/downChannel/partnerBusiness';

	
	

	function buildRequestForm($para, $method, $button_name) {
		//待请求参数数组
		
		
	 
		$signval="";
		while (list ($key, $val) = each ($para)) {
		   $val=$this->yz($val);//过滤	
			if($key!="randomCode"){
              $sHtml[$key]= $val;
			}
			$signval.=$val;//$this->utf8_unicode($val);
        }
		
        //$signval=$signval.
		//submit按钮控件请不要含有name属性
		$signval=$signval."jd2E232ADEda2e2aeP32";
        $sHtml['sign'] = md5($signval);
 
		
		$url = $this->unionpay_gateway_new;
		$data= $sHtml;
		$curl = curl_init();
		//设置抓取的url
		curl_setopt($curl, CURLOPT_URL,$url);
		//设置头文件的信息作为数据流输出
		curl_setopt($curl, CURLOPT_HEADER, 0);
		//设置获取的信息以文件流的形式返回，而不是直接输出。
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		//设置post方式提交
		curl_setopt($curl, CURLOPT_POST, 1);
		//设置post数据
	 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		//执行命令
		$data = curl_exec($curl);
		//关闭URL请求
		curl_close($curl);
		//显示获得的数据
		return $data;
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