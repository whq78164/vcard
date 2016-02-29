<?php
use yii\gii\Module;
$config = [
    'bootstrap' => ['log'],

    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'i18n' => require(__DIR__ . '/components/i18n.php'),
        'mailer' => require(__DIR__ . '/components/mailer.php'),
        //  'as access' => require(__DIR__ . '/components/access.php'),
    ],
];

if (YII_ENV_DEV) {
//if (YII_ENV=='dev') {
    // configuration adjustments for 'dev' environment
    require(__DIR__ . '/env.php');
}

return $config;
