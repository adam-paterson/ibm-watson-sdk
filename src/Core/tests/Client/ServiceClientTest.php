<?php

namespace IBM\Watson\Core\tests\Client;

use Mockery as m;
use Http\Client\HttpClient;
use PHPUnit\Framework\TestCase;
use Http\Message\RequestFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use IBM\Watson\Core\Client\ServiceClient;

class ServiceClientTest extends TestCase
{
    private $httpClient;
    private $requestFactory;
    private $request;
    private $response;

    public function setUp()
    {
        $this->httpClient     = m::mock(HttpClient::class);
        $this->requestFactory = m::mock(RequestFactory::class);
        $this->request        = m::mock(RequestInterface::class);
        $this->response       = m::mock(ResponseInterface::class);
    }

    public function testGet()
    {
        $this->setUpRequest();
        $this->setUpSuccessfulResponse();

        $client = new ServiceClient($this->httpClient, $this->requestFactory);

        $response = $client->get('/api', ['param' => 1]);

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testPost()
    {
        $this->setUpRequest();
        $this->setUpSuccessfulResponse();

        $client = new ServiceClient($this->httpClient, $this->requestFactory);

        $response = $client->post('/api', ['param' => 1]);

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testPostRaw()
    {
        $this->setUpRequest();
        $this->setUpSuccessfulResponse();

        $client = new ServiceClient($this->httpClient, $this->requestFactory);

        $response = $client->postRaw('/api', 'param=1');
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testPut()
    {
        $this->setUpRequest();
        $this->setUpSuccessfulResponse();

        $client = new ServiceClient($this->httpClient, $this->requestFactory);

        $response = $client->put('/api', ['param' => 1]);
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testDelete()
    {
        $this->setUpRequest();
        $this->setUpSuccessfulResponse();

        $client = new ServiceClient($this->httpClient, $this->requestFactory);

        $response = $client->delete('/api', ['param' => 1]);
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testPatch()
    {
        $this->setUpRequest();
        $this->setUpSuccessfulResponse();

        $client = new ServiceClient($this->httpClient, $this->requestFactory);

        $response = $client->patch('/api', 'param=1');
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    private function setUpRequest()
    {
        $this->requestFactory
            ->shouldReceive('createRequest')
            ->andReturn($this->request);
    }

    private function setUpSuccessfulResponse()
    {
        $this->httpClient
            ->shouldReceive('sendRequest')
            ->andReturn($this->response);
    }
}
