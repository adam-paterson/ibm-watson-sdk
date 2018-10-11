<?php

namespace IBM\Watson\LanguageTranslator\tests\Api;

use IBM\Watson\LanguageTranslator\Model\IdentifiableLanguage;
use PHPUnit\Framework\TestCase;

class IdentifiableLanguageTest extends TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(IdentifiableLanguage::class, IdentifiableLanguage::create([
            IdentifiableLanguage::KEY_NAME => 'French',
            IdentifiableLanguage::KEY_CODE => 'fr'
        ]));
    }

    public function testGetCode()
    {
        $language = new IdentifiableLanguage('fr', 'French');

        $this->assertSame('fr', $language->getCode());
    }

    public function testGetName()
    {
        $language = new IdentifiableLanguage('fr', 'French');

        $this->assertSame('French', $language->getName());
    }
}
