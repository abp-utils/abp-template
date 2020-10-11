<?php

namespace model;

use abp\component\Security;
use model\schema\UserSession as UserSessionSchema;

/**
 * Class UserSession
 * @package model
 */
class UserSession extends UserSessionSchema
{
    private const SESSION_TOKEN_COOKIE_NAME = 'SID';

    private const CODE_LENGTH = 6;

    public $tokenNoHash;

    public static function ensureSession(User $user, bool $isActive): self
    {
        if (!$user->_isNewRecord) {
            $session = \Abp::$user->parseSessionInfo(\Abp::getCookie(self::SESSION_TOKEN_COOKIE_NAME));
            if (!empty($session)) {
                [$token, $identity] = $session;
                $userSession = self::find()->byUser($user)->byToken($token)->one();
                if ($userSession) {
                    if (!$isActive) {
                        $userSession->generateChallengeCode();
                    }
                    return $userSession;
                }
            }
        }
        $token = Security::generateRandomString();
        $userSession = new UserSession();
        $userSession->user_id = $user->user_id;
        $userSession->token = Security::generateHash($token);
        $userSession->ip = \Abp::$user->getIp();
        $userSession->user_agent = \Abp::$user->getUserAgent();
        $userSession->is_active = $isActive;
        if ($user->_isNewRecord) {
            $userSession->is_active = true;
        }
        if (!$isActive) {
            $userSession->generateChallengeCode();
        }
        $userSession->tokenNoHash = $token;
        $userSession->save();
        return $userSession;
    }

    public function generateChallengeCode(): void
    {
        $this->challenge_code =  Security::generateRandomInt(self::CODE_LENGTH);
    }
}