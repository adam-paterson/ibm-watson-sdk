<?php

namespace spec\IBM\Watson\ToneAnalyzer\Api;

use PhpSpec\ObjectBehavior;
use Http\Message\UriFactory;
use Psr\Http\Message\UriInterface;
use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\Core\Api\ApiInterface;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use Psr\Http\Message\ResponseInterface;
use Http\Client\Common\HttpMethodsClient;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;

class ToneSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpClient, HydratorInterface $hydrator, UriFactory $uriFactory)
    {
        $this->beConstructedWith($httpClient, $hydrator, $uriFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Tone::class);
        $this->shouldImplement(ApiInterface::class);
        $this->shouldBeAnInstanceOf(AbstractApi::class);
    }

    function it_analyzes_tone(
        HttpMethodsClient $httpClient,
        HydratorInterface $hydrator,
        UriFactory $uriFactory,
        UriInterface $uri,
        ResponseInterface $response
    ) {
        $uriFactory
            ->createUri('v3/tone?sentences=0')
            ->willReturn($uri);

        $uri
            ->__toString()
            ->willReturn('v3/tone?sentences=0');

        $httpClient
            ->post($uri, ['Content-Language' => 'en', 'Accept-Language' => 'en'], '{"text":"some text"}')
            ->willReturn($response);

        $hydrator
            ->hydrate($response, ToneAnalysis::class)
            ->willReturn(['document_tone' => []]);

        $this->analyze('some text', false)->shouldBeArray();
    }

    function it_should_return_array_of_permitted_optional_parameters()
    {
        $this->getAllowedParameters()->shouldBeArray();
        $this->getAllowedParameters()->shouldBeEqualTo([
            Tone::PARAM_CONTENT_TYPE,
            Tone::PARAM_CONTENT_LANGUAGE,
            Tone::PARAM_ACCEPT_LANGUAGE,
        ]);
    }
}
