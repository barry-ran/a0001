<?php
define('ROOT', dirname(__FILE__).'/');
require_once(ROOT.'includes/common.php');

$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='query'){
$url = defense($_GET['query_url']);
	$row_query = $DB->get_row("SELECT * FROM `". DBQZ ."_list` where `url` = '{$url}' limit 1");
	if(!$row_query){
		die('
			<h5>查询域名：<a href="http://'.$url.'" target="_blank">'.$url.'</a></h5>
			<hr />
			<h5>ＱＱ账号：无</h5>
			<hr />
			<h5>状态：<font color="#FF0000">暂未授权/盗版</font></h5>
		');
	}elseif($row_query['url']==$url){
		die('
			<h5>查询域名：<a href="http://'.$url.'" target="_blank">'.$url.'</a></h5>
			<hr />
			<h5>ＱＱ账号：'.$row_query['value'].'</h5>
			<hr />
			<h5>状态：<font color="#13895F">正版授权</font></h5>
		');
	}
}elseif($my=='query_API'){
$get_url = defense($_GET['url']);
$get_authorization = defense($_GET['authorization']);
	if($conf['auth_ma']==1){
		if($DB->get_row("SELECT *  FROM  `". DBQZ ."_list` where `url` = '{$get_url}' and `authorization` = '{$get_authorization}' limit 1")){
			$arr = array('code'=>'1');
			exit(json_encode($arr));
		}else{
			$arr = array('code'=>'-1','msg'=>'域名未授权，请联系客服QQ：'.$conf['kfqq'].'进行授权！');
			exit(json_encode($arr));
		}
	}else{
		if($DB->get_row("SELECT *  FROM  `". DBQZ ."_list` where `url` = '{$get_url}' limit 1")){
			$arr = array('code'=>'1');
			exit(json_encode($arr));
		}else{
			$arr = array('code'=>'-1','msg'=>'域名未授权，请联系客服QQ：'.$conf['kfqq'].'进行授权！');
			exit(json_encode($arr));
		}
	}
}elseif($my=='download'){
	echo '没有提示下载？<a href="zip/'.$conf['file_name_x'].'.zip">点我下载</a>';
}elseif($my=='zaixanauth'){
$url = defense($_GET['url']);
$value = defense($_GET['value']);
$km = defense($_GET['km']);
$authorization = getkm(30);
	if(!$url or !$value or !$km){
		exit('选项不能留空');
	}elseif(!$row_auth=$DB->get_row("SELECT *  FROM  `". DBQZ ."_kms` where `km` = '{$km}' limit 1")){
		die('卡密不存在');
	}elseif($row_auth['state']==1){
		die('卡密已被使用');
	}elseif($row_list=$DB->get_row("SELECT * FROM `". DBQZ ."_list` where `url` = '{$url}'")){
		die('域名已授权,无需重新授权');
	}elseif($DB->query("INSERT INTO `". DBQZ ."_list`(`url`, `value`, `authorization`, `date`) VALUES ('{$url}','{$value}','{$authorization}','{$date}')")){
		$DB->query("UPDATE `". DBQZ ."_kms` SET  `state` =  '1' WHERE `id` ={$row_auth['id']}");
		die($url.'，授权成功');
	}else{
		die($url.'，授权失败');
	}
}
?>