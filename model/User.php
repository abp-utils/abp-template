<?php

namespace model;

use abp\component\Security;
use component\RoleAccessManager;
use model\schema\User as UserSchema;

class User extends UserSchema
{
    public function reg(string $username, string $email, string $password): bool
    {
        $token = Security::generateRandomString();
        $tokenConfirm = Security::generateRandomString();
        $this->username = $username;
        $this->email = $email;
        $this->hash = Security::generateHashWithSalt($password);
        $this->role = RoleAccessManager::USER_ROLE;
        $this->token = Security::generateHash($token);
        $this->token_confirm = Security::generateHash($tokenConfirm);
        $this->is_active = true;
        try {
            \Abp::$db->beginTransaction();
            $this->save();
            $userSession = UserSession::ensureSession($this);
            UserIp::ensureIp($this, \Abp::$user->getIp());
            \Abp::$user->setCookieAuthInfo($this->user_id, $userSession->tokenNoHash, $token);
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

    public function isConfirmEmail(): bool
    {
        return $this->is_confirm;
    }

    public function getPrintRole(): string
    {
        return RoleAccessManager::getRoles()[$this->role] ?? 'н/д';
    }
}