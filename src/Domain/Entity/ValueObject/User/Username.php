<?php

namespace App\Domain\Entity\ValueObject\User;

use App\Domain\Exception\Core\ExceptionUserMessage;
use App\Domain\Exception\Core\StatusCode;
use App\Domain\Exception\DomainValidationException;

class Username
{
    private string $value;

    public function __construct(string $username)
    {
        $this->validate($username);
        $this->value = $username;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function validate(string $username): void
    {
        if (strlen($username) < 3 || strlen($username) > 20) {
            throw new DomainValidationException('Username must be between 3 and 20 characters: '.$username, ExceptionUserMessage::INVALID_USERNAME, StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function isEqual(Username $otherUsername): bool
    {
        return $this->value === $otherUsername->getValue();
    }
}