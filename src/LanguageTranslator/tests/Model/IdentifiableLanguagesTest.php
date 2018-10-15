<?php

namespace IBM\Watson\LanguageTranslator\tests\Api;

use IBM\Watson\LanguageTranslator\Model\IdentifiableLanguage;
use IBM\Watson\LanguageTranslator\Model\IdentifiableLanguages;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class IdentifiableLanguagesTest extends TestCase
{
    public function testGetLanguages()
    {
        $languages = new IdentifiableLanguages([]);
        $this->assertInternalType(IsType::TYPE_ARRAY, $languages->getLanguages());
    }

    public function testCreate()
    {
        $this->assertInstanceOf(IdentifiableLanguages::class, IdentifiableLanguages::create([
            IdentifiableLanguages::KEY_LANGUAGES => [
                [
                    IdentifiableLanguage::KEY_CODE => 'fr',
                    IdentifiableLanguage::KEY_NAME => 'French'
                ]
            ]
        ]));
    }
}
