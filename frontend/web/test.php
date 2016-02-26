<?php
//defined('YII_ENV') or define('YII_ENV', 'dev');
//pro模式：高效安全模式(正常使用开启); dev模式：开发模式(出错或调试时开启);

defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_ENV_DEV') or define('YII_ENV_DEV',true);

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


echo Yii::$app->getRequest()->hostInfo;



