<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use IBM\Watson\ToneAnalyzer\Model\ToneScore;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DocumentAnalysisSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([], 'warning');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DocumentAnalysis::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_creates_self_from_array()
    {
        $response = [
            DocumentAnalysis::KEY_TONES => [
                [
                    ToneScore::KEY_ID => 'sad',
                    ToneScore::KEY_NAME => 'Sad',
                    ToneScore::KEY_SCORE => 0.456
                ]
            ],
            DocumentAnalysis::KEY_WARNING => 'warning'
        ];

        $this->create($response)->shouldReturnAnInstanceOf($this);
    }

    function it_exposes_tones_list()
    {
        $this->getTones()->shouldBeArray();
    }

    function it_exposes_warning_from_api()
    {
        $this->getWarning()->shouldBeString();
    }
}
