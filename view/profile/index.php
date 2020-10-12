<?php

/** @var \model\User $user */

use component\RoleAccessManager; ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a class="a-breadcrumb" href="<?= '/profile'?>">Профиль</a></li>
    </ol>
</nav>

<h3><?= $this->title ?></h3>

<?= $this->showNotification() ?>

<?= $user->beginForm() ?>

<?= $user->textInput('username') ?>

<?= $user->textInput('email') ?>

<?= $user->textInputDisable('token', '', '', $user->getToken()) ?>

<?= $user->textInput('hash', 'Смена пароля', 'Введите новый пароль', '', 'password') ?>

<?= $user->dropDownListDisable('role', RoleAccessManager::getRoles()) ?>

<?= $user->endForm(true, $user->_isNewRecord ? 'Создать' : 'Сохранить') ?>
