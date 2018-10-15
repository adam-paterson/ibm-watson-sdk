<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * ToneScore.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class ToneScore implements CreatableFromArrayInterface
{
    const KEY_ID = 'tone_id';

    const KEY_NAME = 'tone_name';

    const KEY_SCORE = 'score';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $score;

    /**
     * ToneScore constructor.
     *
     * @param $id
     * @param $name
     * @param $score
     */
    public function __construct(string $id, string $name, float $score)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->score = $score;
    }

    /**
     * Gets the toneId.
     *
     * The unique, non-localized identifier of the tone.
     * 2017-09-21: The service can return results for the following tone IDs: `anger`, `fear`, `joy`, and
     * `sadness` (emotional tones); `analytical`, `confident`, and `tentative` (language tones). The service returns
     * results only for tones whose scores meet a minimum threshold of 0.5.
     *
     * 2016-05-19: The service can return results for the following tone IDs of the different categories: for the
     * `emotion` category: `anger`, `disgust`, `fear`, `joy`, and `sadness`; for the `language` category: `analytical`,
     * `confident`, and `tentative`; for the `social` category: `openness_big5`, `conscientiousness_big5`,
     * `extraversion_big5`, `agreeableness_big5`, and `emotional_range_big5`. The service returns scores for all tones
     * of a category, regardless of their values.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Gets the toneName.
     *
     * The user-visible, localized name of the tone.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the score.
     *
     * 2017-09-21: The score that is returned lies in the range of 0.5 to 1. A score greater than 0.75 indicates a
     * high likelihood that the tone is perceived in the content.
     *
     * 2016-05-19: The score that is returned lies in the range of 0 to 1. A score less than 0.5 indicates that
     * the tone is unlikely to be perceived in the content; a score greater than 0.75 indicates a high likelihood that
     * the tone is perceived.
     *
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\ToneScore
     */
    public static function create(array $data): self
    {
        return new self(
            $data[static::KEY_ID],
            $data[static::KEY_NAME],
            $data[static::KEY_SCORE]
        );
    }
}
