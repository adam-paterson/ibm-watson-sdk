<?php

namespace IBM\Watson\Core\tests\Client\HttpClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;
use Http\Message\Authentication;
use Http\Message\RequestFactory;
use Http\Message\UriFactory;
use IBM\Watson\Core\Client\HttpClient\Builder;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;

class BuilderTest extends TestCase
{
    private $httpClient;

    private $requestFactory;

    private $uriFactory;

    private $uri;

    private $authentication;

    public function setUp()
    {
        $this->httpClient     = m::mock(HttpClient::class);
        $this->requestFactory = m::mock(RequestFactory::class);
        $this->uriFactory     = m::mock(UriFactory::class);
        $this->uri            = m::mock(UriInterface::class);
        $this->authentication = m::mock(Authentication::class);
    }

    public function testCreate()
    {
        $this->uri
            ->shouldReceive('getHost')
            ->andReturn('example.com');

        $this->uri
            ->shouldReceive('getPath')
            ->andReturn('api/path');

        $this->uriFactory
            ->shouldReceive('createUri')
            ->with('https://example.com')
            ->andReturn($this->uri);

        $this->uriFactory
            ->shouldReceive('createUri')
            ->with('api/path')
            ->andReturn($this->uri);

        $httpClient = (new Builder())
            ->setHttpClient($this->httpClient)
            ->setRequestFactory($this->requestFactory)
            ->setUriFactory($this->uriFactory)
            ->withAuthentication($this->authentication)
            ->withVersion('2018-09-11')
            ->withPath('api/path')
            ->withHost('https://example.com')
            ->create();

        $this->assertInstanceOf(HttpMethodsClient::class, $httpClient);
    }

    public function testCreateWithoutCollaboratorsProvided()
    {
        $this->uri
            ->shouldReceive('getHost')
            ->andReturn('example.com');

        $httpClient = (new Builder())
            ->withHost('https://example.com')
            ->create();

        $this->assertInstanceOf(HttpMethodsClient::class, $httpClient);
    }

    public function testSetHttpClient()
    {
        $builder = new Builder();
        $builder->setHttpClient($this->httpClient);

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testSetRequestFactory()
    {
        $builder = new Builder();
        $builder->setRequestFactory($this->requestFactory);

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testSetUriFactory()
    {
        $builder = new Builder();
        $builder->setUriFactory($this->uriFactory);

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testWithAuthentication()
    {
        $builder = new Builder();
        $builder->withAuthentication($this->authentication);

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testWithVersion()
    {
        $builder = new Builder();
        $builder->withVersion('2018-09-11');

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testWithPath()
    {
        $builder = new Builder();
        $builder->withPath('api/path');

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testCreatePluginsClient()
    {
        $httpClient = (new Builder())
            ->withPath('api/path')
            ->withVersion('2018-09-11')
            ->withAuthentication($this->authentication)
            ->create();

        $this->assertInstanceOf(HttpMethodsClient::class, $httpClient);
    }
}
