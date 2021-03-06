<?php
$params = array_merge(
    require(dirname(dirname(__DIR__)) . '/common/config/params.php'),
    require(dirname(dirname(__DIR__)) . '/common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'console\controllers',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'except' => [
                        'yii\*',
                    ],
                ],
            ],
        ],
	'authManager'=> [
			'class' => 'yii\rbac\DbManager',
                        'defaultRoles' => ['guest'],
	],
    ],
    'params' => $params,
];
