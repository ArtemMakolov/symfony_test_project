<?php

declare(strict_types=1);

namespace App\Helper;

use App\Dto\Response\ResponseStatusDto;

class ResponseHelper
{
    public static function createSuccessResponseObj(): ResponseStatusDto
    {
        return new ResponseStatusDto(true);
    }

    public static function createErrorResponseObj(): ResponseStatusDto
    {
        return new ResponseStatusDto(false);
    }
}
