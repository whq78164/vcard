<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-11
 * Time: 11:49
 */
$Moduleconfig=[
    'authmenu' => [
        'class' => 'mdm\admin\Module',
        'layout' => 'left-menu',//yii2-admin的导航菜单
        'controllerMap' => [
            'assignment' => [
                'class' => 'mdm\admin\controllers\AssignmentController',
                'userClassName' => 'common\models\User',
                'idField' => 'id'
            ]
        ],
        'menus' => [
            'assignment' => [
                'label' => '授权'//'Grand Access' // change label
            ],
            //'route' => null, // disable menu route
        ]
    ],
    'qrcode' => ['class' => 'frontend\modules\qrcode\Module',],
    'column' => ['class' => 'frontend\modules\column\Module',],
    'company' => ['class' => 'frontend\modules\company\Module',],
 //   'authmenu' => require(__DIR__ . '/authmenu.php'),
];
require(__DIR__ . '/addmodules.php');
//$Moduleconfig=array_merge($Moduleconfig,$configAuthmenu);

return $Moduleconfig;