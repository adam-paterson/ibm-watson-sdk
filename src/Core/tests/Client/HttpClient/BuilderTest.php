<?php

namespace IBM\Watson\Core\tests\Client\HttpClient;

use Mockery as m;
use Http\Client\HttpClient;
use Http\Message\UriFactory;
use PHPUnit\Framework\TestCase;
use Http\Message\Authentication;
use Http\Message\RequestFactory;
use Psr\Http\Message\UriInterface;
use Http\Client\Common\HttpMethodsClient;
use IBM\Watson\Core\Client\HttpClient\Builder;

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

        $this->uriFactory
            ->shouldReceive('createUri')
            ->with('https://example.com')
            ->andReturn($this->uri);

        $httpClient = (new Builder())
            ->setHttpClient($this->httpClient)
            ->setRequestFactory($this->requestFactory)
            ->setUriFactory($this->uriFactory)
            ->withAuthentication($this->authentication)
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

    public function testWithAuthentication()
    {
        $builder = new Builder();
        $builder->withAuthentication($this->authentication);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
