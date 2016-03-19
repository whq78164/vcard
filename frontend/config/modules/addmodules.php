<?php
$Moduleconfig['authmenu']=[
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
];
$Moduleconfig['company']=['class' => 'frontend\modules\company\companyModule',];
$Moduleconfig['qrcode']=['class' => 'frontend\modules\qrcode\qrcodeModule'];
$Moduleconfig['api']=['class' => 'frontend\modules\api\apiModule'];
//////类名和php文件名必须一致!
