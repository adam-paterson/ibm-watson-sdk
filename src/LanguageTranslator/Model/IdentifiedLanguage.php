<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Model;

/**
 * IdentifiedLanguage.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
final class IdentifiedLanguage
{
    const KEY_LANGUAGE   = 'language';
    const KEY_CONFIDENCE = 'confidence';

    /**
     * @var string
     */
    private $language;

    /**
     * @var float
     */
    private $confidence;

    /**
     * IdentifiedLanguage constructor.
     *
     * @param $language
     * @param $confidence
     */
    public function __construct(string $language, float $confidence)
    {
        $this->language   = $language;
        $this->confidence = $confidence;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\LanguageTranslator\Model\IdentifiedLanguage
     */
    public static function create(array $data): IdentifiedLanguage
    {
        return new self($data[static::KEY_LANGUAGE], $data[static::KEY_CONFIDENCE]);
    }

    /**
     * The language code for an identified language.
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * The confidence score for the identified language.
     *
     * @return float
     */
    public function getConfidence(): float
    {
        return $this->confidence;
    }
}
