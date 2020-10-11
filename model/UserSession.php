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

    public $tokenNoHash;

    public static function ensureSession(User $user): self
    {
        if (!$user->_isNewRecord) {
            $session = \Abp::$user->parseSessionInfo(\Abp::getCookie(self::SESSION_TOKEN_COOKIE_NAME));
            if (!empty($session)) {
                $userSession = self::find()->byUser($user)->byToken($session['token'])->one();
                if ($userSession) {
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
        if ($user->_isNewRecord) {
            $userSession->is_active = true;
        }
        $userSession->tokenNoHash = $token;
        $userSession->save();
        return $userSession;
    }
}