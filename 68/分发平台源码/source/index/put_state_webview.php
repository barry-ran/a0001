<?php

//decode by 精品资源分享网www.xiomao.cn
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Credentials: true");
$ext = SafeRequest("ext", "get");
$step = SafeRequest("step", "get");
$percent = intval(SafeRequest("percent", "get"));
$pw = SafeRequest("pw", "get");
$pw and $pw == IN_WEBVIEWSECRET or exit('Access denied');
updatetable('webviewlog', array('in_step' => $step, 'in_percent' => $percent), array('in_ext' => $ext));