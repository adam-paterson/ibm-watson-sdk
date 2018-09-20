<?php

namespace IBM\Watson\Common\Tests;

use Http\Client\HttpClient;
use IBM\Watson\Common\AbstractClient;
use IBM\Watson\Common\BasicAuthClient;
use IBM\Watson\Common\BasicAuthClientInterface;
use PHPUnit\Framework\TestCase;

class BasicAuthClientTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $this->client = BasicAuthClient::create('username', 'password');
    }

    public function testCreate()
    {
        $this->assertInstanceOf(AbstractClient::class, $this->client);
        $this->assertInstanceOf(BasicAuthClientInterface::class, $this->client);
    }

    public function testDiscoverHttpClient()
    {
        $httpClient = $this->client->discoverHttpClient();
        $this->assertInstanceOf(HttpClient::class, $httpClient);
    }
}
