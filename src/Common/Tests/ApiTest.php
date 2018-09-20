<?php

namespace IBM\Watson\Common\Tests;

use Mockery as m;
use IBM\Watson\Common\stubs\Api;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiTest extends AbstractTestCase
{
    /**
     * @var \IBM\Watson\Common\Api\ApiInterface
     */
    private $api;

    public function setUp()
    {
        parent::setUp();

        $this->api = new Api($this->httpClient, $this->requestBuilder);

        $this->requestBuilder
            ->shouldReceive('create')
            ->once()
            ->andReturn(m::mock(RequestInterface::class));

        $this->httpClient
            ->shouldReceive('sendRequest')
            ->once()
            ->andReturn(m::mock(ResponseInterface::class));
    }

    public function testGet()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->api->httpMethodGet());
    }

    public function testHead()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->api->httpMethodHead());
    }

    public function testTrace()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->api->httpMethodTrace());
    }

    public function testPost()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->api->httpMethodPost());
    }

    public function testPut()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->api->httpMethodPut());
    }

    public function testPatch()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->api->httpMethodPatch());
    }

    public function testDelete()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->api->httpMethodDelete());
    }

    public function testOptions()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->api->httpMethodOptions());
    }
}
