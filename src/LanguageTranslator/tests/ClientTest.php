<?php

namespace IBM\Watson\LanguageTranslator\tests;

use Http\Message\Authentication;
use IBM\Watson\Core\Client\HttpClient;
use IBM\Watson\LanguageTranslator\Api\Identification;
use IBM\Watson\LanguageTranslator\Api\Translation;
use IBM\Watson\LanguageTranslator\Client;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $httpClient;
    private $authentication;

    public function setUp()
    {
        $this->httpClient     = m::mock(HttpClient::class);
        $this->authentication = m::mock(Authentication::class);
    }

    public function testIdentification()
    {
        $client = new Client($this->httpClient);
        $this->assertInstanceOf(Identification::class, $client->identification());
    }

    public function testTranslation()
    {
        $client = new Client($this->httpClient);
        $this->assertInstanceOf(Translation::class, $client->translation());
    }

    public function testCreate()
    {
        $client = Client::create($this->authentication);

        $this->assertInstanceOf(Client::class, $client);
    }
}
