<?php

namespace IBM\Watson\ToneAnalyzer\tests\Client;

use Mockery as m;
use Http\Client\HttpClient;
use PHPUnit\Framework\TestCase;
use Http\Message\Authentication;
use IBM\Watson\ToneAnalyzer\Client;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\Core\Hydrator\HydratorInterface;

class ClientTest extends TestCase
{
    private $httpClient;
    private $hydrator;
    private $authentication;

    public function setUp()
    {
        $this->httpClient     = m::mock(HttpClient::class);
        $this->hydrator       = m::mock(HydratorInterface::class);
        $this->authentication = m::mock(Authentication::class);
    }

    public function testCreate()
    {
        $client = Client::create($this->authentication);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testTone()
    {
        $client = Client::create($this->authentication);
        $this->assertInstanceOf(Tone::class, $client->tone());
    }
}
