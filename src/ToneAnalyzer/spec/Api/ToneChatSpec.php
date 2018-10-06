<?php

namespace spec\IBM\Watson\ToneAnalyzer\Api;

use PhpSpec\ObjectBehavior;
use Http\Message\UriFactory;
use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\Core\Api\ApiInterface;
use Psr\Http\Message\ResponseInterface;
use Http\Client\Common\HttpMethodsClient;
use IBM\Watson\ToneAnalyzer\Api\ToneChat;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;

class ToneChatSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpClient, HydratorInterface $hydrator, UriFactory $uriFactory)
    {
        $this->beConstructedWith($httpClient, $hydrator, $uriFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ToneChat::class);
        $this->shouldImplement(ApiInterface::class);
        $this->shouldBeAnInstanceOf(AbstractApi::class);
    }

    function it_should_analyze_tone_of_chat_manuscript(
        HttpMethodsClient $httpClient,
        HydratorInterface $hydrator,
        ResponseInterface $response,
        UtteranceAnalyses $utteranceAnalyses
    ) {
        $httpClient
            ->post(
                'v3/tone_chat',
                [
                    'Content-Language' => 'en',
                    'Accept-Language'  => 'en'
                ],
                '{"utterances":[{"text":"some text","user":"agent"},{"text":"more text","user":"customer"}]}'
            )
            ->willReturn($response);

        $hydrator
            ->hydrate($response, UtteranceAnalyses::class)
            ->willReturn($utteranceAnalyses);

        $chat = [
            [
                'text' => 'some text',
                'user' => 'agent'
            ],
            [
                'text' => 'more text',
                'user' => 'customer'
            ]
        ];

        $this->analyze($chat)->shouldReturnAnInstanceOf(UtteranceAnalyses::class);
    }
}
