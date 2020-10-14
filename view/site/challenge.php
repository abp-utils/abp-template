<?php
/** @var $this \abp\core\Controller */
/** @var $user \model\User */
/** @var $form \component\form\Challenge */
?>

<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
    <h2><?= $this->title ?></h2>

    <form method="POST" action="/challenge">
        <div class="form-group">
            <label for="exampleInputEmail1">Код подтверждения</label>
            <input name="code" type="text" class="form-control" value="<?= $form->code ?>">
            <div class="form-text text-muted">Введите код подтверждения, высланный Вам на email <?= $user->cutEmail()?></div>
        </div>
        <?= $this->showNotification() ?>
        <button type="submit" class="btn btn-primary">Подтвердить</button>
    </form>

</div>