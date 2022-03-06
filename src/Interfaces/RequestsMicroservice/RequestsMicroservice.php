<?php

namespace App\Interfaces\RequestsMicroservice;

use App\Dto\ParamMicroservice\ParamDto;
use ErrorException;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

interface RequestsMicroservice
{
    /**
     * @return ParamDto
     * @throws ErrorException
     * @throws GuzzleException
     * @throws Throwable
     */
    public function getParams(): ParamDto;

    /**
     * @param string $name
     * @param bool $type
     * @return ParamDto
     * @throws ErrorException
     * @throws GuzzleException
     * @throws Throwable
     */
    public function updateParams(string $name, bool $type): ParamDto;
}