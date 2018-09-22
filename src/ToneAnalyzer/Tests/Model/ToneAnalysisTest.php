<?php

namespace IBM\Watson\ToneAnalyzer\Tests\Model;

use Mockery as m;
use IBM\Watson\Common\Tests\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use PHPUnit\Framework\Constraint\IsType;

class ToneAnalysisTest extends AbstractTestCase
{
    private $documentAnalysis;

    public function setUp()
    {
        $this->documentAnalysis = m::mock(DocumentAnalysis::class);
    }
    public function testGetDocumentAnalysis()
    {
        $analysis = new ToneAnalysis($this->documentAnalysis, ['sentences_tone']);

        $this->assertInstanceOf(DocumentAnalysis::class, $analysis->getDocumentAnalysis());
    }

    public function testGetSentenceAnalysis()
    {
        $analysis = new ToneAnalysis($this->documentAnalysis, ['sentences_tone']);

        $this->assertInternalType(IsType::TYPE_ARRAY, $analysis->getSentenceAnalysis());
    }

    public function testCreate()
    {
        $response = $this->getMockResponse('ToneResponse.json');
        $data = json_decode($response->getBody(), true);

        $analysis = ToneAnalysis::create($data);

        $this->assertInstanceOf(ToneAnalysis::class, $analysis);
    }
}
