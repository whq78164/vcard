<?php
$config['bootstrap'][] = 'debug';
$config['modules']['debug'] = 'yii\debug\Module';
$config['bootstrap'][] = 'gii';
$config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'] // 按需调整这里
];