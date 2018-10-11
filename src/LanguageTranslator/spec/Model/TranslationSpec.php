<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\LanguageTranslator\Model\Translation;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Translation::class);
    }
}
