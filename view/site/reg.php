<?php
/** @var $this \abp\core\Controller */
/** @var $form \component\form\Reg */
?>

<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
    <h2><?= $this->title ?></h2>

    <form method="POST" action="/reg">
        <div class="form-group">
            <label for="exampleInputEmail1">Имя пользователя</label>
            <input name="username" type="text" class="form-control" value="<?= $form->username?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input name="email" type="email" class="form-control" value="<?= $form->email?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Пароль</label>
            <input name="password" type="password" class="form-control" value="<?= $form->password ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Повторите пароль</label>
            <input name="password_repeat" type="password" class="form-control">
        </div>
        <?= $this->showNotification() ?>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>

</div>