<?php

namespace App\Application\Security;

use App\Domain\User\Entity\User;

interface PasswordHasherInterface
{
    public function hash(User $user, string $plainPassword): string;

    public function isValid(User $user, string $plainPassword): bool;
}