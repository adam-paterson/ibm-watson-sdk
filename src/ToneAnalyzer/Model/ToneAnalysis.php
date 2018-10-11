<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * ToneAnalysis.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class ToneAnalysis implements CreatableFromArrayInterface
{
    const KEY_DOCUMENT_ANALYSIS = 'document_tone';
    const KEY_SENTENCE_ANALYSIS = 'sentences_tone';

    /**
     * @var \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    private $documentAnalysis;

    /**
     * @var array
     */
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

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\ToneAnalysis
     */
    public static function create(array $data): self
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

    /**
     * Gets the documentTone.
     *
     * An object of type DocumentAnalysis that provides the results of the analysis for the full input document.
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis
     */
    public function getDocumentAnalysis(): DocumentAnalysis
    {
        return $this->documentAnalysis;
    }

    /**
     * Gets the sentencesTone.
     *
     * An array of SentenceAnalysis objects that provides the results of the analysis for the individual sentences of
     * the input content. The service returns results only for the first 100 sentences of the input.
     * The field is omitted if the sentences parameter of the request is set to false.
     *
     * @return array
     */
    public function getSentenceAnalysis(): array
    {
        return $this->sentenceAnalysis;
    }
}
