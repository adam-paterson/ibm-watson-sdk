<?php

namespace IBM\Watson\Common\tests\HttpClient;

use Http\Client\Common\Plugin;
use Http\Client\HttpClient;
use Http\Message\UriFactory;
use IBM\Watson\Common\HttpClient\Builder;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class BuilderTest extends TestCase
{
    private $httpClient;
    private $uriFactory;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
        $this->uriFactory = m::mock(UriFactory::class);
    }

    public function testCreateConfiguredClient()
    {
        // Test builder can use preconfigured http client.
        $client = (new Builder($this->httpClient))->createConfiguredClient();
        $this->assertInstanceOf(HttpClient::class, $client);

        // Test builder discovers http client when not specified.
        $client = (new Builder())->createConfiguredClient();
        $this->assertInstanceOf(HttpClient::class, $client);
    }

    public function testCanAddPlugins()
    {
        $firstPlugin = m::mock(Plugin::class);
        $secondPlugin = m::mock(Plugin::class);
        $thirdPlugin = m::mock(Plugin::class);

        $builder = new Builder($this->httpClient);
        $builder->addPlugin($firstPlugin, $secondPlugin, $thirdPlugin);

        $this->assertInstanceOf(HttpClient::class, $builder->createConfiguredClient());
    }

    public function testWithCredentials()
    {
        $client = (new Builder($this->httpClient))
            ->withCredentials('username', 'password')
            ->createConfiguredClient();

        $this->assertInstanceOf(HttpClient::class, $client);
    }
}
