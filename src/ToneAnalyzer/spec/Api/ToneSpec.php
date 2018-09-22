<?php

namespace spec\IBM\Watson\ToneAnalyzer\Api;

use Mockery as m;
use Http\Client\HttpClient;
use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ToneSpec extends ObjectBehavior
{
    public function let(
        HttpClient $httpClient,
        HydratorInterface $hydrator,
        RequestBuilder $requestBuilder
    ) {
        $this->beConstructedWith($httpClient, $hydrator, $requestBuilder);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Tone::class);
        $this->shouldHaveType(AbstractApi::class);
    }
}
