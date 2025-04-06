<?php

namespace App\Infrastructure\Security;

use App\Domain\Security\RoleEnum;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;

final class CustomJWTUser extends JWTUser
{
    public function getDomainRoleFromSymfonyRoles(): RoleEnum
    {
        if (in_array('ROLE_ADMIN', $this->getRoles())) {
            return RoleEnum::Admin;
        }

        return RoleEnum::User;
    }
}