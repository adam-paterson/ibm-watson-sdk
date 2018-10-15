<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\LanguageTranslator\Model\IdentifiedLanguage;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IdentifiedLanguageSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('en-US', 0.9143);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IdentifiedLanguage::class);
    }

    function it_creates_self_from_array()
    {
        $data = [
            IdentifiedLanguage::KEY_LANGUAGE => 'en-US',
            IdentifiedLanguage::KEY_CONFIDENCE => 0.9143
        ];

        $this::create($data)->shouldBeAnInstanceOf($this);
    }

    function it_exposes_language()
    {
        $this->getLanguage()->shouldBeString();
    }

    function it_exposes_confidence()
    {
        $this->getConfidence()->shouldBeFloat();
    }
}
