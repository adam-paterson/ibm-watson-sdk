<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * Class.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class UtteranceAnalysis implements CreatableFromArrayInterface
{
    const KEY_ID = 'id';

    const KEY_TEXT = 'text';

    const KEY_TONES = 'tones';

    const KEY_ERROR = 'error';

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
     * @var string
     */
    private $error;

    /**
     * @param int         $id
     * @param string      $text
     * @param array       $tones
     * @param string|null $error
     */
    public function __construct(int $id, string $text, array $tones, string $error = null)
    {
        $this->id    = $id;
        $this->text  = $text;
        $this->tones = $tones;
        $this->error = $error;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\UtteranceAnalysis
     */
    public static function create(array $data): self
    {
        $tones = [];

        foreach ($data[static::KEY_TONES] as $tone) {
            $tones[] = ToneScore::create($tone);
        }

        return new self(
            $data[static::KEY_ID],
            $data[static::KEY_TEXT],
            $tones,
            $data[static::KEY_ERROR] ?? null
        );
    }

    /**
     * Gets the utteranceId.
     *
     * The unique identifier of the utterance. The first utterance has ID 0, and the ID of each subsequent utterance is
     * incremented by one.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the utteranceText.
     *
     * The text of the utterance.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Gets the tones.
     *
     * An array of `ToneChatScore` objects that provides results for the most prevalent tones of the utterance.
     *
     * The array includes results for any tone whose score is at least 0.5. The array is empty if no tone has a score
     * that meets this threshold.
     *
     * @return array
     */
    public function getTones(): array
    {
        return $this->tones;
    }

    /**
     * Gets the error.
     *
     * 2017-09-21: An error message if the utterance contains more than 500 characters. The service does not analyze
     * the utterance.
     *
     * 2016-05-19: Not returned.
     *
     * @return string
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}
