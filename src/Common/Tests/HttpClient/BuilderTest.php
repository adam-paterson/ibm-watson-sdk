<?php

namespace IBM\Watson\Common\Tests;

use Http\Client\HttpClient;
use Http\Message\Authentication;
use IBM\Watson\Common\HttpClient\Builder;
use Mockery as m;
use PHPUnit\Framework\TestCase;

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
            ->withAuthentication(m::mock(Authentication::class));

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
