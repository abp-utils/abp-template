<?php

namespace model\schema;

use abp\database\ActiveRecord;

/**
 * Class UserSession
 * @package model\schema
 *
 * @property int $user_session_id
 * @property string $user_id
 * @property string $token
 * @property string $ip
 * @property string $user_agent
 * @property int $is_active
 * @property int $challenge_code
 * @property int $created_time
 * @property int $updated_time
 *
 * @property \model\User $User
 */
class UserSession extends ActiveRecord
{
    public function attributeLabels(): array
    {
        return [
            'user_session_id' => '#',
            'user_id' => 'user_id',
            'token' => 'token',
            'ip' => 'ip',
            'user_agent' => 'user_agent',
            'is_active' => 'is_active',
            'challenge_code' => 'challenge_code',
            'created_time' => 'created_time',
            'updated_time' => 'updated_time',
        ];
    }

    public static function relation(): array
    {
        return [
            \model\User::class => ['one', 'user_id'],
        ];
    }

    public static function find()
    {
        return new \model\query\UserSession(get_called_class());
    }
}