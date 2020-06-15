<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
define('SYSTEM_ROOT', dirname(preg_replace('@\(.*\(.*$@', '', preg_replace('@\(.*\(.*$@', '', __FILE__))) . '/');
define('ROOT', dirname(SYSTEM_ROOT) . '/');
date_default_timezone_set('PRC');
header('Content-Type: text/html; charset=UTF-8');
if (is_file(SYSTEM_ROOT . '360safe/360webscan.php'))//360网站卫士
{
    require_once (SYSTEM_ROOT . '360safe/360webscan.php');
}
if(!file_exists(ROOT . '/install/install.lock')){
	exit('你还没安装！<a href="/install/">点此安装</a>');
}
if(!file_exists(ROOT . 'config.php')) //检测安装
{
	@header("Location:/install");
	exit();
}
require ROOT . 'config.php'; //连接数据库
if (isset($db_qz)) define('DBQZ', $db_qz);
else define('DBQZ', 'xzrz');
if (!isset($port)) $port = '3306';
if(!defined('SQLITE') && (!$user||!$pwd||!$dbname))//检测安装2
{
header('Content-type:text/html;charset=utf-8');
echo '你还没安装！<a href="/install/">点此安装</a>';
exit();
}
include_once (SYSTEM_ROOT . "function.php");
include_once (SYSTEM_ROOT . "db.class.php");
if (defined('SQLITE')) $DB = new DB($db_file);
else $DB = new DB($host, $user, $pwd, $dbname, $port);
include_once (SYSTEM_ROOT . "cache.class.php");
$CACHE = new CACHE();

$conf = $CACHE->pre_fetch(); //获取系统配置
if ($DB->query("select * from " . DBQZ . "_config where 1") == FALSE) //检测安装3
{
    header('Content-type:text/html;charset=utf-8');
    echo '<div class="row">你还没安装！<a href="/install/">点此安装</a></div>';
    exit();
}
$date = date("Y-m-d H:i:s");
$cookie = $_COOKIE[DBQZ . '_cookie'];
$userrow = $DB->get_row("select * FROM " . DBQZ . "_user where cookie ='$cookie' limit 1"); //获取用户信息
?>