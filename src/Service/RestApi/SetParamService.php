<?php

declare(strict_types=1);

namespace App\Service\RestApi;

use App\Component\RestApi\RestApi;
use App\Dto\ParamMicroservice\ParamDto;
use App\Request\RestApi\SetParamRequest;
use GuzzleHttp\Exception\GuzzleException;

class SetParamService
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
     * @param SetParamRequest $request
     * @return ParamDto
     * @throws GuzzleException
     * @throws \ErrorException
     * @throws \Throwable
     */
    public function setParams(SetParamRequest $request): ParamDto
    {
        return $this->restApi->updateParams(
            $request->getName(),
            $request->getType(),
        );
    }
}