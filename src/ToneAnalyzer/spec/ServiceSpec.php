<?php

namespace spec\IBM\Watson\ToneAnalyzer;

use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\Common\WatsonService;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Service;
use PhpSpec\ObjectBehavior;

class ServiceSpec extends ObjectBehavior
{
    public function let(
        HttpClient $httpClient,
        HydratorInterface $hydrator,
        RequestBuilder $requestBuilder
    ) {
      $this->beConstructedWith($httpClient, $hydrator, $requestBuilder);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Service::class);
        $this->shouldHaveType(WatsonService::class);
    }

    public function it_should_use_tone_api()
    {
        $this->tone()->shouldReturnAnInstanceOf(Tone::class);
    }

    public function it_should_set_default_hostname()
    {

    }
}
