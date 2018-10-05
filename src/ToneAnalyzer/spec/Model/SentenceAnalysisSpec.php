<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis;
use IBM\Watson\ToneAnalyzer\Model\ToneScore;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SentenceAnalysisSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            0,
            'Just a sentence of text',
            []
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SentenceAnalysis::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_creates_self_from_array()
    {
        $response = [
            SentenceAnalysis::KEY_ID => 0,
            SentenceAnalysis::KEY_TEXT => 'Just a sentence of text',
            SentenceAnalysis::KEY_TONES => [
                [
                    ToneScore::KEY_ID => 'sad',
                    ToneScore::KEY_NAME => 'Sad',
                    ToneScore::KEY_SCORE => 0.456
                ]
            ]
        ];

        $this->create($response)->shouldReturnAnInstanceOf($this);
    }

    function it_exposes_sentence_id()
    {
        $this->getId()->shouldBeInt();
        $this->getId()->shouldBeEqualTo(0);
    }

    function it_exposes_text()
    {
        $this->getText()->shouldBeString();
        $this->getText()->shouldBeEqualTo('Just a sentence of text');
    }

    function it_exposes_tones()
    {
        $this->getTones()->shouldBeArray();
        $this->getTones()->shouldBeEqualTo([

        ]);
    }
}
