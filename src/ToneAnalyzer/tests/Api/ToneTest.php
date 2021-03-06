<?php

namespace IBM\Watson\ToneAnalyzer\tests\Api;

use Mockery as m;
use Http\Message\UriFactory;
use PHPUnit\Framework\TestCase;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\Constraint\IsType;
use Http\Client\Common\HttpMethodsClient;
use IBM\Watson\Core\Hydrator\HydratorInterface;

class ToneTest extends TestCase
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

    public function testAnalyze()
    {
        $this->httpClient
            ->shouldReceive('post')
            ->andReturn($this->response);

        $this->hydrator
            ->shouldReceive('hydrate')
            ->andReturn([]);

        $this->uriFactory
            ->shouldReceive('createUri')
            ->andReturn('v3/tone?sentences=1');

        $api = new Tone($this->httpClient, $this->hydrator, $this->uriFactory);

        $response = $api->analyze('text', false, ['content_type' => 'text/html']);

        $this->assertInternalType(IsType::TYPE_ARRAY, $response);
    }

    public function testGetAllowedParameters()
    {
        $api = new Tone($this->httpClient, $this->hydrator, $this->uriFactory);

        $this->assertSame([
            'content_type',
            'content_language',
            'accept_language'
        ], $api->getAllowedParameters());
    }
}
