<?php

declare(strict_types=1);

namespace App\Helper;

use App\Dto\Error\BadRequestExceptionItemDto;
use App\Dto\Error\ErrorShortDto;
use App\Exception\BadRequestException;
use Symfony\Component\Serializer\SerializerInterface;

class ExceptionHelper
{
    private SerializerInterface $serializer;

    /**
     * ExceptionHelper constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public static function createUnhandledExceptionObj(): ErrorShortDto
    {
        return new ErrorShortDto(500, 'Возникла непредвиденная ошибка');
    }

    public function createBadRequestException(string $field, string $message): BadRequestException
    {
        return new BadRequestException($this->serializer->serialize([new BadRequestExceptionItemDto($field, $message)], 'json'));
    }

    /**
     * @param BadRequestExceptionItemDto[] $badRequestExceptions
     * @return BadRequestException
     */
    public function createBadRequestExceptions(array $badRequestExceptions): BadRequestException
    {
        return new BadRequestException($this->serializer->serialize($badRequestExceptions, 'json'));
    }
}
