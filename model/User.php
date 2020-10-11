<?php

namespace model;

use abp\component\Security;
use model\schema\User as UserSchema;

class User extends UserSchema
{
    public const USER_ROLE = 'user';
    public const ADMIN_ROLE = 'admin';

    public function reg(string $username, string $email, string $password): bool
    {
        $token = Security::generateRandomString();
        $tokenConfirm = Security::generateRandomString();
        $this->username = $username;
        $this->email = $email;
        $this->hash = Security::generateHashWithSalt($password);
        $this->role = self::USER_ROLE;
        $this->token = Security::generateHash($token);
        $this->token_confirm = Security::generateHash($tokenConfirm);
        try {
            \Abp::$db->beginTransaction();
            $this->save();
            $userSession = UserSession::ensureSession($this);
            UserIp::ensureIp($this, \Abp::$user->getIp());
            \Abp::$db->commit();
            return true;
        } catch (\Throwable $e) {
            \Abp::$db->rollBack();
            throw $e;
        }
    }

    public function isNewIp(): bool
    {
        return UserIp::find()->byUniqueKey($this, \Abp::$user->getIp())->exist();
    }
}