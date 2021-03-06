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
   'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'i18n' => require(__DIR__ . '/components/i18n.php'),
        'mailer' => require(__DIR__ . '/components/mailer.php'),
       'assetManager' => [
         //  'basePath' => '@webroot/frontend/web/assets',
           //     'baseUrl' => '@web/frontend/web/assets'
           'bundles' => [
               'yii\bootstrap\BootstrapPluginAsset' => [
               //jQuery,bootstrap.css,bootstrap.js
                   'jsOptions' => [
                       'position' => \yii\web\View::POS_HEAD,
                   ]
               ],
               'yii\web\JqueryAsset' => [
                   'jsOptions' => [
                       'position' => \yii\web\View::POS_HEAD,
                   ]
               ],
           ],
       ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
       ],
/*
       'as access' => [
           'class' => 'mdm\admin\components\AccessControl',
         //  'allowActions' => [
           //    'site/*',//允许访问的节点，可自行添加
             //  'admin/*',//允许所有人访问admin节点及其子节点],
           ],
*/

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            //'enableSession' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

       'request' => [
           'cookieValidationKey' => '__www.vcards.top__tbhome.com.cn-SDjA7'
           //  'cookieValidationKey' => 'xpWfUhbMG32BI2FV-SDukLcc4f0v6jA7'
       ],
    ],


    'params' => $params,
];
