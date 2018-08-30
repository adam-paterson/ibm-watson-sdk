<?php

namespace IBM\Watson\Common\tests;

use http\Env\Request;
use Http\Message\RequestFactory;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\Common\Util\DiscoveryTrait;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use Psr\Http\Message\RequestInterface;

class RequestBuilderTest extends TestCase
{
    use DiscoveryTrait;

    private $requestFactory;

    public function setUp()
    {
        $this->requestFactory = $this->discoverMessageFactory();
    }

    public function testCreateRequest()
    {
        $requestBuilder = new RequestBuilder($this->requestFactory);
        $request = $requestBuilder->create('GET', '/api');

        $this->assertInstanceOf(RequestInterface::class, $request);
    }
}
