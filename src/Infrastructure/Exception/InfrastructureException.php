<?php

namespace App\Infrastructure\Exception;

use App\Domain\Exception\Core\AbstractException;

abstract class InfrastructureException extends AbstractException
{
    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct('[INFRASTRUCTURE]'.$logMessage, $userMessage, $code);
    }
}