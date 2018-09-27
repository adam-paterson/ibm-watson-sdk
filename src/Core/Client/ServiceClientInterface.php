<?php

namespace IBM\Watson\Core\Client;

use Psr\Http\Message\ResponseInterface;

interface ServiceClientInterface
{
    const HTTP_METHOD_GET    = 'GET';
    const HTTP_METHOD_POST   = 'POST';
    const HTTP_METHOD_PUT    = 'PUT';
    const HTTP_METHOD_DELETE = 'DELETE';
    const HTTP_METHOD_PATCH  = 'PATCH';

    /**
     * @param string $uri
     * @param array  $parameters
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $uri, array $parameters = [], array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param array  $parmaeters
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $uri, array $parmaeters = [], array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param        $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function postRaw(string $uri, $body, array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param array  $parameters
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function put(string $uri, array $parameters = [], array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param array  $parameters
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete(string $uri, array $parameters = [], array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param        $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patch(string $uri, $body, array $headers = []): ResponseInterface;
}
