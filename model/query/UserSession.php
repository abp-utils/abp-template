<?php
namespace model\query;

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