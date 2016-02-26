<?php

return [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        'site/*', //允许访问的节点，可自行添加
        'admin/*',//允许所有人访问admin节点及其子节点
        'user/*',
        'authmenu/*',
    ]
];
