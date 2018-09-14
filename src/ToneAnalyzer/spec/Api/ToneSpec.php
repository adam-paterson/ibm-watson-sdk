<?php

namespace spec\IBM\Watson\ToneAnalyzer\Api;

use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Model\CreateableFromArray;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;

class ToneSpec extends ObjectBehavior
{
    function let(
        HttpClient $httpClient,
        HydratorInterface $hydrator,
        RequestBuilder $requestBuilder
    ) {
        $this->beConstructedWith(
            $httpClient,
            $hydrator,
            $requestBuilder
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Tone::class);
    }
}
