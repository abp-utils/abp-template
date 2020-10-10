<?php

namespace component\form;

use abp\exception\DatabaseException;
use abp\exception\UserException;
use model\User;
use Abp;

class Reg
{
    const MIN_PASSWORD_LENGTH = 8;

    public $username = '';
    public $email = '';
    public $password = '';

    /**
     * @param array $data
     * @return bool
     * @throws UserException
     */
    public function load($data)
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

    /**
     * @return bool
     * @throws DatabaseException
     */
    public function reg()
    {
        $user = new User();
        $user->reg([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
        ]);
    }
}