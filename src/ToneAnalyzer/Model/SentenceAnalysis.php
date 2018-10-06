<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * SentenceAnalysis.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class SentenceAnalysis implements CreatableFromArrayInterface
{
    const KEY_ID    = 'sentence_id';
    const KEY_TEXT  = 'text';
    const KEY_TONES = 'tones';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var array
     */
    private $tones;

    /**
     * @param int    $id
     * @param string $text
     * @param array  $tones
     */
    public function __construct(int $id, string $text, array $tones)
    {
        $this->id    = $id;
        $this->text  = $text;
        $this->tones = $tones;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\SentenceAnalysis
     */
    public static function create(array $data): self
    {
        return new self(
            $data[static::KEY_ID],
            $data[static::KEY_TEXT],
            $data[static::KEY_TONES]
        );
    }

    /**
     * Gets the unique identifier of a sentence of the input content.
     * The first sentence has ID 0, and the ID of each subsequent sentence is incremented by one.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the text of the input sentence.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Get an array of ToneScore objects that provides the results of the analysis for each qualifying tone of
     * the sentence.
     *
     * The array includes results for any tone whose score is at least 0.5.
     * The array is empty if no tone has a score that meets this threshold.
     *
     * @return array
     */
    public function getTones(): array
    {
        return $this->tones;
    }
}
