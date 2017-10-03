<?php

namespace IBM\Watson\Common\Api;

use Http\Client\HttpClient;
use IBM\Watson\Common\Exception\InsufficientPrivilegesException;
use IBM\Watson\Common\Exception\NotFoundException;
use IBM\Watson\Common\Exception\UnknownErrorException;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\NoopHydrator;
use IBM\Watson\Common\RequestBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @codeCoverageIgnore
 */
abstract class AbstractApi
{
    /**
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * @var \IBM\Watson\Common\Hydrator\HydratorInterface
     */
    protected $hydrator;

    /**
     * @var \IBM\Watson\Common\RequestBuilder
     */
    protected $requestBuilder;

    /**
     * AbstractApi constructor.
     *
     * @param \Http\Client\HttpClient                       $httpClient
     * @param \IBM\Watson\Common\Hydrator\HydratorInterface $hydrator
     * @param \IBM\Watson\Common\RequestBuilder             $requestBuilder
     */
    public function __construct(HttpClient $httpClient, HydratorInterface $hydrator, RequestBuilder $requestBuilder)
    {
        $this->httpClient = $httpClient;

        if (!$hydrator instanceof NoopHydrator) {
            $this->hydrator = $hydrator;
        }

        $this->requestBuilder = $requestBuilder;
    }

    /**
     * Create and send PSR-7 GET request
     *
     * @param string     $path
     * @param array|null $params
     * @param array|null $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    protected function get($path, array $params = null, array $headers = null)
    {
        if (null === $params) {
            $params = [];
        }

        if (null === $headers) {
            $headers = [];
        }

        if (count($params) > 0) {
            $path .= '?' . \http_build_query($params);
        }

        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('GET', $path, $headers)
        );
    }

    /**
     * Create and send PSR-7 POST request
     *
     * @param string     $path
     * @param array|null $params
     * @param array|null $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    protected function post($path, array $params = null, array $headers = null)
    {
        if (null === $headers) {
            $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        }

        if (null === $params) {
            $params = [];
        }

        return $this->postRaw($path, \http_build_query($params), $headers);
    }

    /**
     * Create and send PSR-7 POST request
     *
     * @param string                               $path
     * @param resource|string|StreamInterface|null $body
     * @param array|null                           $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    protected function postRaw($path, $body, array $headers = null)
    {
        if (null === $headers) {
            $headers = [];
        }

        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('POST', $path, $headers, $body)
        );
    }

    /**
     * Create and set PSR-7 PUT request
     *
     * @param string     $path
     * @param array|null $params
     * @param array|null $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    protected function put($path, array $params = null, array $headers = null)
    {
        if (null === $headers) {
            $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        }

        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('PUT', $path, $headers, \http_build_query($params))
        );
    }

    /**
     * Create and send PSR-7 PATCH request
     *
     * @param string     $path
     * @param array|null $params
     * @param array|null $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    protected function patch($path, array $params = null, array $headers = null)
    {
        if (null === $headers) {
            $headers = ['Content-Type' => 'application/json'];
        }

        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('PATCH', $path, $headers, \json_encode($params))
        );
    }

    /**
     * Create and send PSR-7 DELETE request
     *
     * @param string     $path
     * @param array|null $params
     * @param array|null $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    protected function delete($path, array $params = null, array $headers = null)
    {
        if (null === $headers) {
            $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        }

        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('DELETE', $path, $headers, \http_build_query($params))
        );
    }

    /**
     * Handle API errors
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @throws \IBM\Watson\Common\Exception\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\NotFoundException
     * @throws \IBM\Watson\Common\Exception\UnknownErrorException
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
            case 401:
                throw new InsufficientPrivilegesException($message);
                break;
            case 404:
                throw new NotFoundException($message);
                break;
            default:
                throw new UnknownErrorException($message);
                break;
        }
    }
}
