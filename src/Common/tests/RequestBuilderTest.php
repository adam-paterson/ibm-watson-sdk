<?php

namespace IBM\Watson\Common\tests;

use GuzzleHttp\Psr7\Request;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use IBM\Watson\Common\RequestBuilder;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use Psr\Http\Message\RequestInterface;

class RequestBuilderTest extends TestCase
{
    private $requestFactory;

    public function setUp()
    {
        $this->requestFactory = MessageFactoryDiscovery::find();
    }

    public function testCreate()
    {
        $requestBuilder = new RequestBuilder($this->requestFactory);

        $this->assertInstanceOf(RequestInterface::class, $requestBuilder->create('GET', '/something', []));
    }
}
