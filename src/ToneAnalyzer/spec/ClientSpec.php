<?php

namespace spec\IBM\Watson\ToneAnalyzer;

use Http\Client\Common\HttpMethodsClient;
use IBM\Watson\Core\ClientInterface;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Client;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $client, HydratorInterface $hydrator)
    {
        $this->beConstructedWith($client, $hydrator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function it_uses_tone_api()
    {
        $this->tone()->shouldReturnAnInstanceOf(Tone::class);
    }
}
