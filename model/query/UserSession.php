<?php
namespace model\query;

use abp\component\Security;
Use abp\database\ActiveQuery;

/**
 * Class UserSession
 * @package model\query
 */
class UserSession extends ActiveQuery
{
    public function byId(string $id): self
    {
        return $this->where('user_session_id', $id);
    }

    public function byUser(\model\User $user): self
    {
        return $this->where('user_id', $user->user_id);
    }

    public function byToken(string $token): self
    {
        return $this->where('token', Security::generateHash($token));
    }

    public function byUniqueKey(string $userId, string $token)
    {
        return $this->whereContidion([
            ['user_id' => $userId],
            'and',
            ['token' => Security::generateHash($token)],
        ]);
    }

    /**
     * @return \model\UserSession
     */
    public function one()
    {
        return parent::one(); // TODO: Change the autogenerated stub
    }

    /**
     * @return \model\UserSession[]
     */
    public function all()
    {
        return parent::all(); // TODO: Change the autogenerated stub
    }
}