<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class SentenceAnalysisTest extends TestCase
{
    public function testCreate()
    {
        $analysis = SentenceAnalysis::create([
            SentenceAnalysis::KEY_ID    => 0,
            SentenceAnalysis::KEY_TEXT  => 'some text',
            SentenceAnalysis::KEY_TONES => [],
        ]);

        $this->assertInstanceOf(SentenceAnalysis::class, $analysis);
    }

    public function testGetText()
    {
        $analysis = new SentenceAnalysis(0, 'some text', []);

        $this->assertSame('some text', $analysis->getText());
    }

    public function testGetId()
    {
        $analysis = new SentenceAnalysis(0, 'some text', []);

        $this->assertSame(0, $analysis->getId());
    }

    public function testGetTones()
    {
        $analysis = new SentenceAnalysis(0, 'some text', []);

        $this->assertInternalType(IsType::TYPE_ARRAY, $analysis->getTones());
    }
}
