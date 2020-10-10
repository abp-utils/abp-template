<?php

namespace component\form;

use abp\component\FormInterface;
use abp\exception\DatabaseException;
use abp\exception\UserException;
use model\User;

class Reg implements FormInterface
{
    const MIN_PASSWORD_LENGTH = 8;

    public $username = '';
    public $email = '';
    public $password = '';

    public function validate(array $data): bool
    {
        if (!isset($data['username'])
            || !isset($data['email'])
            || !isset($data['password'])
        ) {
            return false;
        }

        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];

        if (empty($this->username)) {
            throw new UserException('Поле "имя пользователя" не может быть пустым.');
        }
        if (empty($this->email)) {
            throw new UserException('Поле "email" не может быть пустым.');
        }
        if (empty($this->password)) {
            throw new UserException('Поле "пароль" не может быть пустым.');
        }
        if (strlen($this->password) < self::MIN_PASSWORD_LENGTH) {
            throw new UserException('Минимальная длина пароля - ' . self::MIN_PASSWORD_LENGTH . ' символов.');
        }
        if ($this->password !== $data['password_repeat']) {
            throw new UserException('Пароли не совпадают.');
        }

        return true;
    }

    public function execute(): bool
    {
        $user = new User();
        $user->reg($this->username, $this->email, $this->password);
    }
}