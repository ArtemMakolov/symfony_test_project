<?php

declare(strict_types=1);

namespace App\Dto\ParamMicroservice;

class ParamDto
{
    private string $name;
    private bool $type;

    /**
     * @param string $name
     * @param bool $type
     */
    public function __construct(
        string $name,
        bool   $type
    ) {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): bool
    {
        return $this->type;
    }
}
