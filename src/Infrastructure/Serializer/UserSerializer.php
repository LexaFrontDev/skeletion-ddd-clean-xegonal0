<?php

namespace App\Infrastructure\Serializer;

use App\Domain\Entity\User\User;
use App\Domain\Exception\Core\ExceptionUserMessage;
use App\Domain\Exception\Core\StatusCode;
use App\Infrastructure\Exception\InvalidTypeException;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserSerializer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        if (!$object instanceof User) {
            throw new InvalidTypeException('Expected instance of '.User::class.', got '.gettype($object), ExceptionUserMessage::SERVER_ERROR, StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
        $user = $object;

        return [
            'id' => $user->getId(),
            'username' => $user->getUsername()->getValue(),
            'email' => $user->getEmail()->getValue(),
            'role' => $user->getRole()->value,
        ];
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            User::class => true,
        ];
    }
}