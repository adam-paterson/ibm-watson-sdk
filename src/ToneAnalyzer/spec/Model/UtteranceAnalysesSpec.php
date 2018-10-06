<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UtteranceAnalysesSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([], 'warning!');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UtteranceAnalyses::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_exposes_utterances_analysis()
    {
        $this->getUtteranceTones()->shouldBeArray();
    }

    function it_exposes_warnings()
    {
        $this->getWarning()->shouldBeString();
    }
}
