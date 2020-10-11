<?php

namespace model;

use model\schema\UserIp as UserIpSchema;

/**
 * Class UserIp
 * @package model
 */
class UserIp extends UserIpSchema
{
    public function createTimestamp()
    {
        return false;
    }

    public function updateTimestamp()
    {
        return false;
    }

    public static function ensureIp(User $user, string $ip): self
    {
        $userIp = self::find()->byUniqueKey($user, $ip)->one();
        if ($userIp === null) {
            $userIp = new self();
            $userIp->user_id = $user->user_id;
            $userIp->ip = \Abp::$user->getIp();
            $userIp->save();
        }
        return $userIp;
    }
}