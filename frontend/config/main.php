<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
//    'language' => 'zh-CN',
    //'charset' => 'UTF-8',
  'modules' =>require (__DIR__ . '/modules/extmodules.php'),
   'components' => require (__DIR__ . '/components/components.php'),

    'params' => $params,
];
