<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use IBM\Watson\ToneAnalyzer\Model\ToneScore;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class DocumentAnalysisTest extends TestCase
{
    public function testGetWarning()
    {
        $analysis = new DocumentAnalysis($this->getTones(), 'warning!');
        $this->assertSame('warning!', $analysis->getWarning());
    }

    public function testCreate()
    {
        $analysis = DocumentAnalysis::create($this->getMockData());

        $this->assertInstanceOf(DocumentAnalysis::class, $analysis);
    }

    public function testGetTones()
    {
        $analysis = new DocumentAnalysis($this->getTones(), 'warning!');

        $this->assertInternalType(IsType::TYPE_ARRAY, $analysis->getTones());
    }

    private function getMockData()
    {
        return [
            DocumentAnalysis::KEY_TONES   => $this->getTones(),
            DocumentAnalysis::KEY_WARNING => 'Warning!',
        ];
    }

    private function getTones()
    {
        return [
            [
                ToneScore::KEY_ID    => 'sad',
                ToneScore::KEY_NAME  => 'Sad',
                ToneScore::KEY_SCORE => 0.456,
            ],
            [
                ToneScore::KEY_ID    => 'angry',
                ToneScore::KEY_NAME  => 'Angry',
                ToneScore::KEY_SCORE => 0.321,
            ],
        ];
    }
}
