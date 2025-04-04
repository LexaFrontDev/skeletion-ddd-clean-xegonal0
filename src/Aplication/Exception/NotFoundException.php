<?php

namespace App\Application\Exception;

class NotFoundException extends ApplicationException
{
    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct($logMessage, $userMessage, $code);
    }
}
