<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\LanguageTranslator\Model\DeleteModelResult;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleteModelResultSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteModelResult::class);
    }
}
