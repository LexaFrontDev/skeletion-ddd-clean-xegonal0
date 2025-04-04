<?php

namespace App\Application\Exception;

class ApplicationValidationException extends ApplicationException
{
    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct('[VALIDATION]'.$logMessage, $userMessage, $code);
    }
}