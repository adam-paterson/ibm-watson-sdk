<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

final class TranslationResult implements CreatableFromArrayInterface
{
    const KEY_WORD_COUNT      = 'word_count';
    const KEY_CHARACTER_COUNT = 'character_count';
    const KEY_TRANSLATIONS    = 'translations';

    private $wordCount;
    private $characterCount;
    private $translations;

    /**
     * TranslationResult constructor.
     *
     * @param $wordCount
     * @param $characterCount
     * @param $translations
     */
    public function __construct(int $wordCount, int $characterCount, array $translations)
    {
        $this->wordCount      = $wordCount;
        $this->characterCount = $characterCount;
        $this->translations   = $translations;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function create(array $data)
    {
        return new self(
            $data[static::KEY_WORD_COUNT],
            $data[static::KEY_CHARACTER_COUNT],
            $data[static::KEY_TRANSLATIONS]
        );
    }

    /**
     * @return int
     */
    public function getWordCount(): int
    {
        return $this->wordCount;
    }

    /**
     * @return int
     */
    public function getCharacterCount(): int
    {
        return $this->characterCount;
    }

    /**
     * @return array
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }
}
