<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalysis;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UtteranceAnalysisSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(0, 'text', [], 'error');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UtteranceAnalysis::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_exposes_utterance_id()
    {
        $this->getId()->shouldBeInt();
    }

    function it_exposes_utterance_text()
    {
        $this->getText()->shouldBeString();
    }

    function it_exposes_tones()
    {
        $this->getTones()->shouldBeArray();
    }

    function it_exposes_error()
    {
        $this->getError()->shouldBeString();
    }
}
