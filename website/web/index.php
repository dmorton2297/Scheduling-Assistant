<?php
if (!defined('YII_DEBUG') && getenv('YII_DEBUG')) {
    define('YII_DEBUG', getenv('YII_DEBUG'));
} else {
    define('YII_DEBUG', false);
}
if (!defined('YII_ENV') && getenv('YII_ENV')) {
    define('YII_ENV', getenv('YII_ENV'));
} else {
    define('YII_ENV', 'prod');
}

require(dirname(dirname(__DIR__)) . '/vendor/autoload.php');
require(dirname(dirname(__DIR__)) . '/vendor/yiisoft/yii2/Yii.php');
require(dirname(dirname(__DIR__)) . '/common/config/bootstrap.php');
require(dirname(__DIR__) . '/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(dirname(dirname(__DIR__)) . '/common/config/main.php'),
    require(dirname(dirname(__DIR__)) . '/common/config/main-local.php'),
    require(dirname(__DIR__) . '/config/main.php'),
    require(dirname(__DIR__) . '/config/main-local.php')
);

$application = new yii\web\Application($config);
$application->run();
