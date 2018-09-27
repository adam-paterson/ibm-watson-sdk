<?php

namespace spec\IBM\Watson\Core\Client;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use IBM\Watson\Core\Client\ServiceClient;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ServiceClientSpec extends ObjectBehavior
{
    function let(HttpClient $httpClient, RequestFactory $requestFactory)
    {
        $this->beConstructedWith($httpClient, $requestFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ServiceClient::class);
    }

    function it_sends_get_request(
        HttpClient $httpClient,
        RequestFactory $requestFactory,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $httpClient
            ->sendRequest($request)
            ->willReturn($response);

        $requestFactory
            ->createRequest('GET', '/api?param=1', [], null)
            ->shouldBeCalled()
            ->willReturn($request);

        $response
            ->getStatusCode()
            ->willReturn(200);

        $this->get('/api', ['param' => 1])->shouldReturnAnInstanceOf(ResponseInterface::class);
    }

    function it_sends_post_request(
        HttpClient $httpClient,
        RequestFactory $requestFactory,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $httpClient
            ->sendRequest($request)
            ->willReturn($response);

        $requestFactory
            ->createRequest(
                'POST',
                '/api',
                ['Content-Type' => 'application/x-www-form-urlencoded'],
                'param=1'
            )
            ->willReturn($request);

        $response
            ->getStatusCode()
            ->willReturn(200);

        $this->post('/api', ['param' => 1])->shouldReturnAnInstanceOf(ResponseInterface::class);
    }

    function it_sends_raw_post_request(
        HttpClient $httpClient,
        RequestFactory $requestFactory,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $httpClient
            ->sendRequest($request)
            ->willReturn($response);

        $requestFactory
            ->createRequest(
                'POST',
                '/api',
                [],
                'param=1'
            )
            ->willReturn($request);

        $response
            ->getStatusCode()
            ->willReturn(200);

        $this->postRaw('/api','param=1', [])->shouldReturnAnInstanceOf(ResponseInterface::class);
    }

    function it_sends_put_request(
        HttpClient $httpClient,
        RequestFactory $requestFactory,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $httpClient
            ->sendRequest($request)
            ->willReturn($response);

        $requestFactory
            ->createRequest(
                'PUT',
                '/api',
                ['Content-Type' => 'application/x-www-form-urlencoded'],
                ['param' => 1]
            )
            ->willReturn($request);

        $this->put('/api', ['param' => 1], [])->shouldReturnAnInstanceOf(ResponseInterface::class);
    }

    function it_sends_delete_request(
        HttpClient $httpClient,
        RequestFactory $requestFactory,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $httpClient
            ->sendRequest($request)
            ->willReturn($response);

        $requestFactory
            ->createRequest(
                'DELETE',
                '/api',
                ['Content-Type' => 'application/x-www-form-urlencoded'],
                'param=1'
            )
            ->willReturn($request);

        $this->delete('/api', ['param' => 1])->shouldReturnAnInstanceOf(ResponseInterface::class);
    }

    function it_sends_patch_request(
        HttpClient $httpClient,
        RequestFactory $requestFactory,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $httpClient
            ->sendRequest($request)
            ->willReturn($response);

        $requestFactory
            ->createRequest(
                'PATCH',
                '/api',
                ['Content-Type' => 'application/json'],
                '"param=1"'
            )
            ->willReturn($request);

        $this->patch('/api', 'param=1', [])->shouldReturnAnInstanceOf(ResponseInterface::class);
    }
}
