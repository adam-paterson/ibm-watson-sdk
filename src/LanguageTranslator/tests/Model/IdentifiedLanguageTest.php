<?php

namespace IBM\Watson\LanguageTranslator\tests\Api;

use IBM\Watson\LanguageTranslator\Model\IdentifiedLanguage;
use PHPUnit\Framework\TestCase;

class IdentifiedLanguageTest extends TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(IdentifiedLanguage::class, IdentifiedLanguage::create([
            IdentifiedLanguage::KEY_LANGUAGE   => 'fr',
            IdentifiedLanguage::KEY_CONFIDENCE => 0.345
        ]));
    }

    public function testGetConfidence()
    {
        $language = new IdentifiedLanguage('fr', 0.345);

        $this->assertSame(0.345, $language->getConfidence());
    }

    public function testGetLanguage()
    {
        $language = new IdentifiedLanguage('fr', 0.345);

        $this->assertSame('fr', $language->getLanguage());
    }
}
