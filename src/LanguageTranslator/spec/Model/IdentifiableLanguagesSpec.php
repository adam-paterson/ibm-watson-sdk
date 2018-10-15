<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\LanguageTranslator\Model\IdentifiableLanguages;
use PhpSpec\ObjectBehavior;

class IdentifiableLanguagesSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['languages' => []]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IdentifiableLanguages::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_creates_self()
    {
        $data = [
            'languages' => [
                [
                    'language' => 'ar',
                    'name'     => 'Afrikaans'
                ]
            ]
        ];

        $this::create($data)->shouldBeAnInstanceOf(IdentifiableLanguages::class);
    }

    function it_exposes_language_list()
    {
        $this->getLanguages()->shouldBeArray();
    }
}
