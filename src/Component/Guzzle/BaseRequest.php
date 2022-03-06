<?php

declare(strict_types=1);

namespace App\Component\Guzzle;

use GuzzleHttp\{
    Client,
    Exception\BadResponseException,
    Exception\GuzzleException
};
use ErrorException;
use Psr\Http\Message\ResponseInterface;

class BaseRequest
{
    private Client $client;

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client = new Client();
    }

    /**
     * @param string $type
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws ErrorException
     */
    protected function request(string $type, string $url, array $params = [], array $headers = []): ResponseInterface
    {
        $client = $this->getClient();

        $params = array_merge(['json' => $params], ['headers' => $headers]);

        try {
            return $client->request($type, $url, $params);
        } catch (BadResponseException $e) {
            throw new ErrorException($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException|ErrorException
     */
    public function get(string $url, array $params = [], array $headers = []): ResponseInterface
    {
        if ($params) {
            $url .= '?' . http_build_query($params);
        }

        return $this->request('GET', $url, [], $headers);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $queryParams
     * @return ResponseInterface
     * @throws GuzzleException|ErrorException
     */
    public function post(string $url, array $params = [], array $queryParams = []): ResponseInterface
    {
        if ($queryParams) {
            $url .= '?' . http_build_query($queryParams);
        }
        return $this->request('POST', $url, $params);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException|ErrorException
     */
    public function put(string $url, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->request('PUT', $url, $params, $headers);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException|ErrorException
     */
    public function delete(string $url, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->request('DELETE', $url, $params, $headers);
    }
}