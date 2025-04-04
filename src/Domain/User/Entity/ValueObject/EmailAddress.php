<?php

namespace App\Domain\User\Entity\ValueObject;

use App\Domain\Exception\Core\ExceptionUserMessage;
use App\Domain\Exception\Core\StatusCode;
use App\Domain\Exception\DomainValidationException;

class EmailAddress
{
    private string $value;

    public function __construct(string $email)
    {
        $this->validate($email);
        $this->value = $email;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function validate(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new DomainValidationException('Invalid email address format: '.$email, ExceptionUserMessage::INVALID_EMAIL, StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function isEqual(EmailAddress $otherEmail): bool
    {
        return $this->value === $otherEmail->getValue();
    }
}