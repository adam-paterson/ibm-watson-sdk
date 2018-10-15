<?php

namespace spec\IBM\Watson\LanguageTranslator\Api;

use Http\Client\Common\HttpMethodsClient;
use Http\Message\UriFactory;
use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\LanguageTranslator\Api\Models;
use IBM\Watson\LanguageTranslator\Model\TranslationModels;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;

class ModelsSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpClient, HydratorInterface $hydrator, UriFactory $uriFactory)
    {
        $this->beConstructedWith($httpClient, $hydrator, $uriFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Models::class);
        $this->shouldHaveType(AbstractApi::class);
    }

    function it_lists_available_translation_models(HttpMethodsClient $httpClient, ResponseInterface $response, HydratorInterface $hydrator)
    {
        $httpClient
            ->get('v3/models')
            ->willReturn($response);

        $hydrator
            ->hydrate($response, TranslationModels::class)
            ->willReturn(new TranslationModels(['models' => []]));

        $this->list()->shouldReturnAnInstanceOf(TranslationModels::class);
    }
}
