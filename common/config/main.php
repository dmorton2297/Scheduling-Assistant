<?php
return [
    'name' => 'GLS Template',
    'aliases' => [
        '@GLS' => dirname(dirname(__DIR__)) . '/library/gls'
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
];
