<?php
use abp\component\Resource;
?>
<!DOCTYPE html>
<html lang="ru" class="h-100 mdl-js">
<head>
    <title><?= ((isset($this) && $this->title) ? $this->title : 'Страница не найдена') ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="HandheldFriendly" content="true"/>
    <link rel="shortcut icon" type="image/x-icon" href="/resourse/img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">
    <?php
    Resource::register([
        [
            'file' => 'font-awesome/css/font-awesome.min.css'
        ],
        [
            'file' => 'bootstrap',
            'type' => 'css',
        ],
    ]);
    ?>
</head>
<body class="d-flex flex-column h-100">