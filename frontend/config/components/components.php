<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-23
 * Time: 1:40
 */
$Componentsconfig=[
    'db' => require(dirname(__DIR__) . '/db.php'),
    'i18n' => require(__DIR__ . '/i18n.php'),
    'mailer' => require(__DIR__ . '/mailer.php'),
    'assetManager'=>require(__DIR__ . '/assetManager.php'),
    'urlManager' =>require(__DIR__ . '/urlManager.php'),
];
require(__DIR__ . '/addcomponents.php');
//$Moduleconfig=array_merge($Moduleconfig,$configAuthmenu);

return $Componentsconfig;
