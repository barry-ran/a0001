<?php

//decode by 精品资源分享网www.xiomao.cn
include '../system/db.class.php';
header("Content-type: text/html;charset=" . IN_CHARSET);
if (!empty($_FILES)) {
	$id = intval($_POST['id']);
	$pw = $_POST['pw'];
	$pw and $pw == IN_SECRET or exit('Access denied');
	$file = '../../data/attachment/' . getfield('app', 'in_app', 'in_id', $id);
	if (move_uploaded_file($_FILES['ipa']['tmp_name'], $file)) {
		$dir = '../../data/tmp/' . time();
		creatdir($dir);
		include_once '../pack/zip/zip.php';
		$zip = new PclZip($file);
		$zip->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_BY_PREG, '/^Payload\\/.*.app\\/embedded.mobileprovision$/');
		$d = NULL;
		$h = @opendir($dir . '/Payload');
		while ($f = @readdir($h)) {
			if ($f != '.' && $f != '..' && is_dir($dir . '/Payload/' . $f)) {
				$d = $dir . '/Payload/' . $f;
			}
		}
		@closedir($h);
		$path = '../../data/attachment/' . str_replace('.png', '.mobileprovision', substr(getfield('app', 'in_icon', 'in_id', $id), -36));
		@unlink($path);
		@rename($d . '/embedded.mobileprovision', $path);
		updatetable('signlog', array('in_status' => 2, 'in_addtime' => date('Y-m-d H:i:s')), array('in_aid' => $id));
		updatetable('app', array('in_type' => 1, 'in_team' => getfield('signlog', 'in_cert', 'in_aid', $id), 'in_addtime' => date('Y-m-d H:i:s')), array('in_id' => $id));
		echo getlink($id);
	}
}