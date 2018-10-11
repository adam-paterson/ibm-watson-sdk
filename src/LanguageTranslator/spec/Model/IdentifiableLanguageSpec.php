<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\LanguageTranslator\Model\IdentifiableLanguage;
use PhpSpec\ObjectBehavior;

class IdentifiableLanguageSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('af', 'Afrikaans');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IdentifiableLanguage::class);
        $this->shouldBeAnInstanceOf(CreatableFromArrayInterface::class);
    }

    function it_creates_from_array()
    {
        $data = [
            IdentifiableLanguage::KEY_NAME => 'Afrikaans',
            IdentifiableLanguage::KEY_CODE => 'af'
        ];

        $this::create($data)->shouldBeAnInstanceOf(IdentifiableLanguage::class);
    }

    function it_exposes_language_code()
    {
        $this->getCode()->shouldBeString();
    }

    function it_exposes_name()
    {
        $this->getName()->shouldBeString();
    }
}
