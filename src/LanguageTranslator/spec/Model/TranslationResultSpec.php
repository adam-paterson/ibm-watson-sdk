<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\Core\stubs\CreatableFromArrayModel;
use IBM\Watson\LanguageTranslator\Model\TranslationResult;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TranslationResultSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(12, 45, []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TranslationResult::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_exposes_word_count()
    {
        $this->getWordCount()->shouldBeInt();
    }

    function it_exposes_character_count()
    {
        $this->getCharacterCount()->shouldBeInt();
    }

    function it_exposes_translations()
    {
        $this->getTranslations()->shouldBeArray();
    }
}
