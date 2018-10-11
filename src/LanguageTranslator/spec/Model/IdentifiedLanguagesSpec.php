<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\LanguageTranslator\Model\IdentifiedLanguage;
use IBM\Watson\LanguageTranslator\Model\IdentifiedLanguages;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IdentifiedLanguagesSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IdentifiedLanguages::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_exposes_identified_languages()
    {
        $this->getLanguages()->shouldBeArray();
    }

    function it_creates_from_array()
    {
        $data = [
            IdentifiedLanguages::KEY_LANGUAGES => [
                [
                    IdentifiedLanguage::KEY_LANGUAGE => 'en-US',
                    IdentifiedLanguage::KEY_CONFIDENCE => 0.9143
                ]
            ]
        ];

        $this::create($data)->shouldBeAnInstanceOf($this);
    }
}
