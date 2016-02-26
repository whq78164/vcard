<?php

return [
    'translations' => [
        'tbhome' => [
            'class' => 'yii\i18n\PhpMessageSource',
            /* 'basePath' => '@app/messages',
              'sourceLanguage' => 'zh-CN',*/
            'basePath' => '@vendor/tbhome/messages',
            'fileMap' => [
                'app' => 'tbhome.php',
                'app/error' => 'error.php',
            ],
        ],
    ],
];
