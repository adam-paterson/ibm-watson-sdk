<?php

namespace IBM\Watson\Common\tests\HttpClient;

use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;
use IBM\Watson\Common\HttpClient\Builder;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class BuilderTest extends TestCase
{
    private $httpClient;
    private $messageFactory;
    private $uriFactory;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
        $this->messageFactory = m::mock(MessageFactory::class);
        $this->uriFactory = m::mock(UriFactory::class);
    }

    public function testCreateConfiguredClient()
    {
        $client = (new Builder())->createConfiguredClient();

        $this->assertInstanceOf(PluginClient::class, $client);
    }

    public function testWithEndpoint()
    {
        $client = (new Builder())->withEndpoint('https://mockurl.test')->createConfiguredClient();

        $this->assertInstanceOf(PluginClient::class, $client);
    }

    public function testWithCredentials()
    {
        $client = (new Builder())
            ->withCredentials('adam', 'password')
            ->createConfiguredClient();

        $this->assertInstanceOf(PluginClient::class, $client);
    }

    public function testAppendPlugin()
    {
        $plugin1 = m::mock(Plugin::class);
        $plugin2 = m::mock(Plugin::class);
        $plugin3 = m::mock(Plugin::class);

        $client = (new Builder())->appendPlugin($plugin1, $plugin2, $plugin3)->createConfiguredClient();

        $this->assertInstanceOf(PluginClient::class, $client);
    }

    public function testPrependPlugin()
    {
        $plugin1 = m::mock(Plugin::class);
        $plugin2 = m::mock(Plugin::class);
        $plugin3 = m::mock(Plugin::class);

        $client = (new Builder())->prependPlugin($plugin1, $plugin2, $plugin3)->createConfiguredClient();

        $this->assertInstanceOf(PluginClient::class, $client);
    }

    public function testWithLearningOptOut()
    {
        $client = (new Builder())->withLearningOptOut()->createConfiguredClient();

        $this->assertInstanceOf(PluginClient::class, $client);
    }
}
