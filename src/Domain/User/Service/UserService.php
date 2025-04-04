<?php

namespace App\Domain\User\Service;

use App\Domain\Exception\Core\ExceptionUserMessage;
use App\Domain\Exception\Core\StatusCode;
use App\Domain\Exception\DomainValidationException;
use App\Domain\User\Persistence\UserGatewayInterface;

class UserService
{
    public function __construct(private readonly UserGatewayInterface $userGateway)
    {
    }

    public static function validatePassword(string $password): void
    {
        if (strlen($password) < 8 || strlen($password) > 50) {
            throw new DomainValidationException('Password must be between 8 and 50 characters long: '.$password, ExceptionUserMessage::INVALID_PASSWORD_LENGTH, StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function validateUniqueEmail(string $email): void
    {
        $user = $this->userGateway->getByEmail($email);
        if (!is_null($user)) {
            throw new DomainValidationException('Email is already in use: '.$email, ExceptionUserMessage::EMAIL_ALREADY_IN_USE, StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function validateUniqueUsername(string $username): void
    {
        $user = $this->userGateway->getByUsername($username);
        if (!is_null($user)) {
            throw new DomainValidationException('Username is already in use: '.$username, ExceptionUserMessage::USERNAME_ALREADY_IN_USE, StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}