<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Constraint\IsType;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;

class UtteranceAnalysesTest extends TestCase
{
    public function testCreate()
    {
        $analysis = UtteranceAnalyses::create([
            UtteranceAnalyses::KEY_UTTERANCES_TONES => [],
            UtteranceAnalyses::KEY_WARNING          => 'warning'
        ]);

        $this->assertInstanceOf(UtteranceAnalyses::class, $analysis);
    }

    public function testGetWarning()
    {
        $analysis = new UtteranceAnalyses([], 'warning');
        $this->assertSame('warning', $analysis->getWarning());
    }

    public function testGetUtteranceTones()
    {
        $analysis = new UtteranceAnalyses([], 'warning');
        $this->assertInternalType(IsType::TYPE_ARRAY, $analysis->getUtteranceTones());
    }
}
