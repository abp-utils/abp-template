<?php

namespace model;

use model\schema\User as UserSchema;
use Abp;

class User extends UserSchema
{
    const HASH_TYPE = 'md5';

    const ADMIN_ROLE = 'admin';
    const USER_ROLE = 'user';

    /**
     * @param bool $verify
     * @return bool|User
     */
    public static function this($verify = true)
    {
        if ($username = Abp::getCookie('username')) {
            $user = self::find()->byUsername($username)->one();
            if ($verify) {
                if ($user->hash == Abp::getCookie('hash')) {
                    return $user;
                }
            }
            return $user;
        }
        return false;
    }

    /**
     * @param array $data
     * @return array
     */
    public function apiResponse($data)
    {
        return $data;
    }

    /**
     * @return string
     */
    public function getPrintRole()
    {
        return self::getPrintRoles()[$this->role];
    }

    /**
     * @return array
     */
    public static function getRoles()
    {
        return [
            self::ADMIN_ROLE,
            self::USER_ROLE,
        ];
    }

    /**
     * @return array
     */
    public static function getPrintRoles()
    {
        return [
            self::ADMIN_ROLE => 'Администратор',
            self::USER_ROLE => 'Пользователь',
        ];
    }
}