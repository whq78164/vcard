<?php

return  [
    'class' => 'yii\swiftmailer\Mailer',
    //      'viewPath' => '@common/mail',  已经定义好了。在common目录
    // send all mails to a file by default. You have to set
    // 'useFileTransport' to false and configure a transport
    // for the mailer to send real emails.
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
        'username' => 'whq78164@163.com',
        'password' => '123456789',
        'port' => '25',
        'encryption' => 'tls',//加密
    ],

    'messageConfig'=>[
        'charset'=>'UTF-8',
        'from'=>['whq78164@163.com'=>'admin',
            '798904845@qq.com' => 'supportEmail',
        ]
    ],

];
