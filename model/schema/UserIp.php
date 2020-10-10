<?php

namespace model\schema;

use abp\database\ActiveRecord;

/**
 * Class UserIp
 * @package model\schema
 *
 * @property int $user_ip_id
 * @property string $user_id
 * @property string $ip
 */
class UserIp extends ActiveRecord
{
    public function attributeLabels(): array
    {
        return [
            'user_ip_id' => '#',
            'user_id' => 'user_id',
            'ip' => 'ip',
        ];
    }

    public static function find()
    {
        return new \model\query\UserIp(get_called_class());
    }
}