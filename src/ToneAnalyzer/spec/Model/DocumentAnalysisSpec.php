<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreatableFromArray;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use PhpSpec\ObjectBehavior;

class DocumentAnalysisSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith([], 'Warning');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DocumentAnalysis::class);
        $this->shouldHaveType(CreatableFromArray::class);
    }

    public function it_should_get_tone_scores()
    {
        $this->getTones()->shouldBeArray();
    }

    public function it_should_create_from_array()
    {
        $data = [
            'tones' => [],
            'warning' => 'Warning!'
        ];
        $this::create($data)->shouldReturnAnInstanceOf(DocumentAnalysis::class);
    }
}
