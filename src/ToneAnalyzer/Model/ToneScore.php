<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

class ToneScore implements CreatableFromArrayInterface
{
    const KEY_ID    = 'tone_id';
    const KEY_NAME  = 'tone_name';
    const KEY_SCORE = 'score';

    private $id;
    private $name;
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

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getScore()
    {
        return $this->score;
    }

    public static function create(array $data)
    {
        return new self(
            $data[static::KEY_ID],
            $data[static::KEY_NAME],
            $data[static::KEY_SCORE]
        );
    }
}
