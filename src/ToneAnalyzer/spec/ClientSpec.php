<?php

namespace spec\IBM\Watson\ToneAnalyzer;

use Http\Client\Common\HttpMethodsClient;
use Http\Message\UriFactory;
use IBM\Watson\Core\ClientInterface;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Api\ToneChat;
use IBM\Watson\ToneAnalyzer\Client;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $client, HydratorInterface $hydrator, UriFactory $uriFactory)
    {
        $this->beConstructedWith($client, $hydrator, $uriFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function it_uses_tone_api()
    {
        $this->tone()->shouldReturnAnInstanceOf(Tone::class);
    }

    function it_uses_tone_chat_api()
    {
        $this->toneChat()->shouldReturnAnInstanceOf(ToneChat::class);
    }
}
