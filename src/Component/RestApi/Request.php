<?php

declare(strict_types=1);

namespace App\Component\RestApi;

use App\Component\Guzzle\BaseRequest;
use ErrorException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Request extends BaseRequest
{
    private string $apiUrl;

    /**
     * Request constructor.
     * @param string $apiUrl
     */
    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @param string $type
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return ResponseInterface
     * @throws ErrorException
     * @throws GuzzleException
     */
    public function request(string $type, string $url, array $params = [], array $headers = []): ResponseInterface
    {
        return parent::request($type, $this->apiUrl . $url, $params, $headers);
    }
}