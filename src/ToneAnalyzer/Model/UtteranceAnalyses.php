<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * UtteranceAnalyses.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class UtteranceAnalyses implements CreatableFromArrayInterface
{
    const KEY_UTTERANCES_TONES = 'utterances_tone';
    const KEY_WARNING          = 'warning';

    /**
     * @var array
     */
    private $utteranceTones;

    /**
     * @var null
     */
    private $warning;

    /**
     * @param array $utteranceTones
     * @param null  $warning
     */
    public function __construct(array $utteranceTones, $warning = null)
    {
        $this->utteranceTones = $utteranceTones;
        $this->warning        = $warning;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses
     */
    public static function create(array $data): self
    {
        return new self($data[static::KEY_UTTERANCES_TONES], $data[static::KEY_WARNING] ?? null);
    }

    /**
     * Gets the utterancesTone.
     *
     * An array of `UtteranceAnalysis` objects that provides the results for each utterance of the input.
     *
     * @return array
     */
    public function getUtteranceTones(): array
    {
        return $this->utteranceTones;
    }

    /**
     * Gets the warning.
     *
     * 2017-09-21: A warning message if the content contains more than 50 utterances. The service analyzes only the
     * first 50 utterances.
     *
     * 2016-05-19: Not returned.
     *
     * @return null|string
     */
    public function getWarning(): ?string
    {
        return $this->warning;
    }
}
