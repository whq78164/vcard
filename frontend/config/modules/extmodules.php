<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-11
 * Time: 11:49
 */
$Moduleconfig=[
//    'company' => ['class' => 'frontend\modules\company\companyModule',],
    'qrcode' => ['class' => 'frontend\modules\qrcode\qrcodeModule',],
    'column' => ['class' => 'frontend\modules\column\Module',],
 //   'authmenu' => require(__DIR__ . '/authmenu.php'),
];
require(__DIR__ . '/addmodules.php');
//$Moduleconfig=array_merge($Moduleconfig,$configAuthmenu);

return $Moduleconfig;
