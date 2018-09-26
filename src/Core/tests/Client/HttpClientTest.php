<?php

namespace IBM\Watson\Core\tests\Client;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use IBM\Watson\Core\Client\HttpClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Http\Client\HttpClient as HttpClientInterface;

class HttpClientTest extends TestCase
{
    private $httpClient;
    private $request;
    private $response;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClientInterface::class);
        $this->request    = m::mock(RequestInterface::class);
        $this->response   = m::mock(ResponseInterface::class);

        $this->httpClient
            ->shouldReceive('sendRequest')
            ->with($this->request)
            ->andReturn($this->response);
    }

    public function testSendRequest()
    {
        $this->response
            ->shouldReceive('getStatusCode')
            ->andReturn(200);

        $httpClient = new HttpClient($this->httpClient);

        $response = $httpClient->sendRequest($this->request);

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    /**
     * @expectedException \Http\Client\Exception\HttpException
     */
    public function testErrorHandling()
    {
        $this->request
            ->shouldReceive('getRequestTarget')
            ->andReturn('https://api.example.com');
        $this->request
            ->shouldReceive('getMethod')
            ->andReturn('GET');

        $this->response
            ->shouldReceive('getStatusCode')
            ->andReturn(400);

        $this->response
            ->shouldReceive('getReasonPhrase')
            ->andReturn('Invalid request');

        $httpClient = new HttpClient($this->httpClient);

        $httpClient->sendRequest($this->request);
    }
}
