<?php

namespace IBM\Watson\Common\Tests;

use Http\Message\MessageFactory;
use Http\Message\RequestFactory;
use IBM\Watson\Common\RequestBuilder;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class RequestBuilderTest extends TestCase
{
    private $requestFactory;

    public function setUp()
    {
        $this->requestFactory = m::mock(RequestFactory::class);
    }

    public function testCreate()
    {
        $this->requestFactory->shouldReceive('createRequest')->andReturn(m::mock(RequestInterface::class));
        $requestBuilder = new RequestBuilder($this->requestFactory);
        $request = $requestBuilder->create('GET', '/api', [], null);

        $this->assertInstanceOf(RequestInterface::class, $request);
    }

    public function testDiscoverMessageFactory()
    {
        $requestBuilder = new RequestBuilder($this->requestFactory);
        $this->assertInstanceOf(MessageFactory::class, $requestBuilder->discoverMessageFactory());
    }
}
