<?php

if (!is_file('./data/install.lock')) {
    header('Location: ./install.php');
    exit;
}

require("./data/config/version.php");
$websoft=strtolower($_SERVER["SERVER_SOFTWARE"]);
$iis=strpos($websoft,'iis');
if(isset($_SERVER['PATH_INFO']) && $iis>0){
    if(($encode = mb_detect_encoding($_SERVER['PATH_INFO'], array('ASCII','GB2312','GBK','UTF-8'))) != 'UTF-8'){
        $_SERVER['PATH_INFO'] = mb_convert_encoding($_SERVER['PATH_INFO'], 'UTF-8', $encode);
    }
}

define('BUILD_DIR_SECURE',true);
define('DIR_SECURE_FILENAME', 'index.html');
define('DIR_SECURE_CONTENT', 'deney Access!');
define('APP_NAME', 'app');
define('APP_PATH', './app/');
define('FTX_DATA_PATH', './data/');
define('FTX_IMG_DATA_PATH', './');
define('EXTEND_PATH',	APP_PATH . 'Extend/');
define('CONF_PATH',		FTX_DATA_PATH . 'config/');
define('RUNTIME_PATH',	FTX_DATA_PATH . 'runtime/');
define('HTML_PATH',		FTX_DATA_PATH . 'html/');
define('APP_DEBUG', false);
require("./thinkphp/setup.php");