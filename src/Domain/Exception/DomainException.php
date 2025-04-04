<?php

namespace App\Domain\Exception;

use App\Domain\Exception\Core\AbstractException;

abstract class DomainException extends AbstractException
{
    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct('[DOMAIN]'.$logMessage, $userMessage, $code);
    }
}