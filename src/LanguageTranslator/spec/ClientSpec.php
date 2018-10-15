<?php

namespace spec\IBM\Watson\LanguageTranslator;

use Http\Client\Common\HttpMethodsClient;
use Http\Message\Authentication;
use IBM\Watson\Core\ClientInterface;
use IBM\Watson\LanguageTranslator\Api\Identification;
use IBM\Watson\LanguageTranslator\Api\Translation;
use IBM\Watson\LanguageTranslator\Client;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpClient)
    {
        $this->beConstructedWith($httpClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
        $this->shouldImplement(ClientInterface::class);
    }

    function it_creates_self(Authentication $authentication)
    {
        $this::create($authentication)->shouldBeAnInstanceOf($this);
    }

    function it_uses_identification_api()
    {
        $this->identification()->shouldBeAnInstanceOf(Identification::class);
    }

    function it_uses_translation_api()
    {
        $this->translation()->shouldReturnAnInstanceOf(Translation::class);
    }
}
