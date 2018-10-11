<?php

namespace IBM\Watson\LanguageTranslator\tests\Api;

use IBM\Watson\LanguageTranslator\Model\TranslationResult;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class TranslationResultTest extends TestCase
{
    public function testGetCharacterCount()
    {
        $result = new TranslationResult(34, 35, ['sentence']);

        $this->assertSame(35, $result->getCharacterCount());
    }

    public function testCreate()
    {
        $this->assertInstanceOf(TranslationResult::class, TranslationResult::create([
            TranslationResult::KEY_WORD_COUNT      => 34,
            TranslationResult::KEY_CHARACTER_COUNT => 35,
            TranslationResult::KEY_TRANSLATIONS    => []
        ]));
    }

    public function testGetWordCount()
    {
        $result = new TranslationResult(34, 35, []);

        $this->assertSame(34, $result->getWordCount());
    }

    public function testGetTranslations()
    {
        $result = new TranslationResult(34, 35, []);

        $this->assertInternalType(IsType::TYPE_ARRAY, $result->getTranslations());
    }
}
