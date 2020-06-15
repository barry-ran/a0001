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
		'enabled' => TRUE, // ����Smarty
		'config' =>array(
			'template_dir' => APP_PATH.'/tpl', // ģ���ŵ�Ŀ¼
			'compile_dir' => APP_PATH.'/tmp', // �������ʱĿ¼
			'cache_dir' => APP_PATH.'/tmp', // �������ʱĿ¼
			'left_delimiter' => '<{',  // smarty���޶���
			'right_delimiter' => '}>', // smarty���޶���
		),
    ),
    'launch' => array( 
		 'router_prefilter' => array( 
			array('spAcl','mincheck'), // ����ǿ�Ƶ�Ȩ�޿���
		 ), 
	 ),
     	 'ext' => array( // ��չ����
	 	'spAcl' => array( // acl��չ����
	 		'prompt' => array("mx_admin", "acljump"),   
	 	), 
	 ),
);
require(SP_PATH."/SpeedPHP.php");
spRun();