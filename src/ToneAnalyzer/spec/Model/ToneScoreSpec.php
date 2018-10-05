<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\ToneAnalyzer\Model\ToneScore;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ToneScoreSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('sad', 'Sad', 0.456);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ToneScore::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_creates_self_from_array()
    {
        $response = [
            ToneScore::KEY_ID => 'sad',
            ToneScore::KEY_NAME => 'Sad',
            ToneScore::KEY_SCORE => 0.456
        ];

        $this->create($response)->shouldReturnAnInstanceOf($this);
    }

    function it_exposes_tone_id()
    {
        $this->getId()->shouldBeString();
        $this->getId()->shouldBeEqualTo('sad');
    }

    function it_exposes_tone_name()
    {
        $this->getName()->shouldBeString();
        $this->getName()->shouldBeEqualTo('Sad');
    }

    function it_exposes_tone_score()
    {
        $this->getScore()->shouldBeFloat();
        $this->getScore()->shouldBeEqualTo(0.456);
    }
}
