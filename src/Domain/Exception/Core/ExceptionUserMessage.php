<?php

namespace App\Domain\Exception\Core;

class ExceptionUserMessage
{
    public const SERVER_ERROR = 'SERVER_ERROR';
    public const USER_NOT_FOUND = 'USER_NOT_FOUND';
    public const INVALID_EMAIL = 'INVALID_EMAIL';
    public const EMAIL_ALREADY_IN_USE = 'EMAIL_ALREADY_IN_USE';
    public const INVALID_USERNAME = 'INVALID_USERNAME';
    public const USERNAME_ALREADY_IN_USE = 'USERNAME_ALREADY_IN_USE';
    public const INVALID_PASSWORD = 'INVALID_PASSWORD';
    public const INVALID_PASSWORD_LENGTH = 'INVALID_PASSWORD_LENGTH';
    public const ACCESS_DENIED = 'ACCESS_DENIED';
    public const BAD_CREDENTIALS = 'BAD_CREDENTIALS';
    public const INVALID_TOKEN = 'INVALID_TOKEN';
    public const INVALID_REFRESH_TOKEN = 'INVALID_REFRESH_TOKEN';
    public const REFRESH_TOKEN_NOT_FOUND = 'REFRESH_TOKEN_NOT_FOUND';
}
