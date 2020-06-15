<?php
define('ROOT', '../');
require_once (ROOT . 'includes/common.php');
$new_cookie = md5(uniqid() . rand(1, 1000));
$DB->query("update " . DBQZ . "_user set cookie='".$new_cookie."' where uid='".$userrow['uid']."'");
setcookie(DBQZ . "_cookie", "", -1, '/');
msg("退出成功!", "/index.php");
?>