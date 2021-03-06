<?php
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/vendor/abp-utils/abp/Abp.php';

$config = array_merge(
    require(__DIR__ . '/config/main.php'),
    require(__DIR__ . '/config/main-local.php')
);
Abp::init($config);