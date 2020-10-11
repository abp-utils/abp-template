<?php

namespace component;

use abp\component\RoleAccessManagerInterface;
use model\User;

class RoleAccessManager implements RoleAccessManagerInterface
{
    public function roleColumn(): string
    {
        return 'role';
    }

    public function setDefaultRole(): string
    {
        return User::USER_ROLE;
    }

    public function setRoleAccess(): array
    {
        return [
            User::USER_ROLE => [
                'viewAboutPage',
            ],
            User::ADMIN_ROLE => [
                'viewAllUsers',
                'manageAllUsers',
            ],
        ];
    }

    public function setRolesDepends(): array
    {
        return [
            User::ADMIN_ROLE => [User::USER_ROLE],
            User::USER_ROLE => [],
        ];
    }
}