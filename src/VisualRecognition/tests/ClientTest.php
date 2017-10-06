<?php

namespace IBM\Watson\VisualRecognition\tests;

use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\VisualRecognition\Api\Classify;
use IBM\Watson\VisualRecognition\Client;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class ClientTest extends TestCase
{
    private $httpClient;
    private $hydrator;
    private $requestBuilder;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
        $this->hydrator = m::mock(HydratorInterface::class);
        $this->requestBuilder = m::mock(new RequestBuilder);
    }

    public function testCreate()
    {
        $client = Client::create('123');
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testClassify()
    {
        $client = Client::create('123');
        $this->assertInstanceOf(Classify::class, $client->classify());
    }
}
