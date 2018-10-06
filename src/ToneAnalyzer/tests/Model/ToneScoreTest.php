<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use PHPUnit\Framework\TestCase;
use IBM\Watson\ToneAnalyzer\Model\ToneScore;

class ToneScoreTest extends TestCase
{
    public function testGetName()
    {
        $score = new ToneScore('sad', 'Sad', 0.456);

        $this->assertSame('Sad', $score->getName());
    }

    public function testGetId()
    {
        $score = new ToneScore('sad', 'Sad', 0.456);

        $this->assertSame('sad', $score->getId());
    }

    public function testGetScore()
    {
        $score = new ToneScore('sad', 'Sad', 0.456);

        $this->assertSame(0.456, $score->getScore());
    }
}
