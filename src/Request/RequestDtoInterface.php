<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;

interface RequestDtoInterface
{
    public function __construct(Request $request);
}
