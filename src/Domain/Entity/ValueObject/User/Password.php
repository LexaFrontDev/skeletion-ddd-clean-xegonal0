<?php

namespace App\Domain\Entity\ValueObject\User;

use App\Domain\Exception\Core\ExceptionUserMessage;
use App\Domain\Exception\Core\StatusCode;
use App\Domain\Exception\DomainValidationException;

class Password
{
    private string $value;

    public function __construct(string $password)
    {
        $this->validate($password);
        $this->value = $password;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function validate(string $password): void
    {
        if (strlen($password) < 8 || strlen($password) > 240) {
            throw new DomainValidationException('Hashed password must be between 8 and 240 characters long: '.$password, ExceptionUserMessage::SERVER_ERROR, StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function isEqual(Password $otherPassword): bool
    {
        return $this->value === $otherPassword->getValue();
    }
}