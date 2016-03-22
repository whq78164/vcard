<?php

return [
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
];
