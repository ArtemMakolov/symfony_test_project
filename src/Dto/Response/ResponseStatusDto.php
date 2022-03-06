<?php

declare(strict_types=1);

namespace App\Dto\Response;

class ResponseStatusDto
{
    private bool $success;

    /**
     * ResponseStatusDto constructor.
     * @param bool $success
     */
    public function __construct(bool $success)
    {
        $this->success = $success;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}
