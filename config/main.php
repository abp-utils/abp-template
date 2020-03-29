<?php

return [
    'app' => [
        'timezone' => 'Europe/Moscow',
        'debug' => 'show',
    ],
    'db' => [
        'host' => 'localhost',
        'name'=> 'db',
        'user' => 'root',
        'pass' => 'password',
        'debug' => 'show',
        'charset'=>'utf8',
    ],
    'router' => [
        'api' => 'api',
        'alias' => [
            'login' => 'site/login',
            'logout' => 'site/logout',
            'reg' => 'site/reg',
        ],
    ],
];