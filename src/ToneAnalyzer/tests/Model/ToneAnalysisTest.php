<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use Mockery as m;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class ToneAnalysisTest extends TestCase
{
    private $documentAnalysis;

    public function setUp()
    {
        $this->documentAnalysis = m::mock(DocumentAnalysis::class);
    }

    public function testCreate()
    {
        $data = [
            ToneAnalysis::KEY_DOCUMENT_ANALYSIS => [
                DocumentAnalysis::KEY_TONES => [],
            ],
            ToneAnalysis::KEY_SENTENCE_ANALYSIS => [
                [
                    SentenceAnalysis::KEY_ID    => 0,
                    SentenceAnalysis::KEY_TEXT  => 'text',
                    SentenceAnalysis::KEY_TONES => [],
                ],
            ],
        ];

        $analysis = ToneAnalysis::create($data);

        $this->assertInstanceOf(ToneAnalysis::class, $analysis);
    }

    public function testGetSentenceAnalysis()
    {
        $analysis = new ToneAnalysis($this->documentAnalysis, []);

        $this->assertInternalType(IsType::TYPE_ARRAY, $analysis->getSentenceAnalysis());
    }

    public function testGetDocumentAnalysis()
    {
        $analysis = new ToneAnalysis($this->documentAnalysis);

        $this->assertInstanceOf(DocumentAnalysis::class, $analysis->getDocumentAnalysis());
    }
}
