<?php

namespace App\Infrastructure\Security;

use App\Domain\Entity\User\User;
use App\Domain\Security\RoleEnum;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SymfonyUserAdapter implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private readonly User $user
    ) {
    }

    public function getDomainUser(): User
    {
        return $this->user;
    }

    public function getPassword(): ?string
    {
        return $this->user->getPassword()->getValue();
    }

    public function getRoles(): array
    {
        $domainRole = $this->user->getRole();
        $roles = [$this->getSymfonyRoleFromDomainRole($domainRole)];
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    private function getSymfonyRoleFromDomainRole(RoleEnum $domainRole): string
    {
        return match ($domainRole) {
            RoleEnum::User => 'ROLE_USER',
            RoleEnum::Admin => 'ROLE_ADMIN'
        };
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->user->getEmail()->getValue();
    }
}