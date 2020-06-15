<?php

//decode by 精品资源分享网www.xiomao.cn
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
header("Access-Control-Allow-Origin: " . (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : NULL));
header("Access-Control-Allow-Credentials: true");
$status = SafeRequest("status", "get");
$tid = intval(SafeRequest("tid", "get"));
$title = unescape(SafeRequest("title", "get"));
$url = SafeRequest("url", "get");
$img = SafeRequest("img", "get");
$ext = SafeRequest("ext", "get");
$site = preg_match('/\\/\\/([\\s\\S]+?)\\//', $img, $m) ? $m[1] : NULL;
getfield('webviewsecret', 'in_id', 'in_site', str_replace('www.', '', $site)) or exit('-1');
if ($status < 2) {
	$setarr = array('in_tid' => $tid, 'in_title' => $title, 'in_url' => $url, 'in_img' => $img, 'in_ext' => $ext, 'in_status' => 1, 'in_time' => time());
	inserttable('webview', $setarr);
	echo '1';
} else {
	updatetable('webview', array('in_status' => 2, 'in_time' => time()), array('in_ext' => $ext));
	echo '1';
}