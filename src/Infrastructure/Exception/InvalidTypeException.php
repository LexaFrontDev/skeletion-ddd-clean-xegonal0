<?php

namespace App\Infrastructure\Exception;

class InvalidTypeException extends InfrastructureException
{
    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct($logMessage, $userMessage, $code);
    }
}