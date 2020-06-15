<?php
error_reporting(0);
@header('Content-Type: text/html; charset=UTF-8');
	@header('Content-Type: text/html; charset=UTF-8');
	if(file_exists('install.lock')){
		exit('检测到您已安装过本源码，若需要重新安装，请删除该目录下的install.lock');
	}
	$do = isset($_GET['do']) ? $_GET['do'] : '0';
/*reference:消失的彩虹海*/
function checkfunction($f, $m = false)
{
	if (function_exists($f)) {
		return '可用';
	} else {
		if ($m == false) {
			return '<不支持';
		} else {
			return '不支持';
		}
	}
}
function checkclass($f, $m = false)
{
	if (class_exists($f)) {
		return '可用';
	} else {
		if ($m == false) {
			return '不支持';
		} else {
			return '不支持';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="../img/favicon.html">
    <title>域名授权验证系统</title>
    <!-- Bootstrap core CSS -->
	<link href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="http://static.bootcss.com/www/assets/css/site.min.css?v5" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
	<div class="form-signin">
        <h2 class="form-signin-heading">欢迎使用产品授权验证系统 - 协议</h2>
			<div class="login-wrap">
		
<?php if ($do=='0') { ?>
			<iframe src="Agreement.Ae" style="width:100%;height:465px;"></iframe>
        <div class="login-wrap">
<?php if ($installed) { ?>
			<p>您已经安装了！不需要在次安装！</p>
<?php }else{ ?>
            <a href="index.php?do=1" class="btn btn-primary btn-block" type="submit"> 下一步</a>
<?php } ?>
        </div>

<?php }elseif($do=='1'){?>
			<ul class="">
                <li><a href="javascript:;"> <i class="icon-time"></i> PHP版本支持(必须 5.2+) <span class="label label-primary pull-right r-activity"><?php echo phpversion(); ?></span></a></li>
				<li><a href="javascript:;"> <i class="icon-calendar"></i> 抓取网页(必须 curl_exec()) <span class="label label-primary pull-right r-activity"><?php echo checkfunction('curl_exec', true); ?></span></a></li>
				<li><a href="javascript:;"> <i class="icon-bell-alt"></i> 读取文件(必须 file_get_contents()) <span class="label label-primary pull-right r-activity"><?php echo checkfunction('file_get_contents', true); ?></span></a></li>
				<li><a href="javascript:;"> <i class="icon-envelope-alt"></i> 发送邮件(必须 fsockopen()) <span class="label label-primary pull-right r-activity"><?php echo checkfunction('fsockopen'); ?></span></a></li>
				<li><a href="javascript:;"> <i class="icon-time"></i> Zip 解包和压缩(推荐 ZipArchive) <span class="label label-primary pull-right r-activity"><?php echo checkclass('ZipArchive'); ?></span></a></li>
				<li><a href="javascript:;"> <i class="icon-calendar"></i> 写入文件(推荐 1/2) <span class="label label-primary pull-right r-activity"><?php if (is_writable('./')) {echo'支持';}else{echo'不支持';} ?></span></a></li>
				<li><a href="javascript:;"> <i class="icon-bell-alt"></i> 写入文件(推荐 2/2) <span class="label label-primary pull-right r-activity"><?php echo checkfunction('file_put_contents'); ?></span></a></li>
			</ul>
        <div class="login-wrap">
            <a href="index.php?do=2" class="btn btn-primary btn-block" type="submit"> 下一步</a>
            <p>环境检查中...</p>
        </div>

<?php }elseif($do=='2'){?>
<form action="?do=3" class="form-sign" method="post">
<label for="name">数据库地址:</label>
<input type="text" class="form-control" name="DB_HOST" placeholder="数据库地址:" value="localhost" autofocus>
<label for="name">数据库端口:</label>
<input type="text" class="form-control" name="DB_PORT" placeholder="数据库端口:" value="3306" autofocus>
<label for="name">数据库库名:</label>
<input type="text" class="form-control" name="DB_NAME" placeholder="数据库库名:" autofocus>
<label for="name">数据库用户名:</label>
<input type="text" class="form-control" name="DB_USER" placeholder="数据库用户名:" autofocus>
<label for="name">数据库密码:</label>
<input type="text" class="form-control" name="DB_PWD" placeholder="数据库密码:" autofocus>
<label for="name">数据库前缀:</label>
<input type="text" class="form-control" name="DB_QZ" placeholder="数据库前缀:" value="auth" autofocus>
<br>
<input type="submit" name="install" class="btn btn-primary btn-block" value="下一步">
</form>
<?php }elseif($do=='3'){
	if($_POST['install']=='下一步'){
		
		if(!$_POST['DB_HOST'] || !$_POST['DB_PORT'] || !$_POST['DB_NAME'] || !$_POST['DB_USER'] || !$_POST['DB_PWD'] || !$_POST['DB_QZ']){
			echo'<script language=\'javascript\'>alert(\'所有项都不能为空\');history.go(-1);</script>';
		}else{
			if(!$con=mysql_connect($_POST['DB_HOST'].':'.$_POST['DB_PORT'],$_POST['DB_USER'],$_POST['DB_PWD'],$_POST['DB_QZ'])){
				echo'<script language=\'javascript\'>alert("连接数据库失败，'.mysql_error().'");history.go(-1);</script>';
			}elseif(!mysql_select_db($_POST['DB_NAME'],$con)){
				echo'<script language=\'javascript\'>alert("选择的数据库不存在，'.mysql_error().'");history.go(-1);</script>';
			}else{
				mysql_query("set names utf8",$con);
				$data='<?php
/*数据库配置*/
$host = "'.$_POST['DB_HOST'].'"; //MYSQL主机
$port = '.$_POST['DB_PORT'].'; //MYSQL主机
$user = "'.$_POST['DB_USER'].'"; //MYSQL用户
$pwd ="'.$_POST['DB_PWD'].'"; //MYSQL密码
$dbname = "'.$_POST['DB_NAME'].'"; //数据库名

/*系统配置*/
$db_qz = "'.$_POST['DB_QZ'].'"; //数据表前缀
?>';
					writefile('../config.php',$data);
					$sqls=file_get_contents("install.sql");
					$sqls=str_replace('{DBQZ}', $_POST['DB_QZ'], $sqls);
					$explode = explode(';</explode>',$sqls);
					$num = count($explode);
					foreach($explode as $sql){
						if($sql=trim($sql)){
							mysql_query($sql);
						}
					}
					
					if(mysql_error()){
						echo'<script language=\'javascript\'>alert("导入数据表时错误，'.mysql_error().'");history.go(-1);</script>';
					}else{
					echo '
		<form action="?do=4" class="form-sign" method="post">
		<label for="name">管理员账号(ID=1):</label>
		<input type="text" class="form-control" name="user">
		<label for="name">管理员密码:</label>
		<input type="password" class="form-control" name="pwd" maxlength="32">
		<label for="name">站长ＱＱ:</label>
		<input type="text" class="form-control" name="kfqq" value="10000">
		<br><input type="submit" class="btn btn-primary btn-block" name="submit" value="保存配置">
		</form>';
					}
			}
		}
	}
?>
<?php
					}elseif($do=='4'){
						$gl=isset($_POST['user'])?$_POST['user']:NULL;
						$pa=isset($_POST['pwd'])?$_POST['pwd']:NULL;
						$pa1=MD5($pa);
						$sitename=isset($_POST['sitename'])?$_POST['sitename']:NULL;
						$kfqq=isset($_POST['kfqq'])?$_POST['kfqq']:NULL;
						$date = date("Y-m-d H:i:s");
						include_once '../config.php';
						if(isset($db_qz))define('DBQZ', $db_qz);
						else define('DBQZ', 'xzmz');
						if(!isset($port))$port='3306';
						include_once("../includes/db.class.php");
						if(defined('SQLITE'))$DB = new DB($db_file);
						else $DB = new DB($host,$user,$pwd,$dbname,$port);
						$conf=$DB->get_row("SELECT * FROM ".DBQZ."_config WHERE 1 limit 1");//获取系统配置
						//saveSetting('name',$sitename);
						$DB->query("INSERT INTO `". DBQZ ."_user`(`uid`, `user`, `pwd`, `qq`, `ip`, `cookie`, `time`) VALUES ('1', '{$gl}', '{$pa1}', '{$kfqq}', '127.0.0.1', '', '{$date}')");
						@file_put_contents('install.lock','安装完成<br/>安装时间:'.date('y-m-d h:i:s',time()));

?>
<h4 class="terques">安装完成</h4>
<p>账号：<?=$gl?></p><p>密码：<?=$pa?></p><p>后台地址：<a href="http://<?=$_SERVER['SERVER_NAME']?>/admin/">http://<?=$_SERVER['SERVER_NAME']?>/admin/</a></p>
<a href="../" class="btn btn-round btn-success">访问我的网站！</a>

<?php
}
function saveSetting($k, $v){
	global $DB;
	$v = addslashes($v);
	return $DB->query("REPLACE INTO ".DBQZ."_config SET v='$v',k='$k'");
}
function writefile($fname,$str){
	if($fp=fopen($fname,"w")){
		fputs($fp,$str);
		fclose($fp);
		return false;
	}else{
		return true;
	}
}
?>
		</div>
	</div>
</div>

</body>
</html>
