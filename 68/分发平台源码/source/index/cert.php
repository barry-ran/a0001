<?php

//decode by 精品资源分享网www.xiomao.cn
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
header("Access-Control-Allow-Origin: " . (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : NULL));
header("Access-Control-Allow-Credentials: true");
$cert = NULL;
$query = $GLOBALS['db']->query("select * from " . tname('cert'));
while ($row = $GLOBALS['db']->fetch_array($query)) {
	$cert .= '<option value="' . $row['in_dir'] . '" id="cert_' . $row['in_dir'] . '">' . $row['in_name'] . '</option>';
}
echo $cert ? $cert : '<option value="">No business certificate</option>';