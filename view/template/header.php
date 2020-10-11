<?php
use model\User;
/** @var User|null $user */
/** @var $this \component\controller\CommonController */
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">ABP</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarColor01" style="">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/about">О нас</a>
                </li>
                <?php if ($user === null): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Вход</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/reg">Регистрация</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/profile">Профиль</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выход</a>
                 </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
<main role="main" class="flex-shrink-0">
    <?php if ($user && !$user->isConfirmEmail()): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">Ваш e-mail не подтвержден. Нажмите сюда для отправки повторного письма.</div>
    <?php endif; ?>
<div class="container pt-5 pb-5">