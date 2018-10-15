<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Client;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient as HttpClientInterface;
use Http\Message\RequestFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * HTTP Client to send a PSR-7 compliant request, wraps an ExceptionHandler client to throw
 * exceptions when API returns an error response.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class HttpClient extends HttpMethodsClient
{
    /**
     * @var \IBM\Watson\Core\Client\ExceptionHandler
     */
    private $exceptionHandler;

    /**
     * @param \Http\Client\HttpClient      $baseClient
     * @param \Http\Message\RequestFactory $requestFactory
     */
    public function __construct(HttpClientInterface $baseClient, RequestFactory $requestFactory)
    {
        parent::__construct($baseClient, $requestFactory);
        $this->exceptionHandler = new ExceptionHandler();
    }

    /**
     * Send PSR-7 request.
     *
     * @param \Psr\Http\Message\RequestInterface $request Request to send.
     *
     * @return \Psr\Http\Message\ResponseInterface Response from API.
     *
     * @throws \Http\Client\Exception
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $response = parent::sendRequest($request);

        if (200 !== $response->getStatusCode()) {
            $this->exceptionHandler->handle($request, $response);
        }

        return $response;
    }
}
