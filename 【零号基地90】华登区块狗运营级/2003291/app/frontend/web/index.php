<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);
$language = isset($_REQUEST['lang']) && $_REQUEST['lang'] != '' ? $_REQUEST['lang'] : (isset(Yii::$app->session['language']) ? Yii::$app->session['language'] : 'en_US');
$application->language = $language;
//$application -> language = \Yii::$app->request->cookies->has('language') ? \Yii::$app->request->cookies->getValue('language') : 'zh_CN';
//$token = Yii::$app->request->get('token') ? Yii::$app->request->get('token') : Yii::$app->request->post('token');
//$userid = common\components\MTools::tokenToId($token);
//$key = $userid."language";
//$application -> language = Yii::$app->cache->get($key) ? Yii::$app->cache->get($key) : 'zh_CN';
$application->run();
