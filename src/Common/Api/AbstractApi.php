<?php

namespace IBM\Watson\Common\Api;

use Http\Client\HttpClient;
use IBM\Watson\Common\Exception\Api\BadRequestException;
use IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException;
use IBM\Watson\Common\Exception\Domain\NotFoundException;
use IBM\Watson\Common\Exception\Domain\UnknownErrorException;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\RequestBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 *
 */
abstract class AbstractApi
{
    /**
     * @var string HTTP methods
     */
    const HTTP_METHOD_GET       = 'GET';
    const HTTP_METHOD_POST      = 'POST';
    const HTTP_METHOD_PUT       = 'PUT';
    const HTTP_METHOD_PATCH     = 'PATCH';
    const HTTP_METHOD_DELETE    = 'DELETE';

    /**
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * @var \IBM\Watson\Common\Hydrator\HydratorInterface
     */
    protected $hydrator;

    /**
     * @var \IBM\Watson\Common\RequestBuilder
     */
    private $requestBuilder;

    /**
     * @param \Http\Client\HttpClient                       $httpClient
     * @param \IBM\Watson\Common\Hydrator\HydratorInterface $hydrator
     * @param \IBM\Watson\Common\RequestBuilder             $requestBuilder
     */
    public function __construct(
        HttpClient $httpClient,
        HydratorInterface $hydrator,
        RequestBuilder $requestBuilder
    ) {
        $this->httpClient     = $httpClient;
        $this->hydrator = $hydrator;
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * @param string|UriInterface $path
     * @param array               $params
     * @param array               $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function get($path, array $params = [], array $headers = [])
    {
        $path = $this->buildQueryPath($path, $params);

        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_GET, $path, $headers)
        );
    }

    /**
     * @param string|UriInterface $path
     * @param array               $params
     * @param array               $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function post($path, array $params = [], array $headers = [])
    {
        return $this->postRaw($path, \http_build_query($params), $headers);
    }

    /**
     * @param string|UriInterface                  $path
     * @param resource|string|StreamInterface|null $body
     * @param array                                $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function postRaw($path, $body, array $headers = [])
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_POST, $path, $headers, $body)
        );
    }

    /**
     * @param string|UriInterface $path
     * @param array               $params
     * @param array               $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function put($path, array $params = [], array $headers = [])
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_PUT, $path, $headers, \http_build_query($params))
        );
    }

    /**
     * @param string|UriInterface $path
     * @param array               $params
     * @param array               $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function patch($path, array $params = [], array $headers = [])
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_PATCH, $path, $headers, \json_encode($params))
        );
    }

    /**
     * @param string|UriInterface $path
     * @param array               $params
     * @param array               $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    protected function delete($path, array $params = [], array $headers = [])
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create(static::HTTP_METHOD_DELETE, $path, $headers, \http_build_query($params))
        );
    }

    /**
     * Handle errors from response
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return void
     *
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     */
    protected function handleErrors(ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();
        $content = \json_decode($body, true);
        $message = '';

        if (JSON_ERROR_NONE === \json_last_error()) {
            $message = $content['error'];
        }

        switch ($response->getStatusCode()) {
            case 400:
                throw new BadRequestException($message);
            case 401:
                throw new InsufficientPrivilegesException($message);
            case 404:
                throw new NotFoundException($message);
            case 500:
                throw new UnknownErrorException($message);
            default:
                throw new UnknownErrorException($message);
        }
    }

    /**
     * @param string|UriInterface $path
     * @param array               $params
     *
     * @return string
     */
    private function buildQueryPath($path, array $params)
    {
        if (count($params) > 0) {
            $path .= '?' . \http_build_query($params);
        }

        return $path;
    }
}
