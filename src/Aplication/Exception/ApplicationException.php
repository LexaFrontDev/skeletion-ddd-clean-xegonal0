<?php

namespace App\Application\Exception;

use App\Domain\Exception\Core\AbstractException;

abstract class ApplicationException extends AbstractException
{
    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct('[APPLICATION]'.$logMessage, $userMessage, $code);
    }
}