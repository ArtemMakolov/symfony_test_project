<?php

namespace App\Exception\User;

use App\Exception\UserFriendlyExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class UserNotFoundException extends NotFoundHttpException implements UserFriendlyExceptionInterface
{
    public function __construct
    (
        ?string $message = "Пользователь не найден",
        Throwable $previous = null,
        int $code = 0,
        array $headers = []
    )
    {
        parent::__construct($message, $previous, $code, $headers);
    }
}