<?php

namespace component\form;

use abp\component\FormInterface;
use abp\component\Security;
use abp\exception\UserException;
use model\User;
use Abp;
use model\UserIp;
use model\UserSession;

class Login implements FormInterface
{
    public $username = '';
    public $password = '';
    /** @var User $user */
    private $user;

    public function validate(array $data): bool
    {
        if (!isset($data['username']) && !isset($data['password'])) {
            return false;
        }
        if (empty($data['username'])) {
            throw new UserException('Поле "имя пользователя" не может быть пустым.');
        }
        if (empty($data['password'])) {
            throw new UserException('Поле "пароль" не может быть пустым.');
        }
        $this->username = $data['username'];
        $this->password = $data['password'];

        $this->user = User::find()->byUserNameOrEmail($this->username)->one();
        if ($this->user === null) {
            throw new UserException('Пользователь не найден.');
        }

        return true;
    }

    public function execute(): bool
    {
        return $this->user->login($this->password);
    }
}