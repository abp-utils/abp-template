<?php

namespace component\form;

use abp\exception\DatabaseException;
use component\exception\UserException;
use model\User;
use Abp;

class Reg
{
    const MIN_PASSWORD_LENGTH = 8;

    public $username = '';
    public $password = '';

    /**
     * @param array $data
     * @return bool
     * @throws UserException
     */
    public function load($data)
    {
        if (!isset($data['username']) && !isset($data['password'])) {
            return false;
        }

        $this->username = $data['username'];
        $this->password = $data['password'];

        if (empty($this->username)) {
            throw new UserException('Поле "логин" не может быть пустым.');
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
        if (User::find()->byUsername($this->username)->one()) {
            throw new UserException('Пользователь с именем ' . $data['username'] . ' уже существует в системе.');
        }

        return true;
    }

    /**
     * @return bool
     * @throws DatabaseException
     */
    public function reg()
    {
        $hash = User::HASH_TYPE;
        $password = $hash($this->password);

        $user = new User();
        $user->username = $this->username;
        $user->hash = $password;
        $user->role = User::USER_ROLE;

        if (!$user->save()) {
            throw new DatabaseException();
        }

        Abp::setCookie('username', $this->username);
        Abp::setCookie('hash', $password);

        return true;
    }
}