<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Exception\RequestExceptionInterface;
use Throwable;

class BadRequestException extends Exception implements UserFriendlyExceptionInterface, RequestExceptionInterface
{
    /**
     * BadRequestException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
