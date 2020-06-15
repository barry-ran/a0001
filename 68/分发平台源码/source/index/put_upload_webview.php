<?php

//decode by 精品资源分享网www.xiomao.cn
include '../system/db.class.php';
header("Content-type: text/html;charset=" . IN_CHARSET);
if (!empty($_FILES)) {
	$tid = $_POST['tid'];
	$ext = $_POST['ext'];
	$pw = $_POST['pw'];
	$pw and $pw == IN_WEBVIEWSECRET or exit('Access denied');
	preg_match('/^(\\d+\\-\\d+)$/', $ext) or exit('Access denied');
	$ssl = is_ssl() ? 'https://' : 'http://';
	$file = '../../data/tmp/' . $ext . ($tid < 1 ? '.ipa' : '.apk');
	if (move_uploaded_file($_FILES['app']['tmp_name'], $file)) {
		updatetable('webviewlog', array('in_status' => 2, 'in_addtime' => date('Y-m-d H:i:s')), array('in_ext' => $ext));
		echo str_replace('../../', $ssl . $_SERVER['HTTP_HOST'] . IN_PATH, $file);
	}
}