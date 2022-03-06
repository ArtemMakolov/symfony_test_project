<?php

declare(strict_types=1);

namespace App\Service\RestApi;

use App\Component\RestApi\RestApi;
use App\Dto\ParamMicroservice\ParamDto;
use GuzzleHttp\Exception\GuzzleException;

class FindParamService
{
    private RestApi $restApi;

    /**
     * @param RestApi $restApi
     */
    public function __construct
    (
        RestApi $restApi
    )
    {
        $this->restApi = $restApi;
    }

    /**
     * @return ParamDto
     * @throws \ErrorException
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function find(): ParamDto
    {
        return $this->restApi->getParams();
    }
}