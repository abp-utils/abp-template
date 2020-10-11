<?php

namespace component;

use abp\component\RoleAccessManagerInterface;

class RoleAccessManager implements RoleAccessManagerInterface
{
    public const USER_ROLE = 'user';
    public const ADMIN_ROLE = 'admin';

    public static function getRoles(): array
    {
        return [
            self::USER_ROLE => 'Пользователь',
            self::ADMIN_ROLE => 'Администратор',
        ];
    }

    public function roleColumn(): string
    {
        return 'role';
    }

    public function setDefaultRole(): string
    {
        return self::USER_ROLE;
    }

    public function setRoleAccess(): array
    {
        return [
            self::USER_ROLE => [
                'viewAboutPage',
            ],
            self::ADMIN_ROLE => [
                'viewAllUsers',
                'manageAllUsers',
            ],
        ];
    }

    public function setRolesDepends(): array
    {
        return [
            self::ADMIN_ROLE => [self::USER_ROLE],
            self::USER_ROLE => [],
        ];
    }
}