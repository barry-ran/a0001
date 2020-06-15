<?php
define("APP_PATH",dirname(__FILE__));
define("SP_PATH",dirname(__FILE__).'/SpeedPHP');
$spConfig = array(
	"db" => array(
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'root',
		'database' => 'mxszpt_coupon_system',
	),
	'view' => array(
		'enabled' => TRUE, // 开启Smarty
		'config' =>array(
			'template_dir' => APP_PATH.'/tpl', // 模板存放的目录
			'compile_dir' => APP_PATH.'/tmp', // 编译的临时目录
			'cache_dir' => APP_PATH.'/tmp', // 缓存的临时目录
			'left_delimiter' => '<{',  // smarty左限定符
			'right_delimiter' => '}>', // smarty右限定符
		),
    ),
    'launch' => array( 
		 'router_prefilter' => array( 
			array('spAcl','mincheck'), // 开启强制的权限控制
		 ), 
	 ),
     	 'ext' => array( // 扩展设置
	 	'spAcl' => array( // acl扩展设置
	 		'prompt' => array("mx_admin", "acljump"),   
	 	), 
	 ),
);
require(SP_PATH."/SpeedPHP.php");
spRun();