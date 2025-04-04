<?php

namespace App\Domain\Security\Permission;

enum UserPermissionsEnum: string implements PermissionInterface
{
    case USER_GET_SELF = 'userGetSelf';
    case USER_UPDATE_SELF = 'userUpdateSelf';
    case USER_CHANGE_PASSWORD_SELF = 'userChangePasswordSelf';
}