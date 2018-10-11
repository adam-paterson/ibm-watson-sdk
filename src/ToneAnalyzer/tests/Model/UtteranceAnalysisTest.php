<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\ToneAnalyzer\Model\ToneScore;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalysis;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class UtteranceAnalysisTest extends TestCase
{
    public function testGetText()
    {
        $analysis = new UtteranceAnalysis(0, 'text', [], 'error');
        $this->assertSame('text', $analysis->getText());
    }

    public function testGetId()
    {
        $analysis = new UtteranceAnalysis(0, 'text', [], 'error');
        $this->assertSame(0, $analysis->getId());
    }

    public function testGetTones()
    {
        $analysis = new UtteranceAnalysis(0, 'text', [], 'error');
        $this->assertInternalType(IsType::TYPE_ARRAY, $analysis->getTones());
    }

    public function testGetError()
    {
        $analysis = new UtteranceAnalysis(0, 'text', [], 'error');
        $this->assertSame('error', $analysis->getError());
    }

    public function testCreate()
    {
        $data = [
            UtteranceAnalysis::KEY_ID    => 0,
            UtteranceAnalysis::KEY_TEXT  => 'text',
            UtteranceAnalysis::KEY_TONES => [
                [
                    ToneScore::KEY_ID    => 'sad',
                    ToneScore::KEY_NAME  => 'Sad',
                    ToneScore::KEY_SCORE => 0.456,
                ],
            ],
            UtteranceAnalysis::KEY_ERROR => 'error',
        ];

        $analysis = UtteranceAnalysis::create($data);
        $this->assertInstanceOf(UtteranceAnalysis::class, $analysis);
    }
}
