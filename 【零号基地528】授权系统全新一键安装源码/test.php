<?php

error_reporting(E_ALL ^ E_NOTICE);

$authorization = 'xcwdM344pzbfv7GtYbwN'; 		//如果后台关闭了授权码验证可以不填或随意输入

if($_COOKIE[$authorization.'_auth'] != 1){		//验证cookie缓存验证
	if($json_get = file_get_contents('http://www.zye.com/Ajax.php?my=query_API&url='.$_SERVER['SERVER_NAME'].'&authorization='.$authorization)){		//开始请求服务器
		$row_json=json_decode($json_get,true);
		if($row_json['code'] != 1){
			exit('<h2>'.$row_json['msg'].'</h2>');		//验证失败未授权
		}else{
			setcookie($authorization.'_auth',1,time()+0*00*60,'/');		//存起cookie方便下次查询以及通过授权 有效期24小时
		}
	}else{
		exit('<h1>授权服务器反应超时!请检查授权代码中验证地址是否已更改！</h1><br/><hr />'.$json_get);	//服务器反应超时提示
	}
}
?>
<h2>可以访问了哦，说明已授权！</h2>