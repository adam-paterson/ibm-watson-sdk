<?php

namespace IBM\Watson\Common\Tests;

use Http\Client\HttpClient;
use Http\Message\Authentication;
use IBM\Watson\Common\HttpClient\Builder;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;

class BuilderTest extends TestCase
{
    public function testCreateConfiguredClient()
    {
        $client = (new Builder())
            ->createConfiguredClient();

        $this->assertInstanceOf(HttpClient::class, $client);
    }

    public function testWithAuthentication()
    {
        $builder = (new Builder())
            ->withAuthentication(m::mock(Authentication::class))
            ->createConfiguredClient();

        $this->assertInstanceOf(HttpClient::class, $builder);
    }

    public function testWithHostname()
    {
        $builder = (new Builder())
            ->withHostname('http://api.example.com/')
            ->createConfiguredClient();

        $this->assertInstanceOf(HttpClient::class, $builder);
    }

    public function testWithPath()
    {
        $builder = (new Builder())
            ->withPath('/test/path')
            ->createConfiguredClient();

        $this->assertInstanceOf(HttpClient::class, $builder);
    }
}
