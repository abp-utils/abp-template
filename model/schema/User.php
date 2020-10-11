<?php

namespace model\schema;

use abp\database\ActiveRecord;

/**
 * Class User
 * @package model\schema
 *
 * @property int $user_id
 * @property string $username
 * @property string $email
 * @property string $hash
 * @property string $role
 * @property string $token
 * @property string $token_confirm
 * @property int $is_confirm
 * @property int $is_active
 * @property int $created_time
 * @property int $updated_time
 */
class User extends ActiveRecord
{
    public function attributeLabels(): array
    {
        return [
            'user_id' => '#',
            'username' => 'Имя пользователя',
            'email' => 'e-mail',
            'hash' => 'hash',
            'role' => 'Роль',
            'token' => 'Токен',
            'token_confirm' => 'token_confirm',
            'is_confirm' => 'is_confirm',
            'is_active' => 'is_active',
            'created_time' => 'created_time',
            'updated_time' => 'updated_time',
        ];
    }

    public static function find()
    {
        return new \model\query\User(get_called_class());
    }
}