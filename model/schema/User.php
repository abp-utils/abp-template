<?php

namespace model\schema;

Use abp\database\ActiveRecord;

/**
 * Class User
 * @package model\schema
 *
 * @property int $user_id
 * @property string $username
 * @property string $hash
 * @property int $role
 */
class User extends ActiveRecord
{

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'user_id' => '#',
            'username' => 'Имя пользователя',
            'role' => 'Роль',
        ];
    }

    public function changingAttributes()
    {
        return [
            'hash' => function () {
                $hash = \model\User::HASH_TYPE;
                return $hash($this->hash);
                },
        ];
    }

    /**
     * @return \model\query\User
     */
    public static function find()
    {
        return new \model\query\User(get_called_class());
    }

}