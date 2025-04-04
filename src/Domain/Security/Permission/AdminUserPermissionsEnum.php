<?php

namespace App\Domain\Security\Permission;

enum AdminUserPermissionsEnum: string implements PermissionInterface
{
    case USER_CHANGE_PASSWORD = 'userChangePassword';
}