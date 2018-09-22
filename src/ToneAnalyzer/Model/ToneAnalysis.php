<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Common\Model\CreatableFromArray;

/**
 * ToneAnalysis object containing document level analysis and sentence level analysis.
 */
class ToneAnalysis implements CreatableFromArray
{
    const KEY_DOCUMENT_TONE = 'document_tone';
    const KEY_SENTENCE_TONE = 'sentences_tone';

    /**
     * @var \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    private $documentAnalysis;

    /**
     * @var array
     */
    private $sentenceAnalysis;

    /**
     * @param \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis $documentAnalysis
     * @param array                                           $sentenceAnalysis
     */
    public function __construct(DocumentAnalysis $documentAnalysis, array $sentenceAnalysis)
    {
        $this->documentAnalysis = $documentAnalysis;
        $this->sentenceAnalysis = $sentenceAnalysis;
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
        $sentenceTones = [];

        if (isset($data[static::KEY_SENTENCE_TONE])) {
            foreach ($data[static::KEY_SENTENCE_TONE] as $sentence) {
                $sentenceTones[] = $sentence;
            }
        }

        return new self(
            DocumentAnalysis::create($data[static::KEY_DOCUMENT_TONE]),
            $sentenceTones
        );
    }

    /**
     * @return \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    public function getDocumentAnalysis(): DocumentAnalysis
    {
        return $this->documentAnalysis;
    }

    /**
     * @return array
     */
    public function getSentenceAnalysis(): array
    {
        return $this->sentenceAnalysis;
    }
}
