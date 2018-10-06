<?php

namespace IBM\Watson\ToneAnalyzer\tests\Api;

use Mockery as m;
use Http\Message\UriFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\Constraint\IsType;
use Http\Client\Common\HttpMethodsClient;
use IBM\Watson\ToneAnalyzer\Api\ToneChat;
use IBM\Watson\Core\Hydrator\HydratorInterface;

class ToneChatTest extends TestCase
{
    private $httpClient;
    private $hydrator;
    private $uriFactory;
    private $request;
    private $response;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpMethodsClient::class);
        $this->hydrator   = m::mock(HydratorInterface::class);
        $this->uriFactory = m::mock(UriFactory::class);
        $this->request    = m::mock(RequestInterface::class);
        $this->response   = m::mock(ResponseInterface::class);
    }

    public function testGetAllowedParameters()
    {
        $toneChat = new ToneChat($this->httpClient, $this->hydrator, $this->uriFactory);

        $this->assertSame([
            ToneChat::PARAM_ACCEPT_LANGUAGE,
            ToneChat::PARAM_CONTENT_LANGUAGE
        ], $toneChat->getAllowedParameters());
    }

    public function testAnalyze()
    {
        $this->httpClient
            ->shouldReceive('post')
            ->andReturn($this->response);

        $this->hydrator
            ->shouldReceive('hydrate')
            ->andReturn([]);

        $api = new ToneChat($this->httpClient, $this->hydrator, $this->uriFactory);

        $utterances = [
            [
                'text' => 'text',
                'user' => 'customer'
            ]
        ];

        $response = $api->analyze($utterances);
        $this->assertInternalType(IsType::TYPE_ARRAY, $response);
    }
}
