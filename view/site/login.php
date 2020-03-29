<?php
/** @var $this \abp\core\Controller */
/** @var $form \component\form\Login */
?>

<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
<h2><?= $this->title ?></h2>

<form method="POST" action="/login">
    <div class="form-group">
        <label for="exampleInputEmail1">Email или логин</label>
        <input name="username" type="text" class="form-control" value="<?= $form->username ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input name="password" type="password" class="form-control" value="<?= $form->password ?>">
    </div>
    <?= $this->showNotification() ?>
    <button type="submit" class="btn btn-primary">Вход</button>
</form>

</div>