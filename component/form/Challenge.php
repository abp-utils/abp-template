<?php

namespace component\form;

use abp\component\FormInterface;
use abp\exception\UserException;
use model\User;
use model\UserSession;
use Abp;

class Challenge implements FormInterface
{
    public $code = '';

    public function validate(array $data): bool
    {
        if (!isset($data['code'])) {
            return false;
        }

        $this->code = $data['code'];

        if (empty($this->code)) {
            throw new UserException('Поле "код подтверждения" не может быть пустым.');
        }

        return true;
    }

    public function execute(): bool
    {
        [$userId, $token] = Abp::$user->parseSessionInfo(\Abp::getCookie(\abp\model\User::SESSION_AUTH_ID));
        $userSession = UserSession::find()->byUniqueKey($userId, $token)->one();
        if ($userSession === null) {
            throw new UserException('Не удалось найти сессию. Попробуйте позже.');
        }
        $user = User::find()->byId($userId)->one();
        $user->challenge($userSession, $this->code);
        return true;
    }
}