<?php

namespace IBM\Watson\ToneAnalyzer\Tests\Model;

use IBM\Watson\Common\Tests\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class DocumentAnalysisTest extends AbstractTestCase
{
    private $analysis;

    public function setUp()
    {
        $this->analysis = new DocumentAnalysis(
            ['tones' => []],
            'Warning!'
        );
    }

    public function testGetWarning()
    {
        $this->assertSame('Warning!', $this->analysis->getWarning());
    }

    public function testGetTones()
    {
        $this->assertInternalType(IsType::TYPE_ARRAY, $this->analysis->getTones());
    }

    public function testCreate()
    {
        $response = $this->getMockResponse('ToneResponse.json');
        $data = json_decode($response->getBody(), true);

        $documentAnalysis = $data['document_tone'];

        $analysis = DocumentAnalysis::create($documentAnalysis);

        $this->assertInstanceOf(DocumentAnalysis::class, $analysis);
    }
}
