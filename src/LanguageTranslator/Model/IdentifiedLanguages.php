<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * IdentifiedLanguages.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
final class IdentifiedLanguages implements CreatableFromArrayInterface
{
    const KEY_LANGUAGES = 'languages';

    /**
     * @var array
     */
    private $languages;

    /**
     * IdentifiedLanguages constructor.
     *
     * @param array $languages
     */
    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * A ranking of identified languages with confidence scores.
     *
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\LanguageTranslator\Model\IdentifiedLanguages
     */
    public static function create(array $data): IdentifiedLanguages
    {
        $languages = [];

        foreach ($data[static::KEY_LANGUAGES] as $language) {
            $languages[] = IdentifiedLanguage::create($language);
        }

        return new self($languages);
    }
}
