<?php

namespace App\Domain\Security;

use App\Domain\Security\Permission\AdminUserPermissionsEnum;
use App\Domain\Security\Permission\PermissionInterface;
use App\Domain\Security\Permission\UserPermissionsEnum;

enum RoleEnum: string
{
    case User = 'user';
    case Admin = 'admin';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return PermissionInterface[]
     */
    public function getPermissions(): array
    {
        return match ($this) {
            RoleEnum::User => $this->getUserPermissions(),
            RoleEnum::Admin => $this->getAdminUserPermissions()
        };
    }

    public function hasPermission(PermissionInterface $permission): bool
    {
        return match ($this) {
            RoleEnum::User => in_array($permission, $this->getUserPermissions()),
            RoleEnum::Admin => in_array($permission, $this->getAdminUserPermissions())
        };
    }

    /**
     * @return UserPermissionsEnum[]
     */
    private function getUserPermissions(): array
    {
        return UserPermissionsEnum::cases();
    }

    /**
     * @return PermissionInterface[]
     */
    private function getAdminUserPermissions(): array
    {
        return [
            ...UserPermissionsEnum::cases(),
            ...AdminUserPermissionsEnum::cases(),
        ];
    }
}