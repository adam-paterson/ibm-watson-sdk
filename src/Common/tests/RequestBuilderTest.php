<?php

namespace IBM\Watson\Common\tests;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\StreamFactoryDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Http\Message\RequestFactory;
use Http\Message\StreamFactory;
use IBM\Watson\Common\RequestBuilder;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

class RequestBuilderTest extends TestCase
{
    private $requestFactory;
    private $multipartStreamBuilder;

    public function setUp()
    {
        $this->requestFactory = MessageFactoryDiscovery::find();
        $streamFactory = StreamFactoryDiscovery::find();
        $this->multipartStreamBuilder = m::mock(MultipartStreamBuilder::class, [$streamFactory])->makePartial();
    }

    public function testCreate()
    {
        $requestBuilder = new RequestBuilder($this->requestFactory, $this->multipartStreamBuilder);

        $this->assertInstanceOf(RequestInterface::class, $requestBuilder->create('GET', '/something', []));
    }

    public function testCreateMultipartStream()
    {
        $requestBuilder = new RequestBuilder($this->requestFactory, $this->multipartStreamBuilder);

        $params = [
            [
                'name' => 'somename',
                'content' => 'content'
            ]
        ];

        $this->assertInstanceOf(RequestInterface::class, $requestBuilder->create('GET', '/something', [], $params));
    }
}
