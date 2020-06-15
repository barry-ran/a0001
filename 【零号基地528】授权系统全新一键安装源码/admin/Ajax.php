<?php
/*
 * 提交处理类
 */
include_once ('state.php');

$row = $DB->get_row("select * FROM " . DBQZ . "_user where uid='$userrow[uid]' limit 1");
$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='webedit'){
$name = defense($_GET['name']);
$gg1 = defense($_GET['gg1']);
$gg2 = defense($_GET['gg2']);
$auth_ma = defense($_GET['auth_ma']);
$kfqq = defense($_GET['kfqq']);
	saveSetting('name',$name);
	saveSetting('gg1',$gg1);
	saveSetting('gg2',$gg2);
	saveSetting('auth_ma',$auth_ma);
	saveSetting('kfqq',$kfqq);
	die('修改成功');
}elseif($my=='upload_zip'){
$file = $_FILES['file'];//得到传输的数据
	//得到文件名称
	$name = $file['name'];
	$type = strtolower(substr($name,strrpos($name,'.')+1)); //转化成小写
	$allow_type = array('zip'); //定义允许上传的类型
	//判断文件类型是否被允许上传
	if(!in_array($type, $allow_type)){
		//die('请上传zip格式文件');
		msg('请上传zip格式文件','maix.php');
	}
	if(!is_uploaded_file($file['tmp_name'])){
		//die('上传方式错误');
		msg('上传方式错误','maix.php');
	}
	$upload_path = "../zip/"; //上传文件的存放路径
	$name_x = getkm(20); //建立一个新的名称
	saveSetting('file_name_x',$name_x); //同步数据库
	saveSetting('file_name',$name); //同步数据库
	if(move_uploaded_file($file['tmp_name'],$upload_path.$name_x.'.zip')){
		//die('上传成功');
		msg($name.'，上传成功','maix.php');
	}else{
		//die('上传失败');
		msg($name.'，上传失败','maix.php');
	}
}elseif($my=='addurl'){
$url = defense($_GET['url']);
$value = defense($_GET['value']);
$authorization = getkm(30);
	if(!$url or !$value){
		die('请输入域名及QQ账号');
	}elseif(!$DB->get_row("SELECT * FROM `". DBQZ ."_list` where `url` = '{$url}'")){
		if($DB->query("INSERT INTO `". DBQZ ."_list`(`url`, `value`, `authorization`, `date`) VALUES ('{$url}','{$value}','{$authorization}','{$date}')")){
			die('授权成功');
		}else{
			die('授权失败');
		}
	}else{
		die('域名已授权');
	}
}elseif($my=='dei'){
$id = intval($_GET['id']);
	if($DB->query("DELETE FROM `". DBQZ ."_list` where `id` = '{$id}'")){
		die('删除成功');
	}else{
		die('删除失败');
	}
}elseif($my=='edit_url'){
$id = defense($_GET['id']);
$url = defense($_GET['url']);
$value = defense($_GET['value']);
$authorization = defense($_GET['authorization']);
	if(!$id or !$url or !$value or !$authorization){
		die('选项不能留空');
	}elseif(strlen($authorization) < 30){
		die('授权码小于30位字符');
	}elseif(!$DB->get_row("select * from ". DBQZ ."_list where `id` = '{$id}' limit 1")){
		die('记录不存在');
	}elseif($DB->query("UPDATE `". DBQZ ."_list` SET `url`='{$url}', `value`='{$value}', `authorization`='{$authorization}' where `id` = '{$id}'")){
		die('修改完成');
	}else{
		die('修改失败');
	}
}elseif($my=='sckami'){
$num = intval($_GET['num']);
	if(!$num){ //因为前面加intval() 所以不可能为空,但是我还是加了判断。为什么？ 因为我无聊~
		die('请输入生成数量');
	}else{
		for ($i = 0; $i < $num; $i++) {
			$km=getkm(20);
			$sql=$DB->query("INSERT INTO  `". DBQZ ."_kms` ( `km`, `state`, `date` ) VALUES ( '{$km}', '0', '{$date}' )");
			if($sql) {
				echo "<li class='list-group-item'>$km</li>";
			}
		}
	}
}elseif($my=='del_km'){
$id = intval($_GET['id']);
	if(!$row_del = $DB->get_row("select * from `". DBQZ ."_kms` where `id` = '{$id}'")){
		die('卡密不存在');
	}elseif($DB->query("delete from `". DBQZ ."_kms` where `id` = '{$id}'")){
		die('删除成功');
	}else{
		die('删除失败');
	}
	
}
?>