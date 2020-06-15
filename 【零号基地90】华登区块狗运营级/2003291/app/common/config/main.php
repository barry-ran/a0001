<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
            'nullDisplay' => '-'
        ],
        'curl' => [
            'class' => 'common\components\Curl'
        ],
        'api'=>[
            'class' => 'common\components\ApiData'
        ],
        'imgload' => [
            'class' => 'common\components\Upload'
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
    ],
    'timeZone'=>'Asia/Shanghai',
];
