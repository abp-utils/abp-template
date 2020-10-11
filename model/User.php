<?php

namespace model;

use abp\component\Security;
use abp\exception\UserException;
use component\exception\ChallengeCodeException;
use component\RoleAccessManager;
use model\schema\User as UserSchema;
use Abp;

class User extends UserSchema
{
    public function __construct($class = null, $params = [])
    {
        parent::__construct($class, $params);
        if (!Abp::$user->isGuest()) {
            UserIp::ensureIp($this, Abp::$user->getIp());
        }
    }
    public function reg(string $username, string $email, string $password): void
    {
        $tokenConfirm = Security::generateRandomString();
        $this->username = $username;
        $this->email = $email;
        $this->hash = Security::generateHashWithSalt($password);
        $this->role = RoleAccessManager::USER_ROLE;
        $this->token_confirm = Security::generateHash($tokenConfirm);
        $this->is_active = true;
        $this->setAuthData(true);
    }

    public function login(string $password): bool
    {
        $isCorrectPassword = Security::verifyPassword($password, $this->hash);
        if (!$isCorrectPassword) {
            throw new UserException('Неверный пароль.');
        }
        $userIp = UserIp::find()->byUniqueKey($this, Abp::$user->getIp())->one();
        if ($userIp !== null) {
            $this->setAuthData(true);
            return true;
        }
        $this->setAuthData(false);
        throw new ChallengeCodeException();
    }

    public function challenge(UserSession $userSession, string $code)
    {
        if ($userSession->challenge_code != $code) {
            throw new UserException('Неверный код подтверждения.');
        }
        $this->setAuthData(true);
    }

    private function setAuthData(bool $isActiveSession): void
    {
        try {
            \Abp::$db->beginTransaction();
            $token = Security::generateRandomString();
            $this->token = Security::generateHash($token);
            $userSession = UserSession::ensureSession($this, $isActiveSession);
            if ($userSession->is_active) {
                UserIp::ensureIp($this, \Abp::$user->getIp());
            } else {
                $token = null;
            }
            \Abp::$user->setCookieAuthInfo($this->user_id, $userSession->tokenNoHash, $token);
            $this->save();
            \Abp::$db->commit();
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

    public function cutEmail(): string
    {
        $emailParts = explode('@', $this->email);
        return $this->email[0] . '*******@' . end($emailParts);
    }

    public function getToken(): string
    {
        $token = Abp::getCookie(\abp\model\User::TOKEN_API_ID);
        if ($token) {
            if (Security::generateHash($token) === $this->token) {
                return $token;
            }
        }
        $newToken = Security::generateRandomString();
        Abp::setCookie(\abp\model\User::TOKEN_API_ID, $newToken);
        $this->token = Security::generateHash($newToken);
        $this->save();
        return $newToken;
    }
}