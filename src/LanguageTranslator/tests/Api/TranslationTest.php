<?php

namespace IBM\Watson\LanguageTranslator\tests\Api;

use Http\Client\Common\HttpMethodsClient;
use Http\Message\UriFactory;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\LanguageTranslator\Api\Translation;
use IBM\Watson\LanguageTranslator\Model\TranslationResult;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class TranslationTest extends TestCase
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

    public function testTranslate()
    {
        $this->httpClient
            ->shouldReceive('post')
            ->andReturn($this->response);

        $this->hydrator
            ->shouldReceive('hydrate')
            ->andReturn(m::mock(TranslationResult::class));

        $api = new Translation($this->httpClient, $this->hydrator, $this->uriFactory);

        $this->assertInstanceOf(TranslationResult::class, $api->translate('test', 'en-US'));
    }

    /**
     * @expectedException \IBM\Watson\Core\Exception\InvalidArgumentException
     */
    public function testErrorIsThrownWhenModelOrSourceAndTargetAreNotProvided()
    {
        $api = new Translation($this->httpClient, $this->hydrator, $this->uriFactory);

        $api->translate('text');
    }

    public function testTranslateWithTargetAndSource()
    {
        $this->httpClient
            ->shouldReceive('post')
            ->andReturn($this->response);

        $this->hydrator
            ->shouldReceive('hydrate')
            ->andReturn(m::mock(TranslationResult::class));

        $api = new Translation($this->httpClient, $this->hydrator, $this->uriFactory);

        $this->assertInstanceOf(TranslationResult::class, $api->translate('test', null, 'en-US', 'fr-FR'));
    }

    public function testGetAllowedParams()
    {
        $api = new Translation($this->httpClient, $this->hydrator, $this->uriFactory);

        $this->assertEmpty($api->getAllowedParameters());
    }
}
