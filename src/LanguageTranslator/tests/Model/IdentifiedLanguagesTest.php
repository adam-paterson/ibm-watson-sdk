<?php

namespace IBM\Watson\LanguageTranslator\tests\Api;

use IBM\Watson\LanguageTranslator\Model\IdentifiedLanguage;
use IBM\Watson\LanguageTranslator\Model\IdentifiedLanguages;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class IdentifiedLanguagesTest extends TestCase
{
    public function testGetLanguages()
    {
        $languages = new IdentifiedLanguages([]);

        $this->assertInternalType(IsType::TYPE_ARRAY, $languages->getLanguages());
    }

    public function testCreate()
    {
        $this->assertInstanceOf(IdentifiedLanguages::class, IdentifiedLanguages::create([
            IdentifiedLanguages::KEY_LANGUAGES => [
                [
                    IdentifiedLanguage::KEY_LANGUAGE   => 'fr',
                    IdentifiedLanguage::KEY_CONFIDENCE => 0.345
                ]
            ]
        ]));
    }
}
