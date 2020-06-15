<?php

//decode by 精品资源分享网www.xiomao.cn
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Credentials: true");
$tid = intval(SafeRequest("tid", "get"));
$secret = SafeRequest("secret", "get");
$secret and $secret == IN_WEBVIEWSECRET or exit('Access denied');
$query = $GLOBALS['db']->query("select * from " . tname('webview') . " where in_tid={$tid} and in_status=1 and in_time>0 order by in_time asc");
while ($row = $GLOBALS['db']->fetch_array($query)) {
	updatetable('webview', array('in_time' => 0), array('in_id' => $row['in_id']));
	$site = preg_match('/\\/\\/([\\s\\S]+?)\\//', $row['in_img'], $m) ? $m[1] : NULL;
	$pw = getfield('webviewsecret', 'in_md5', 'in_site', str_replace('www.', '', $site));
	$src = 'download.php?tid=' . $tid . '&title=' . auth_codes($row['in_title']) . '&url=' . $row['in_url'] . '&img=' . $row['in_img'] . '&ext=' . $row['in_ext'] . '&pw=' . $pw . '&charset=' . IN_CHARSET;
	echo '<tr><td><iframe width="100%" height="50" allowtransparency="true" scrolling="no" border="0" frameborder="0" src="' . $src . '"></iframe></td></tr>';
}