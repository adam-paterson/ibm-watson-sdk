<?php

namespace spec\IBM\Watson\LanguageTranslator\Api;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;
use Http\Message\UriFactory;
use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\LanguageTranslator\Api\Identification;
use IBM\Watson\LanguageTranslator\Model\IdentifiableLanguages;
use IBM\Watson\LanguageTranslator\Model\IdentifiedLanguages;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;

class IdentificationSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpClient, HydratorInterface $hydrator, UriFactory $uriFactory)
    {
        $this->beConstructedWith($httpClient, $hydrator, $uriFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Identification::class);
        $this->shouldBeAnInstanceOf(AbstractApi::class);
    }

    function it_lists_available_languages(
        HttpMethodsClient $httpClient,
        HydratorInterface $hydrator,
        ResponseInterface $response
    ) {
        $identifiableLanguages = new IdentifiableLanguages([]);
        $httpClient
            ->get('v3/identifiable_languages')
            ->willReturn($response);

        $hydrator
            ->hydrate($response)
            ->willReturn($identifiableLanguages);

        $this->list()->shouldReturnAnInstanceOf(IdentifiableLanguages::class);
    }

    function it_identifies_language_of_provided_text(
        HttpMethodsClient $httpClient,
        HydratorInterface $hydrator,
        ResponseInterface $response
    ) {
        $identifiedLanguages = new IdentifiedLanguages([]);
        $httpClient
            ->post('v3/identify', [], 'some text')
            ->willReturn($response);

        $hydrator
            ->hydrate($response)
            ->willReturn($identifiedLanguages);

        $this->identify('some text')->shouldBeAnInstanceOf(IdentifiedLanguages::class);
    }
}
