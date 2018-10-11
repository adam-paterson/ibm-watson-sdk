<?php

namespace IBM\Watson\LanguageTranslator\tests\Api;

use Http\Client\Common\HttpMethodsClient;
use Http\Message\UriFactory;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\LanguageTranslator\Api\Identification;
use IBM\Watson\LanguageTranslator\Model\IdentifiableLanguages;
use IBM\Watson\LanguageTranslator\Model\IdentifiedLanguages;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class IdentificationTest extends TestCase
{
    private $httpClient;
    private $hydrator;
    private $uriFactory;
    private $response;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpMethodsClient::class);
        $this->hydrator   = m::mock(HydratorInterface::class);
        $this->uriFactory = m::mock(UriFactory::class);
        $this->response   = m::mock(ResponseInterface::class);
    }

    public function testList()
    {
        $this->hydrator
            ->shouldReceive('hydrate')
            ->andReturn(new IdentifiableLanguages([]));

        $api = new Identification($this->httpClient, $this->hydrator, $this->uriFactory);

        $this->httpClient
            ->shouldReceive('get')
            ->andReturn($this->response);

        $this->assertInstanceOf(IdentifiableLanguages::class, $api->list());
    }

    public function testIdentify()
    {
        $this->httpClient
            ->shouldReceive('post')
            ->andReturn($this->response);

        $this->hydrator
            ->shouldReceive('hydrate')
            ->andReturn(new IdentifiedLanguages(['ar', 'fr']));

        $api = new Identification($this->httpClient, $this->hydrator, $this->uriFactory);

        $this->assertInstanceOf(IdentifiedLanguages::class, $api->identify('text'));
    }

    public function testGetAllowedParameters()
    {
        $api = new Identification($this->httpClient, $this->hydrator, $this->uriFactory);

        $this->assertEmpty($api->getAllowedParameters());
    }
}
