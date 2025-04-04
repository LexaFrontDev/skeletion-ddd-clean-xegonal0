<?php

namespace App\Domain\Exception;

class DomainValidationException extends DomainException
{
    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct('[VALIDATION]'.$logMessage, $userMessage, $code);
    }
}