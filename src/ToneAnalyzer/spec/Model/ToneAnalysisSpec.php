<?php

namespace spec\IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ToneAnalysisSpec extends ObjectBehavior
{
    function let(DocumentAnalysis $documentAnalysis)
    {
        $this->beConstructedWith($documentAnalysis, []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ToneAnalysis::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_creates_self_from_array()
    {
        $response = [
            ToneAnalysis::KEY_DOCUMENT_ANALYSIS => [
                DocumentAnalysis::KEY_TONES => []
            ],
            ToneAnalysis::KEY_SENTENCE_ANALYSIS => [
                [
                    SentenceAnalysis::KEY_ID => 0,
                    SentenceAnalysis::KEY_TEXT => 'Sentence',
                    SentenceAnalysis::KEY_TONES => []
                ]
            ]
        ];

        $this->create($response)->shouldReturnAnInstanceOf($this);
    }

    function it_exposes_document_level_analysis()
    {
        $this->getDocumentAnalysis()->shouldReturnAnInstanceOf(DocumentAnalysis::class);
    }

    function it_exposes_sentence_level_analysis()
    {
        $this->getSentenceAnalysis()->shouldBeArray();
    }
}
