<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

class ToneAnalysis implements CreatableFromArrayInterface
{
    const KEY_DOCUMENT_ANALYSIS = 'document_tone';
    const KEY_SENTENCE_ANALYSIS = 'sentences_tone';

    private $documentAnalysis;
    private $sentenceAnalysis;

    /**
     * ToneAnalysis constructor.
     *
     * @param $documentAnalysis
     * @param $sentenceAnalysis
     */
    public function __construct(DocumentAnalysis $documentAnalysis, array $sentenceAnalysis = [])
    {
        $this->documentAnalysis = $documentAnalysis;
        $this->sentenceAnalysis = $sentenceAnalysis;
    }

    public static function create(array $data)
    {
        $sentences = [];
        if (isset($data[static::KEY_SENTENCE_ANALYSIS])) {
            foreach ($data[static::KEY_SENTENCE_ANALYSIS] as $sentence) {
                $sentences[] = SentenceAnalysis::create($sentence);
            }
        }

        return new self(
            DocumentAnalysis::create($data[static::KEY_DOCUMENT_ANALYSIS]),
            $sentences
        );
    }

    public function getDocumentAnalysis()
    {
        return $this->documentAnalysis;
    }

    public function getSentenceAnalysis()
    {
        return $this->sentenceAnalysis;
    }
}
