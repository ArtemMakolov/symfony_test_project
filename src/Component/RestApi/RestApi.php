<?php

declare(strict_types=1);

namespace App\Component\RestApi;

use App\Dto\ParamMicroservice\ParamDto;
use App\Interfaces\RequestsMicroservice\RequestsMicroservice;
use Psr\Log\LoggerInterface;
use Throwable;

class RestApi implements RequestsMicroservice
{
    private LoggerInterface $logger;
    private Request $request;

    /**
     * RestApi constructor.
     * @param LoggerInterface $logger
     * @param Request $request
     */
    public function __construct
    (
        LoggerInterface $logger,
        Request         $request
    )
    {
        $this->logger = $logger;
        $this->request = $request;
    }

    /**
     * {@inheritDoc}
     */
    public function getParams(): ParamDto
    {
        try {
            $request = $this->request->get("/params");

            $body = json_decode($request->getBody()->getContents(), true);

            return new ParamDto(
                $body['name'],
                $body['type'],
            );

        } catch (Throwable $exception) {
            $this->logger->error($exception);

            throw new $exception;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function updateParams(string $name, bool $type): ParamDto
    {
        try {
            $request = $this->request->post("/params", [
                $name,
                $type
            ]);

            $body = json_decode($request->getBody()->getContents(), true);

            return new ParamDto(
                $body['name'],
                $body['type'],
            );

        } catch (Throwable $exception) {
            $this->logger->error($exception);

            throw new $exception;
        }
    }
}