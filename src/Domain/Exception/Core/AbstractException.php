<?php

namespace App\Domain\Exception\Core;

abstract class AbstractException extends \Exception
{
    private string $userMessage;

    public function __construct(string $logMessage, string $userMessage, int $code = null)
    {
        parent::__construct($logMessage, $code ?? StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        $this->userMessage = $userMessage;
    }

    public function getUserMessage(): string
    {
        return $this->userMessage;
    }
}