<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

class DocumentAnalysis implements CreatableFromArrayInterface
{
    const KEY_TONES   = 'tones';
    const KEY_WARNING = 'warning';

    private $tones;
    private $warning;

    /**
     * @param array  $tones
     * @param string $warning
     */
    public function __construct(array $tones, string $warning = null)
    {
        $this->tones   = $tones;
        $this->warning = $warning;
    }

    public static function create(array $data)
    {
        $tones = [];
        foreach ($data[static::KEY_TONES] as $tone) {
            $tones[] = ToneScore::create($tone);
        }

        return new self(
            $tones,
            $data[static::KEY_WARNING] ?? null
        );
    }

    public function getTones()
    {
        return $this->tones;
    }

    public function getWarning()
    {
        return $this->warning;
    }
}
