<?php

namespace IBM\Watson\ToneAnalyzer\Tests\Api;

use Mockery as m;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use IBM\Watson\Common\Tests\AbstractTestCase;

class ToneTest extends AbstractTestCase
{
    private $toneAnalysis;

    public function testAnalyze()
    {
        $response = $this->getMockResponse('ToneResponse.json');

        $this->toneAnalysis = m::mock(ToneAnalysis::class)->makePartial();

        $this->hydrator
            ->shouldReceive('hydrate')
            ->once()
            ->andReturn($this->toneAnalysis);

        $this->httpClient
            ->shouldReceive('sendRequest')
            ->once()
            ->andReturn($response);

        $this->requestBuilder->shouldReceive('create');

        $api = new Tone($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->analyze('text');

        $this->assertInstanceOf(ToneAnalysis::class, $response);
    }
}
