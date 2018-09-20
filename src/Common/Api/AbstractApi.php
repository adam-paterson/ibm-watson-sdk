<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Api;

use Http\Client\HttpClient;
use IBM\Watson\Common\RequestBuilderInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * AbstractApi is used to create and send HTTP requests.
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * @var RequestBuilderInterface
     */
    private $requestBuilder;

    /**
     * @param \Http\Client\HttpClient                    $httpClient     HTTP client to send requests.
     * @param \IBM\Watson\Common\RequestBuilderInterface $requestBuilder Request builder to create requests.
     */
    public function __construct(
        HttpClient $httpClient,
        RequestBuilderInterface $requestBuilder
    ) {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * Create and send GET request.
     *
     * @param string|UriInterface $uri     API URI.
     * @param array               $params  Query parameters.
     * @param array               $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     */
    protected function get($uri, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_GET, $uri, $params, $headers)
        );
    }

    /**
     * Create and send HEAD request.
     *
     * @param string|UriInterface $uri     API URI.
     * @param array               $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function head($uri, array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_HEAD, $uri, $headers, null)
        );
    }

    /**
     * Create and send TRACE request.
     *
     * @param string|UriInterface $uri     API URI.
     * @param array               $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function trace($uri, array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_TRACE, $uri, $headers, null)
        );
    }

    /**
     * Create and send POST request.
     *
     * @param string|UriInterface $uri     API URI.
     * @param array               $params  Query parameters.
     * @param array               $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     */
    protected function post($uri, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->postRaw($uri, \http_build_query($params), $headers);
    }

    /**
     * Create and send POST request.
     *
     * @param string|UriInterface                  $uri     API URI.
     * @param resource|string|StreamInterface|null $body    Request body.
     * @param array                                $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     */
    protected function postRaw($uri, $body, array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_POST, $uri, $headers, $body)
        );
    }

    /**
     * Create and send PUT request.
     *
     * @param string|UriInterface $uri     API URI.
     * @param array               $params  Query parameters.
     * @param array               $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     */
    protected function put($uri, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_PUT, $uri, $params, $headers)
        );
    }

    /**
     * Create and send PATCH request.
     *
     * @param string|UriInterface                  $uri     API URI.
     * @param resource|string|StreamInterface|null $body    Request body.
     * @param array                                $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function patch($uri, $body, array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_PATCH, $uri, $headers, $body)
        );
    }

    /**
     * Create and send DELETE request.
     *
     * @param string|UriInterface $uri     API URI.
     * @param array               $params  Query parameters.
     * @param array               $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function delete($uri, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_DELETE, $uri, $params, $headers)
        );
    }

    /**
     * Create and send OPTIONS request.
     *
     * @param string|UriInterface $uri     API URI.
     * @param array               $params  Query parameters.
     * @param array               $headers Query headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function options($uri, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_OPTIONS, $uri, $params, $headers)
        );
    }
}
