<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreatableFromArray;

/**
 * DocumentAnalysis containing list of tones.
 */
class DocumentAnalysis implements CreatableFromArray
{
    const KEY_TONES = 'tones';
    const KEY_WARNING = 'warning';

    /**
     * @var array
     */
    private $tones;

    /**
     * @var string
     */
    private $warning;

    /**
     * @param array  $tones   Array of ToneScore objects.
     * @param string $warning Warning from response.
     */
    public function __construct(array $tones, string $warning = null)
    {
        $this->tones = $tones;
        $this->warning = $warning;
    }

    /**
     * Create DocumentAnalysis object from array.
     *
     * @param array $data
     *
     * @return \IBM\Watson\Common\Model\CreatableFromArray
     */
    public static function create(array $data): CreatableFromArray
    {
        $warning = null;

        if (isset($data[static::KEY_WARNING])) {
            $warning = $data[static::KEY_WARNING];
        }

        return new self($data[static::KEY_TONES], $warning);
    }

    /**
     * Get DocumentAnalysis tones.
     *
     * @return array
     */
    public function getTones(): array
    {
        return $this->tones;
    }

    /**
     * Get warning.
     *
     * @return string
     */
    public function getWarning(): string
    {
        return $this->warning;
    }
}
