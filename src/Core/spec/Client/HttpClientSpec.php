<?php

namespace spec\IBM\Watson\Core\Client;

use Http\Client\HttpClient as HttpClientInterface;
use IBM\Watson\Core\Client\HttpClient;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClientSpec extends ObjectBehavior
{
    function let(HttpClientInterface $httpClient)
    {
        $this->beConstructedWith($httpClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HttpClient::class);
        $this->shouldImplement(HttpClientInterface::class);
    }

    function it_sends_successful_request(HttpClientInterface $httpClient, RequestInterface $request, ResponseInterface $response)
    {
        $httpClient
            ->sendRequest($request)
            ->willReturn($response);

        $this
            ->sendRequest($request)
            ->shouldReturnAnInstanceOf(ResponseInterface::class);
    }
}
