<?php
include '../../../system/db.class.php';
$GLOBALS['db']->query("delete from " . tname('salt') . " where in_time<" . strtotime('-30 seconds'));
$proxy = explode('/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : NULL);
$base = isset($proxy[1]) ? $proxy[1] : NULL;
$salt = SafeSql(str_replace(array('.ipa', '.apk'), array('', ''), $base));
$id = getfield('salt', 'in_aid', 'in_salt', $salt);
$id or exit('Access denied');
$size = getfield('app', 'in_size', 'in_id', $id);
header("Cache-Control: private");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $base);
header("Content-Length: " . $size);
$app = getfield('app', 'in_app', 'in_id', $id);
if (getapp($app)) {
	readfile(getapp($app, 1));
} else {
	$highspeed = getfield('app', 'in_highspeed', 'in_id', $id);
	$speed = IN_SPEEDPOINTS ? $highspeed ? IN_HIGHSPEED : IN_LOWSPEED : IN_HIGHSPEED;
	flush();
	$file = fopen(IN_ROOT . './data/attachment/' . $app, 'r');
	while (!feof($file)) {
		echo fread($file, round($speed * 1024));
		flush();
		ob_flush();
		sleep(1);
	}
	fclose($file);
}