<?php
define('ROOT', '../');
require_once (ROOT . 'includes/common.php');

if (!iflogin(DBQZ,$userrow['cookie'])) {
}else{
header("Location: maix.php"); 
}
if($_POST['from']=='login'){
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	$ip=real_ip();
	if(!$user or !$pwd){
		msg("账号密码不能为空",1);
	}else{
		$pwd=md5($pwd);
		if($row=$DB->get_row("SELECT uid,user FROM ".DBQZ."_user WHERE user='$user' and pwd='$pwd' limit 1")){
			$cookie=md5(uniqid().rand(1,1000));
			$time=date("Y-m-d H:i:s");
			$DB->query("update ".DBQZ."_user set cookie='$cookie',ip='$ip',time='$time' where uid='{$row[uid]}'");
			setcookie(DBQZ."_cookie",$cookie,time()+3600*24*14,'/');
			msg("{$row[user]}，欢迎回来! ","maix.php");
		}else{
			msg("用户名或密码错误",1);
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">  
	    <title><?=$conf['name'].' - 登录后台'?></title>
        <meta name="description" content="">
        <meta name="author" content="templatemo">
        
	    <link href='http://fonts.useso.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	    <link href="../css/font-awesome.min.css" rel="stylesheet">
	    <link href="../css/bootstrap.min.css" rel="stylesheet">
	    <link href="../css/templatemo-style.css" rel="stylesheet">
	    
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body class="light-gray-bg">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
	          <div class="square"></div>
	          <h1>登录后台</h1>
	        </header>
	        <form action="?" method="post" class="templatemo-login-form"><input type="hidden" name="from" value="login">
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" name="user" class="form-control" placeholder="请输入账号">           
		          	</div>	
	        	</div>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input type="password" name="pwd" class="form-control" placeholder="请输入密码">           
		          	</div>	
	        	</div>	          	
	          	<div class="form-group">
				    <div class="checkbox squaredTwo">
				        <input type="checkbox" id="c1" name="cc" />
						<label for="c1"><span></span>记住密码</label>
				    </div>				    
				</div>
				<div class="form-group">
					<button type="submit" class="templatemo-blue-button width-100">登录</button>
				</div>
	        </form>
			<div>&#x5C0F;&#x5154;&#x8D44;&#x6E90;&#x7F51;&#x7AD9;&#x957F;&#x8D44;&#x6E90;&#x805A;&#x96C6;&#x5730;&#x2764;&#xFE0F;&#119;&#119;&#119;&#46;&#110;&#104;&#55;&#55;&#46;&#99;&#110;</div>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>如果你不是管理请自行离开，谢谢配合!</p>
		</div>
	</body>
</html>