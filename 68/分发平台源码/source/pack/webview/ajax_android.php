<?php

//decode by 精品资源分享网www.xiomao.cn
include '../../system/db.class.php';
$ac = isset($_GET['ac']) ? $_GET['ac'] : NULL;
if ($ac == 'android') {
	include '../../system/user.php';
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: text/html;charset=" . IN_CHARSET);
	$GLOBALS['userlogined'] or exit('return_0');
	$GLOBALS['erduo_in_points'] < IN_WEBVIEWPOINTS and exit('return_1');
	$tid = intval(SafeRequest("tid", "get"));
	$title = unescape(SafeRequest("title", "get"));
	$url = SafeRequest("url", "get");
	$img = SafeRequest("img", "get");
	$ext = SafeRequest("ext", "get");
	empty($_GET['check']) or exit('1');
	$GLOBALS['db']->query("update " . tname('user') . " set in_points=in_points-" . IN_WEBVIEWPOINTS . " where in_userid=" . $GLOBALS['erduo_in_userid']);
	$setarr = array('in_tid' => $tid, 'in_uid' => $GLOBALS['erduo_in_userid'], 'in_uname' => $GLOBALS['erduo_in_username'], 'in_title' => $title, 'in_url' => $url, 'in_img' => $img, 'in_ext' => $ext, 'in_status' => 1, 'in_step' => 'unknown', 'in_percent' => 0, 'in_addtime' => date('Y-m-d H:i:s'));
	inserttable('webviewlog', $setarr);
	echo '1';
} elseif ($ac == 'listen') {
	$ext = SafeRequest("ext", "get");
	$row = $GLOBALS['db']->getrow("select * from " . tname('webviewlog') . " where in_ext='{$ext}'");
	echo "{'status':'" . $row['in_status'] . "','step':'" . $row['in_step'] . "','percent':'" . $row['in_percent'] . "'}";
} else {
	if (!empty($_FILES)) {
		$filepart = pathinfo($_FILES['android']['name']);
		$fileext = strtolower($filepart['extension']);
		if (in_array($fileext, array('jpg', 'jpeg', 'gif', 'png'))) {
			$ext = $_POST['ext'];
			preg_match('/^(\\d+\\-\\d+)$/', $ext) or exit('-1');
			$dir = '../../../data/tmp';
			creatdir($dir);
			@move_uploaded_file($_FILES['android']['tmp_name'], $dir . '/' . $ext . '.png');
			echo '1';
		} else {
			echo 'return_0';
		}
	}
}