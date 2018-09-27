<?php

namespace IBM\Watson\Core\Client;

use Http\Message\RequestFactory;
use Psr\Http\Message\ResponseInterface;
use Http\Client\HttpClient as HttpClientInterface;

/**
 * Client responsible for sending the HTTP requests.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class ServiceClient implements ServiceClientInterface
{
    /**
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * @var \Http\Message\RequestFactory
     */
    protected $requestFactory;

    /**
     * @param \Http\Client\HttpClient      $httpClient
     * @param \Http\Message\RequestFactory $requestFactory
     */
    public function __construct(HttpClientInterface $httpClient, RequestFactory $requestFactory)
    {
        $this->httpClient     = $httpClient;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param string $uri
     * @param array  $parameters
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function get(string $uri, array $parameters = [], array $headers = []): ResponseInterface
    {
        if (count($parameters) > 0) {
            $uri .= '?'.http_build_query($parameters);
        }

        return $this->httpClient->sendRequest(
            $this->requestFactory->createRequest(static::HTTP_METHOD_GET, $uri, $headers)
        );
    }

    /**
     * @param string $uri
     * @param array  $parameters
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function post(string $uri, array $parameters = [], array $headers = []): ResponseInterface
    {
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        return $this->postRaw($uri, http_build_query($parameters), $headers);
    }

    /**
     * @param string $uri
     * @param        $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function postRaw(string $uri, $body, array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestFactory->createRequest(static::HTTP_METHOD_POST, $uri, $headers, $body)
        );
    }

    /**
     * @param string $uri
     * @param array  $parameters
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function put(string $uri, array $parameters = [], array $headers = []): ResponseInterface
    {
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        return $this->httpClient->sendRequest(
            $this->requestFactory->createRequest(static::HTTP_METHOD_PUT, $uri, $headers, $parameters)
        );
    }

    /**
     * @param string $uri
     * @param array  $parameters
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function delete(string $uri, array $parameters = [], array $headers = []): ResponseInterface
    {
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        return $this->httpClient->sendRequest(
            $this->requestFactory->createRequest(static::HTTP_METHOD_DELETE, $uri, $headers, http_build_query($parameters))
        );
    }

    /**
     * @param string $uri
     * @param        $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function patch(string $uri, $body, array $headers = []): ResponseInterface
    {
        $headers['Content-Type'] = 'application/json';

        return $this->httpClient->sendRequest(
            $this->requestFactory->createRequest(static::HTTP_METHOD_PATCH, $uri, $headers, json_encode($body))
        );
    }
}
