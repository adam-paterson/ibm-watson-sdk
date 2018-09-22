<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreatableFromArray;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use Mockery as m;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ToneAnalysisSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(
            m::mock(DocumentAnalysis::class),
            ['sentences_tone' => []]
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ToneAnalysis::class);
        $this->shouldHaveType(CreatableFromArray::class);
    }

    public function it_should_get_document_analysis()
    {
        $this->getDocumentAnalysis()->shouldReturnAnInstanceOf(DocumentAnalysis::class);
    }

    public function it_should_get_sentence_analysis()
    {
        $this->getSentenceAnalysis()->shouldBeArray();
    }
}
