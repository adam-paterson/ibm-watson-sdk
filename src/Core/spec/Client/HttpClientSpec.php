<?php

namespace spec\IBM\Watson\Core\Client;

use Http\Client\Exception\HttpException;
use Http\Client\HttpClient as HttpClientInterface;
use http\Exception\RuntimeException;
use Http\Message\RequestFactory;
use IBM\Watson\Core\Client\HttpClient;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class HttpClientSpec extends ObjectBehavior
{
    function let(HttpClientInterface $httpClient, RequestFactory $requestFactory)
    {
        $this->beConstructedWith($httpClient, $requestFactory);
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

        $response
            ->getStatusCode()
            ->willReturn(200);

        $this
            ->sendRequest($request)
            ->shouldReturnAnInstanceOf(ResponseInterface::class);
    }

    function it_throws_an_exception_when_response_is_error(
        HttpClientInterface $httpClient,
        RequestInterface $request,
        ResponseInterface $response,
        StreamInterface $body
    ) {
        $httpClient
            ->sendRequest($request)
            ->willReturn($response);

        $response
            ->getStatusCode()
            ->willReturn(500);

        $response
            ->getBody()
            ->willReturn($body);

        $response
            ->getReasonPhrase()
            ->willReturn('Invalid JSON input at line 1, column 2');

        $body
            ->getContents()
            ->willReturn('{"code": 500, "sub_code": "C00012", "error": "Invalid JSON input at line 1, column 2"}');

        $request
            ->getRequestTarget()
            ->willReturn('https://api.example.com');

        $request
            ->getMethod()
            ->willReturn('GET');

        $this
            ->shouldThrow(HttpException::create($request->getWrappedObject(), $response->getWrappedObject()))
            ->during('sendRequest', [$request]);
    }
}
