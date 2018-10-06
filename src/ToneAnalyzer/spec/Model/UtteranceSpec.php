<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\ToneAnalyzer\Model\Utterance;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UtteranceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('some text', 'agent');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Utterance::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_exposes_text()
    {
        $this->getText()->shouldBeString();
    }

    function it_exposes_user()
    {
        $this->getUser()->shouldBeString();
    }
}
