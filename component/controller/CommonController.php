<?php

namespace component\controller;

use abp\core\Controller;
use model\User;
use model\UserSession;
use Abp;

/**
 * Class СommonController
 * @package component
 *
 * @property User $user
 */
class CommonController extends Controller
{
    private $user;
    private $userSession;

    protected function getUser(): ?User
    {
        if ($this->user === null) {
            if (\Abp::$user->isGuest()) {
                return null;
            }
            $this->user = User::find()->byId(\Abp::$user->getId())->active()->one();
        }
        return $this->user;
    }

    protected function getUserSession(): ?UserSession
    {
        if ($this->userSession === null) {
            $sessionInfo = \Abp::getCookie(\abp\model\User::SESSION_AUTH_ID);
            if ($sessionInfo === null) {
                return null;
            }
            [$userId, $token] = Abp::$user->parseSessionInfo(
                \Abp::getCookie(\abp\model\User::SESSION_AUTH_ID)
            );
            $this->userSession = UserSession::find()->byUniqueKey($userId, $token)->one();
        }
        return $this->userSession;
    }
}