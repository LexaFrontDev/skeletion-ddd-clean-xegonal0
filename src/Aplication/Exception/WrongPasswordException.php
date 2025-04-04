<?php

namespace App\Application\Exception;

class WrongPasswordException extends ApplicationException
{
    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct($logMessage, $userMessage, $code);
    }
}