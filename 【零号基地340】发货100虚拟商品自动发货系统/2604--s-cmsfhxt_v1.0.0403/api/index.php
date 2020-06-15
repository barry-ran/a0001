<?php
require '../conn/conn.php';
require '../conn/function.php';
require 'xsshtml.class.php';

$action=$_GET["action"];
$id=intval($_GET["id"]);
$path=splitx($_SERVER["PHP_SELF"],"api",0);
$D_domain=splitx($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"],"/api",0);

switch($action){
	case "config":
	$sql="select C_logo,C_title from sl_config";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$row["C_logo"]=img($row["C_logo"]);
	$api=json_encode($row);
	break;

	case "login":
	$M_login=t($_POST["login"]);
	$M_pwd=$_POST["pwd"];

	$sql = "select * from sl_member where (M_email='" . $M_login . "' or M_login='" . $M_login . "') and M_pwd='" . md5($M_pwd) . "' and M_del=0";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
    	$row["msg"]="success";
    	$api=json_encode($row);
    }else{
        $api="{\"msg\":\"帐号或密码错误\"}";
    }

	break;

	case "member_info":

	$M_id=intval($_GET["M_id"]);
	$M_pwd=t($_GET["M_pwd"]);

	$sql = "select * from sl_member where M_id=".$M_id." and M_pwd='".$M_pwd."' and M_del=0";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
    	$row["msg"]="success";
    	$row["M_head"]=img($row["M_head"]);
    	$api=json_encode($row);
    }else{
        $api="{\"msg\":\"未发现该账号\"}";
    }
	break;

	case "index_product":

	//焦点图
	$sql="select * from sl_slide where S_del=0 order by S_order,S_id desc";
		    $result = mysqli_query($conn, $sql);
		    $arr = array();  
		    while($row = mysqli_fetch_array($result)) {
		    $row["S_pic"]=img($row["S_pic"]);
		    $count=count($row);
		      for($i=0;$i<$count;$i++){ 
		        unset($row[$i]);
		      }   
		    array_push($arr,$row);
		} 
	$slide=$arr;

	//产品分类
	$sql="select * from sl_psort where S_del=0 order by S_sub,S_order,S_id desc limit 7";
		    $result = mysqli_query($conn, $sql);
		    $arr = array();  
		    while($row = mysqli_fetch_array($result)) {
		    $row["S_pic"]=img($row["S_pic"]);
		    $count=count($row);
		      for($i=0;$i<$count;$i++){ 
		        unset($row[$i]);
		      }   
		    array_push($arr,$row);
		} 
	$psort=$arr;

	//猜你喜欢
	$sql="select P_id,P_title,P_pic,P_price,P_sort,P_sold from sl_product where P_del=0 and P_sh=1 order by rand() limit 20";
		    $result = mysqli_query($conn, $sql);
		    $arr = array();  
		    while($row = mysqli_fetch_array($result)) {
		    $row["P_pic"]=img(splitx($row["P_pic"],"|",0));
		    $count=count($row);
		      for($i=0;$i<$count;$i++){ 
		        unset($row[$i]);
		      }   
		    array_push($arr,$row);
		} 
	$guess=$arr;


	$index = array(); 
	$index["slide"]=$slide;
	$index["psort"]=$psort;
	$index["guess"]=$guess;

	$api=json_encode($index);

	break;

	case "search":
	$keyword = t($_GET["keyword"]);

	$sql="select N_pic,N_title,N_id,S_title from sl_news,sl_nsort where N_del=0 and N_sh=1 and S_del=0 and N_sort=S_id and N_title like '%".$keyword."%' order by N_id desc";
	$result = mysqli_query($conn, $sql);
	$arr = array();  
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$row["N_pic"]=img($row["N_pic"]);
			$count=count($row);
		      for($i=0;$i<$count;$i++){ 
		        unset($row[$i]);
		      }   
		    array_push($arr,$row);
		}
	}
	$news=$arr;

	$sql="select P_pic,P_title,P_id,S_title from sl_product,sl_psort where P_del=0 and P_sh=1 and S_del=0 and P_sort=S_id and P_title like '%".$keyword."%' order by P_id desc";
	$result = mysqli_query($conn, $sql);
	$arr = array();  
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$row["P_pic"]=img(splitx($row["P_pic"],"|",0));
			$count=count($row);
		      for($i=0;$i<$count;$i++){ 
		        unset($row[$i]);
		      }   
		    array_push($arr,$row);
		}
	}
	$product=$arr;

	$search = array(); 
	$search["news"]=$news;
	$search["product"]=$product;

	$api=json_encode($search);

	break;

	case "guestbook":

	$G_title = t($_POST["G_title"]);
	$G_name = t($_POST["G_name"]);
	$G_mail = t($_POST["G_mail"]);
	$G_phone = t($_POST["G_phone"]);
	$G_msg = t($_POST["G_msg"]);

	if(strpos($G_mail,"@")===false || strpos($G_mail,".")===false){
		$api="请填写一个正确的邮箱！";
	}else{
		if(strlen($G_phone)!=11 || !is_numeric($G_phone)){
			$api="请填写一个正确的手机号码！";
		}else{
			mysqli_query($conn, "insert into sl_guestbook(G_title,G_name,G_mail,G_phone,G_msg,G_time,G_reply) values('$G_title','$G_name','$G_mail','$G_phone','$G_msg','".date('Y-m-d H:i:s')."','')");
    		$api="success";
		}
	}
	break;

	case "contact":
	$sql="select * from sl_text where T_type=1";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$row["latitude"]=splitx($row["T_zb"],",",1);
	$row["longitude"]=splitx($row["T_zb"],",",0);

	$xss = new XssHtml($row["T_content"]);
	$row["T_content"] = $xss->getHtml();

	$kf=explode("|",$C_kefu);
	for($i=0;$i<count($kf);$i++){
		$kefu=$kefu."{\"info\":\"".splitx($kf[$i],"_",0)."\",\"type\":\"".splitx($kf[$i],"_",1)."\",\"job\":\"".splitx($kf[$i],"_",2)."\"},";
	}

	$kefu= substr($kefu,0,strlen($kefu)-1);

	$row["T_kefu"]=json_decode("[".$kefu."]");

	$api=json_encode($row);

	break;
	case "product_list":
//获取该分类下所有的商品
		if($id>0){
			$sql="select P_id,P_title,P_pic,P_price,P_sort,P_sold from sl_product,sl_psort where P_del=0 and P_sh=1 and S_del=0 and P_sort=S_id and (S_id=".$id." or S_sub=".$id.") order by P_order,P_id desc";
		}else{
			$sql="select P_id,P_title,P_pic,P_price,P_sort,P_sold from sl_product,sl_psort where P_del=0 and P_sh=1 and S_del=0 and P_sort=S_id order by P_order,P_id desc";
		}
	
		    $result = mysqli_query($conn, $sql);
		    $arr = array();  
		    while($row = mysqli_fetch_array($result)) {
		    $row["P_pic"]=img(splitx($row["P_pic"],"|",0));
		    $count=count($row);
		      for($i=0;$i<$count;$i++){ 
		        unset($row[$i]);
		      }   
		    array_push($arr,$row);
		} 
	$productlist=$arr;
//获取该分类的详细信息
//
	if($id>0){
		$sql="select * from sl_psort where S_id=".$id;
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$psort=$row;
	}else{
		$psort=json_decode("{\"S_title\":\"全部商品\"}");
	}
	
	if(getrs("select * from sl_psort where S_id=$id","S_sub")==0){
		$psort2=$id;
	}else{
		$psort2=intval(getrs("select * from sl_psort where S_id=$id","S_sub"));
	}
//获取所有子分类
	$sql="select * from sl_psort where S_sub=$psort2 and S_del=0 order by S_order,S_id desc";
	$result = mysqli_query($conn, $sql);
		$arr = array();  
		while($row = mysqli_fetch_array($result)) {
		$count=count($row);
		  for($i=0;$i<$count;$i++){ 
		    unset($row[$i]);
		  }   
	    array_push($arr,$row);
	} 
	$psortlist=$arr;

//获取所有商品大分类
	$sql="select * from sl_psort where S_sub=0 and S_del=0 order by S_order,S_id desc";
		$result = mysqli_query($conn, $sql);
		$arr = array();  
		while($row = mysqli_fetch_array($result)) {
		$count=count($row);
		  for($i=0;$i<$count;$i++){ 
		    unset($row[$i]);
		  }   
	    array_push($arr,$row);
	} 
	$psortlist2=$arr;

	$arr = array(); 
	$arr["productlist"]=$productlist;
	$arr["psort"]=$psort;
	$arr["psort2"]=$psort2;
	$arr["psortlist"]=$psortlist;
	$arr["psortlist2"]=$psortlist2;

	$api=json_encode($arr);

	break;

	case "psort":
	$sql="select * from sl_psort where S_del=0 and S_sub=0 order by S_order,S_id";
	    $result = mysqli_query($conn, $sql);
	    $arr = array();  
	    while($row = mysqli_fetch_array($result)) {

	    $sql2="select * from sl_psort where S_del=0 and S_sub=".$row["S_id"]." order by S_order,S_id";
	    $result2 = mysqli_query($conn, $sql2);
	    $arr2 = array();  
	    while($row2 = mysqli_fetch_array($result2)) {
	    $row2["S_pic"]=img(splitx($row2["S_pic"],"|",0));
	    $count2=count($row2);
	      for($j=0;$j<$count2;$j++){ 
	        unset($row2[$j]);
	      }
	    array_push($arr2,$row2);
		} 

	    $row["S_pic"]=img($row["S_pic"]);
	    $row["S_sub"]=$arr2;
	    $count=count($row);
	      for($i=0;$i<$count;$i++){ 
	        unset($row[$i]);
	      }
	    array_push($arr,$row);

	} 
	$api=json_encode($arr);
	break;



case "news_list":
$page=intval($_GET["page"]);

if($page==0){
	$page=1;
}
if($id>0){
		$sql="select N_id,N_title,N_pic,N_date,N_view,N_author from sl_news,sl_nsort where N_del=0 and N_sh=1 and N_sort=S_id and (S_id=".$id." or S_sub=".$id.") order by N_order,N_id desc limit ".(($page-1)*10).",10";
	}else{
		$sql="select N_id,N_title,N_pic,N_date,N_view,N_author from sl_news,sl_nsort where N_del=0 and N_sh=1 and N_sort=S_id order by N_order,N_id desc limit ".(($page-1)*10).",10";
	}

	    $result = mysqli_query($conn, $sql);
	    $arr = array();  
	    while($row = mysqli_fetch_array($result)) {
	    $row["N_pic"]=img($row["N_pic"]);
	    $count=count($row);
	      for($i=0;$i<$count;$i++){ 
	        unset($row[$i]);
	      }   
	    array_push($arr,$row);
	} 
$newslist=$arr;

$arr = array(); 
$arr["newslist"]=$newslist;

$api=json_encode($arr);

break;

	case "member_nsort":
	$sql="select * from sl_nsort where S_sub=0";
		$result = mysqli_query($conn, $sql);
		$arr = array();  
		while($row = mysqli_fetch_array($result)) {
		$count=count($row);
		  for($i=0;$i<$count;$i++){ 
		    unset($row[$i]);
		  }   
	    array_push($arr,$row);
	} 
	$api=json_encode($arr);

	break;

	case "product_listx":
	$sql="select P_id,P_title,P_pic,P_price,P_sort,P_sold from sl_product,sl_psort where P_del=0 and P_sh=1 and S_del=0 and P_sort=S_id and (S_id=".$id." or S_sub=".$id.") order by P_order,P_id desc";
		    $result = mysqli_query($conn, $sql);
		    $arr = array();  
		    while($row = mysqli_fetch_array($result)) {
		    $row["P_pic"]=img(splitx($row["P_pic"],"|",0));
		    $count=count($row);
		      for($i=0;$i<$count;$i++){ 
		        unset($row[$i]);
		      }   
		    array_push($arr,$row);
		} 
	$api=json_encode($arr);
	break;

	case "product_info":
	$sql="select * from sl_product where P_id=".$id;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$pic=explode("|",$row["P_pic"]);
	for($i=0;$i<count($pic);$i++){
		$p=$p."{\"pic\":\"".img($pic[$i])."\"},";
	}
	$p= substr($p,0,strlen($p)-1);
	$row["P_list"] = json_decode("[".$p."]");
	$row["P_content"]=str_replace("src=\"".$path."kindeditor/","src=\"http://".$_SERVER["HTTP_HOST"].$path."kindeditor/",$row["P_content"]);

	$xss = new XssHtml($row["P_content"]);
	$row["P_content"] = $xss->getHtml();


	$sql2="select M_head,M_login,O_title,O_time,O_num from sl_orders,sl_member where not O_state=2 and O_mid=M_id and O_pid=$id and O_del=0 and M_del=0 order by O_id desc";//购买记录
		$result2 = mysqli_query($conn, $sql2);
		$arr = array();  
		while($row2 = mysqli_fetch_array($result2)) {
		$row2["M_head"]=img($row2["M_head"]);
		$count=count($row2);
		  for($i=0;$i<$count;$i++){ 
		    unset($row2[$i]);
		  }   
	    array_push($arr,$row2);
	} 
	$row["P_buylist"] = $arr;

	$sql2="select M_head,M_login,E_star,E_content,E_time,E_reply from sl_evaluate,sl_member,sl_orders where E_del=0 and M_del=0 and O_del=0 and E_mid=M_id and E_oid=O_id and O_pid=$id order by E_id desc";//评价记录
		$result2 = mysqli_query($conn, $sql2);
		$arr = array();  
		while($row2 = mysqli_fetch_array($result2)) {
		$row2["M_head"]=img($row2["M_head"]);
		$count=count($row2);
		  for($i=0;$i<$count;$i++){ 
		    unset($row2[$i]);
		  }   
	    array_push($arr,$row2);
	} 
	$row["P_evaluate"] = $arr;

	$B_count=getrs("select count(*) as B_count from sl_orders where O_del=0 and not O_state=2 and O_pid=$id","B_count");
	$E_count=getrs("select count(*) as E_count from sl_evaluate,sl_orders where E_del=0 and O_del=0 and E_oid=O_id and O_pid=$id","E_count");

	$row["P_bcount"] = $B_count;
	$row["P_ecount"] = $E_count;


	switch ($row["P_selltype"]) {
		case 0:
		$P_rest="充足";
		break;

		case 1:
		$P_rest=getrs("select count(C_id) as C_count from sl_card where C_sort=".intval($row["P_sell"])." and C_use=0 and C_del=0","C_count");
		break;

		case 2:
		$P_rest=$row["P_rest"];
		break;
	}

	$row["P_rest"]=$P_rest;
	$api=json_encode($row);
	break;


	case "news_info":
	mysqli_query($conn,"update sl_news set N_view=N_view+1 where N_id=".$id);
	$genkey=t($_GET["genkey"]);
	$sql="select * from sl_news where N_id=".$id;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$row["N_pic"]=img($row["N_pic"]);
	$row["N_content"]=preg_replace('/style=".*?"/i', '', $row["N_content"]);
	$row["N_content"]=str_replace("src=\"".$path."kindeditor/","src=\"http://".$_SERVER["HTTP_HOST"].$path."kindeditor/",$row["N_content"]);

	$xss = new XssHtml($row["N_content"]);
	$N_content = $xss->getHtml();

	$N_price=$row["N_price"];
	$N_date=$row["N_date"];
	$N_long=$row["N_long"];

	$row["N_end"]=date("Y-m-d H:i:s",strtotime("+$N_long hour",strtotime($N_date)));

	if(strpos($row["N_content"],"[fh_free]")!==false){
		$N_preview="<b>免费预览：</b>".splitx($N_content,"[fh_free]",0);
	}else{
		$N_preview=" ";
	}

	if($N_price>0){//文章不免费
		if($N_long==0){//没开启了限时付费
			if(getrs("select * from sl_orders where O_content='".$genkey."' and O_mid=1 and O_nid=$id","O_id")!="" && $genkey!=""){//已免登录购买
				$t = str_replace("[fh_free]","",$N_content);
				$b = 1;
			}else{
				if($_SESSION["M_id"]!=""){//登录了会员
					$sql = "select * from sl_orders where O_del=0 and O_type=1 and O_nid=$id and O_mid=".intval($_SESSION["M_id"]);
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					if (mysqli_num_rows($result) > 0) {//已购买
						$t = str_replace("[fh_free]","",$N_content);
						$b = 1;
					} else {//没购买
						$t = $N_preview;
						$b = 0;
					}
				}else{//没登录会员
					$t = $N_preview;
					$b = 0;
				}
			}
		}else{//开启了限时付费
			if(time()>strtotime("+$N_long hour",strtotime($N_date))){//已过收费期
				$t = str_replace("[fh_free]","",$N_content);
				$b = 1;
			}else{//未过收费期
				$t = $N_preview;
				$b = 0;
			}
		}
	}else{//免费
		$t = str_replace("[fh_free]","",$N_content);
		$b = 1;
	}

	$row["N_content"]=$t;
	$row["b"]=$b;
	$api=json_encode($row);
	break;

	case "unlogin":
	$type=$_GET["type"];
	$id=$_GET["id"];
	$genkey=$_GET["genkey"];

	if($type=="news"){
		$sql="select * from sl_news where N_id=".$id;
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$O_title=$row["N_title"]."-付费阅读";
		$O_price=$row["N_price"];
		$O_pic=img($row["N_pic"]);
		$info="支付成功后，文章页面将自动刷新并显示全部内容，在这之前请不要关闭页面";
		$address="email";
	}

	if($type=="product"){
		$sql="select * from sl_product where P_id=".$id;
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$O_title=$row["P_title"]."-购买";
		$O_price=$row["P_price"];
		$O_pic=img(splitx($row["P_pic"],"|",0));

		switch ($row["P_selltype"]) {
			case 0:
			$P_rest=1;
			$P_resttitle="充足";
			break;

			case 1:
			$P_rest=getrs("select count(C_id) as C_count from sl_card where C_sort=".intval($row["P_sell"])." and C_use=0","C_count");
			$P_resttitle=$P_rest."件";
			break;

			case 2:
			$P_rest=$row["P_rest"];
			$P_resttitle=$P_rest."件";
			break;
		}
		
		if($row["P_selltype"]==2){
			$address="address";
			$info="该商品为实物商品，支付成功后，由商家手动发货";
		}else{
			$address="email";
			$info="该商品为虚拟商品，支付成功后，商品将自动发送到您的电子邮箱";
		}
	}
	$arr = array();
	$arr["O_title"]=$O_title;
	$arr["O_price"]=$O_price;
	$arr["O_pic"]=$O_pic;
	$arr["info"]=$info;
	$arr["address"]=$address;
	$arr["P_rest"]=$P_rest;
	$arr["P_resttitle"]=$P_resttitle;

	$api=json_encode($arr);
	break;
	case "wxlogin":
    $code=$_POST["code"];
    $info = GetBody("https://api.weixin.qq.com/sns/jscode2session?appid=" . $C_wxapp_id . "&secret=" . $C_wxapp_key . "&js_code=" . $code . "&grant_type=authorization_code", "");
    $info = json_decode($info);
    $openid = $info->openid;
    $session_key = $info->session_key;
    $sql = "select * from sl_member where M_openid='" . $openid . "' and not M_openid=''";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        $state = "success";
        $M_id = $row["M_id"];
        $M_login = $row["M_login"];
        $M_head = $row["M_head"];
        $M_vip = $row["M_vip"];

        $info = "{\"M_id\":\"" . $M_id . "\",\"M_vip\":\"" . $M_vip . "\",\"openid\":\"" . $openid . "\",\"M_login\":\"" . $M_login . "\",\"M_head\":\"" . $M_head . "\"}";
    } else {
        $state = "fail";
        $info = "";
    }
    $api = "{\"state\":\"" . $state . "\",\"session_key\":\"" . $session_key . "\",\"openid\":\"" . $openid . "\",\"info\":[" . $info . "]}";
    break;

    case "prepay":

	$money=round($_GET["money"],2);
	$total_money = $money*100;

	$openid=$_POST["openid"];
	$attach=t($_POST["attach"]);
	$body=$_POST["body"];

	$nonce_str = gen_key(20);
	$str = "appid=$C_wxapp_id&attach=$attach&body=$body&mch_id=$C_wx_mchid&nonce_str=$nonce_str&notify_url=".gethttp().$D_domain."/api/wxpay/notify_url.php&openid=$openid&out_trade_no=$nonce_str&spbill_create_ip=127.0.0.1&total_fee=$total_money&trade_type=JSAPI&key=$C_wx_key";

	$sign = md5($str);
	$formData = "<xml>
	<appid>$C_wxapp_id</appid>
	<attach>$attach</attach>
	<body>$body</body>
	<mch_id>$C_wx_mchid</mch_id>
	<nonce_str>$nonce_str</nonce_str>
	<notify_url>".gethttp().$D_domain."/api/wxpay/notify_url.php</notify_url>
	<openid>$openid</openid>
	<out_trade_no>$nonce_str</out_trade_no>
	<spbill_create_ip>127.0.0.1</spbill_create_ip>
	<total_fee>$total_money</total_fee>
	<trade_type>JSAPI</trade_type>
	<sign>" . strtoupper($sign) . "</sign>
	</xml>";

	$info = GetBody("https://api.mch.weixin.qq.com/pay/unifiedorder", $formData);
	//die($formData);
	$info = simplexml_load_string($info);
	$prepay_id = $info->prepay_id[0];
	$str2 = "appId=" . $C_wxapp_id . "&nonceStr=BiIUif6MUIWM0S7YaXlH&package=prepay_id=" . $prepay_id . "&signType=MD5&timeStamp=1490840662&key=" . $C_wx_key;
	$pay_sign = md5($str2);
	$api = "{\"prepay_id\":\"" . $prepay_id . "\",\"pay_sign\":\"" . strtoupper($pay_sign) . "\"}";

	break;
	case "fahuo":

	$genkey=t($_GET["genkey"]);
	$sql="select * from sl_orders where O_del=0 and O_genkey='$genkey'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$api=json_encode($row);
	break;

}

die(trim($api,"\xEF\xBB\xBF"));

function img($head){
	$D_domain=splitx($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"],"/api",0);
	if($head==""){
		return "";
	}else{
		if(substr($head,0,4)!="http"){
			return gethttp().$D_domain."/media/".$head;
		}else{
			return $head;
		}
	}
}
?>