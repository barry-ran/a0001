<?php
namespace WY\app\model;

use WY\app\libs\Http;
use WY\app\libs\Xml;
if (!defined('WY_ROOT')) {
    exit;
}
class Tfpay
{
    function __construct()
    {
        // $this->gateUrl = 'https://gwapi.yemadai.com/transfer/transferapi';
        // $this->notifyurl = 'http://' . $_SERVER['HTTP_HOST'] . '/yimadai';
        // $this->accountNumber = '22820';
        // $this->key = 'OGdkk9F9adfl72kDk3';
    }
    public function put($data)
    {
		
		$parameter = array(
				"accountName" =>$_POST['realname'],
				"bankCard" =>$_POST['baname'],
				"bankLinked" =>$_POST['bankLinked'],
				"bankName" =>$_POST['baaddr'].$_POST['realname'],
				"command"=>"BMPC009",//指令
				"dateTime" =>date("Ymdhis",time()),
				"groupCode"=>"G910000000001078",//商户号
				"merchantCode"=> "M00000000003118",//商户编号 
				"orderNum" =>date("Ymdhis",time()).rand(10,99),
				"signType"=>"MD5",
				"terminalCode"=> "T0000000004788",//终端编号 
				"transDate" =>date("Ymd",time()),
				"transMoney" =>$_POST['money']*100,
				"transTime" =>date("His",time()),
 
		);
 
		// print_r($parameter);
		// die;
		//建立请求
		
 
		$html_text = $this->buildRequestForm($parameter,"POST", "确认");
		$arr=json_decode($html_text,true);
 
		
        
        if ($arr) {
            $ret = array('resCode' => $arr[platRespMessage], 'resContent' => $arr[platRespMessage]);
         
        }
        return $ret;
    }
    public function getRet($code)
    {
        $codeList = array('0000' => '请求成功', 'ERR1001' => 'IP白名单未绑定', 'ERR1002' => 'xml格式错误', 'ERR1003' => 'secureCode验证错误', 'ERR1004' => '最大转账笔数超过50笔或者小于1笔', 'ERR1005' => '含有必要参数为空', 'ERR1006' => 'Base64解析错误', 'ERR1007' => '账户错误或者不存在此账户', 'ERR1008' => '金额小于0', 'ERR1009' => '金额错误', 'ERR1010' => '余额不足', 'ERR1011' => '系统异常', 'ERR1012' => '订单号重复', 'ERR2001' => '开户名与卡号不匹配', 'ERR2002' => '开户行与卡号不匹配', 'ERR2003' => '省、市信息不匹配', 'ERR5002' => '商户未开通下发权限', 'ERR5003' => '下发超过单笔限额设置', 'ERR5005' => '商户下发超过单日限额');
        return array_key_exists($code, $codeList) ? $codeList[$code] : '未知错误';
    }
	public function buildRequestForm($para, $method, $button_name) {
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
		$signval=$signval."MgtygbF676h89g2svbz";
		
        $sHtml['sign'] = md5($signval);
		
		// print_r($sHtml);
		// die;
		$url = "http://139.224.195.30:8090/r/ra/pay/downChannel/partnerBusiness";
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
	public function yz($str){ //防sql注入
	   return addslashes(strip_tags(htmlspecialchars(trim($str))));
	}
}