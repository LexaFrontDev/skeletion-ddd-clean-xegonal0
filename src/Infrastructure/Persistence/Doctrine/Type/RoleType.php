<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Exception\Core\ExceptionUserMessage;
use App\Domain\Exception\Core\StatusCode;
use App\Domain\Security\RoleEnum;
use App\Infrastructure\Exception\InvalidTypeException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class RoleType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'VARCHAR(50)';
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): RoleEnum
    {
        if (!is_string($value)) {
            throw new InvalidTypeException('Expected string to find role from doctrine, got '.gettype($value), ExceptionUserMessage::SERVER_ERROR, StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        $role = RoleEnum::tryFrom($value);
        if (null === $role) {
            throw new InvalidTypeException('Given role '.$value.' is not part of RoleEnum', ExceptionUserMessage::SERVER_ERROR, StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $role;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if (!$value instanceof RoleEnum) {
            throw new InvalidTypeException('Expected RoleEnum value to convert for doctrine, got '.gettype($value), ExceptionUserMessage::SERVER_ERROR, StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $value->value;
    }

    public function getName(): string
    {
        return 'role_enum';
    }
}