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
    }

    public function testSendRequest()
    {
        $this->httpClient
            ->shouldReceive('sendRequest')
            ->with($this->request)
            ->andReturn($this->response);

        $httpClient = new HttpClient($this->httpClient);

        $response = $httpClient->sendRequest($this->request);

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}
