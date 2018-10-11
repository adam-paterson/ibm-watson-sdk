<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * IdentifiableLanguages.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
final class IdentifiableLanguages implements CreatableFromArrayInterface
{
    const KEY_LANGUAGES = 'languages';

    /**
     * @var array
     */
    private $languages;

    /**
     * IdentifiableLanguages constructor.
     *
     * @param $languages
     */
    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\LanguageTranslator\Model\IdentifiableLanguages
     */
    public static function create(array $data): self
    {
        $languages = [];

        foreach ($data[static::KEY_LANGUAGES] as $language) {
            $languages[] = IdentifiableLanguage::create($language);
        }

        return new self($languages);
    }

    /**
     * A list of all languages that the service can identify.
     *
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }
}
