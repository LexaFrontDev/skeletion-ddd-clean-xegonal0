<?php

namespace App\Domain\Persistence\User;

use App\Domain\Entity\User\User;

interface UserGatewayInterface
{
    public function save(User $user): User;

    public function delete(User $user): void;

    public function getByEmail(string $email): ?User;

    public function getByUsername(string $username): ?User;

    public function getById(int $id): ?User;

    public function getByIdentifier(int|string $identifier): ?User;
}