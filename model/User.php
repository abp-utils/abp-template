<?php

namespace model;

use model\schema\User as UserSchema;

class User extends UserSchema
{
    public const USER_ROLE = 'user';
    public const ADMIN_ROLE = 'admin';

    public function reg(string $username, string $email, string $password)
    {
        $token = $this->generateUserToken();
        $tokenConfirm = $this->generateUserToken();
        $this->username = $username;
        $this->email = $email;
        $this->hash = $this->hashUserPassword($password);
        $this->token = sha1($token);
        $this->token_confirm = sha1($tokenConfirm);
    }

    private function hashUserPassword(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    private function generateUserToken(): string
    {
        return sha1(uniqid('', true));
    }
}