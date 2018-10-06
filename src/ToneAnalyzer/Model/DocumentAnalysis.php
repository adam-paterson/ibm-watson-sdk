<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * DocumentAnalysis.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class DocumentAnalysis implements CreatableFromArrayInterface
{
    const KEY_TONES   = 'tones';
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
     * @param array  $tones
     * @param string $warning
     */
    public function __construct(array $tones, string $warning = null)
    {
        $this->tones   = $tones;
        $this->warning = $warning;
    }

    /**
     * Create self from data array.
     *
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    public static function create(array $data): self
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

    /**
     * Gets the tones.
     *
     * An array of ToneScore objects that provides the results of the analysis for each qualifying
     * tone of the document. The array includes results for any tone whose score is at least 0.5. The array is empty if no
     * tone has a score that meets this threshold.
     *
     * @return array
     */
    public function getTones(): array
    {
        return $this->tones;
    }

    /**
     * Gets the warning.
     *
     * A warning message if the overall content exceeds 128 KB or contains more than 1000 sentences. The
     * service analyzes only the first 1000 sentences for document-level analysis and the first 100 sentences for
     * sentence-level analysis.
     *
     * @return string
     */
    public function getWarning(): string
    {
        return $this->warning;
    }
}
