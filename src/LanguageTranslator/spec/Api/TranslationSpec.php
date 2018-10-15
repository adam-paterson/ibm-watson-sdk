<?php

namespace spec\IBM\Watson\LanguageTranslator\Api;

use Http\Client\Common\HttpMethodsClient;
use Http\Message\UriFactory;
use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\LanguageTranslator\Api\Translation;
use IBM\Watson\LanguageTranslator\Model\TranslationResult;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;

class TranslationSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpClient, HydratorInterface $hydrator, UriFactory $uriFactory)
    {
        $this->beConstructedWith($httpClient, $hydrator, $uriFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Translation::class);
        $this->shouldHaveType(AbstractApi::class);
    }

    function it_translates_provided_text(
        HttpMethodsClient $httpClient,
        HydratorInterface $hydrator,
        ResponseInterface $response
    ) {
        $result = new TranslationResult(34, 45, []);
        $httpClient
            ->post('v3/translate', [], '{"text":"some text","model_id":"en-nl"}')
            ->willReturn($response);

        $hydrator
            ->hydrate($response, TranslationResult::class)
            ->willReturn($result);

        $this
            ->translate('some text', 'en-nl')
            ->shouldReturnAnInstanceOf(TranslationResult::class);
    }

    function it_throws_an_exception_when_model_or_source_and_target_are_omitted()
    {
        $this->shouldThrow(
            InvalidArgumentException::class
        )->during('translate', ['some text']);
    }
}
