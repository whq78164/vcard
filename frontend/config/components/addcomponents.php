<?php
$Componentsconfig['authManager']=[
    'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
];

$Componentsconfig['as access']=[
    'class' => 'mdm\admin\components\AccessControl',
    //  'allowActions' => [
    //    'site/*',//允许访问的节点，可自行添加
    //  'admin/*',//允许所有人访问admin节点及其子节点],
];

$Componentsconfig['log']=[
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
        ],
    ],
];

$Componentsconfig['errorHandler']=[
    'errorAction' => 'site/error',
];


$Componentsconfig['request']=[
    'cookieValidationKey' => '__www.vcards.top__tbhome.com.cn-SDjA7'
];


$Componentsconfig['user']=[
    'identityClass' => 'common\models\User',
    'enableAutoLogin' => true,
    //'enableSession' => true,
];

