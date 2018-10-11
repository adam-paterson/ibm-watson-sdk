<?php

namespace IBM\Watson\ToneAnalyzer\tests\Model;

use IBM\Watson\ToneAnalyzer\Model\Utterance;
use PHPUnit\Framework\TestCase;

class UtteranceTest extends TestCase
{
    public function testGetText()
    {
        $utterance = new Utterance('text', 'user');

        $this->assertSame('text', $utterance->getText());
    }

    public function testCreate()
    {
        $utterance = Utterance::create(['text' => 'text', 'user' => 'user']);

        $this->assertInstanceOf(Utterance::class, $utterance);
    }

    public function testGetUser()
    {
        $utterance = new Utterance('text', 'user');

        $this->assertSame('user', $utterance->getUser());
    }
}
