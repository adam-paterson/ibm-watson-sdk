<?php

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

class SentenceAnalysis implements CreatableFromArrayInterface
{
    const KEY_ID    = 'sentence_id';
    const KEY_TEXT  = 'text';
    const KEY_TONES = 'tones';

    private $id;
    private $text;
    private $tones;

    public function __construct(int $id, string $text, array $tones)
    {
        $this->id    = $id;
        $this->text  = $text;
        $this->tones = $tones;
    }

    public static function create(array $data)
    {
        return new self(
            $data[static::KEY_ID],
            $data[static::KEY_TEXT],
            $data[static::KEY_TONES]
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getTones()
    {
        return $this->tones;
    }
}
