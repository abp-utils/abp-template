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
        'pass' => '',
        'charset'=>'utf8',
    ],
    'router' => [
        'alias' => [
            'login' => 'site/login',
            'logout' => 'site/logout',
            'reg' => 'site/reg',
            'challenge' => 'site/challenge',
        ],
    ],
];