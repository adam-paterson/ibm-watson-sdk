<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Client;

use Psr\Http\Message\RequestInterface;
use Http\Client\HttpClient as HttpClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * HTTP Client to send a PSR-7 compliant request.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class HttpClient implements HttpClientInterface
{
    /**
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * @param \Http\Client\HttpClient $baseClient
     */
    public function __construct(HttpClientInterface $baseClient)
    {
        $this->httpClient = $baseClient;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->httpClient->sendRequest($request);
    }
}
