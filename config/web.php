<?php
$params = require(__DIR__ . '/params.php');
$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'loginUrl' => ['login'],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mail' => [
			'class' => 'yii\swiftmailer\Mailer',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=blog',
			'username' => 'root',
			'password' => 'localpassword',
			'charset' => 'utf8',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'<action:(login|logout|about)>' => 'site/<action>',
				'post/<id:[0-9]+>' => 'post/view'
			]
		],
	],
	'params' => $params,
	'defaultRoute' => 'post',
	'name' => 'Yii2 Blog Demo'
];

if (YII_ENV_DEV) {
	$config['preload'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		'allowedIPs' => ['*'],
	];
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		'allowedIPs' => ['*'],
	];
}

return $config;
