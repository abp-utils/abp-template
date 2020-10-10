<?php

namespace component\form;

use abp\exception\UserException;
use model\User;
use Abp;

class Login
{
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
        if (empty($data['username'])) {
            throw new UserException('Поле "имя пользователя" не может быть пустым.');
        }
        if (empty($data['password'])) {
            throw new UserException('Поле "пароль" не может быть пустым.');
        }

        $this->username = $data['username'];
        $this->password = $data['password'];

        return true;
    }

    /**
     * @return bool
     */
    public function login()
    {
        $hash = User::HASH_TYPE;
        $password = $hash($this->password);

        Abp::setCookie('username', $this->username);
        Abp::setCookie('hash', $password);

        return (bool) User::find()->byUsername($this->username)->byhash($password)->one();
    }
}