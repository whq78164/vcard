<?php
$config = [
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'mailer' => require(__DIR__ . '/components/mailer.php'),
    
    ],
];
return $config;