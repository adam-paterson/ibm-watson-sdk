<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Api;

use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;

/**
 * API class to consume the general tone API endpoint.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class Tone extends AbstractApi
{
    const API_URI_TONE = 'v3/tone';

    const PARAM_SENTENCES = 'sentences';

    const PARAM_TEXT = 'text';

    /**
     * Analyze general tone.
     *
     * Use the general purpose endpoint to analyze the tone of your input content. The service analyzes the content for
     * emotional and language tones. The method always analyzes the tone of the full document; by default, it also
     * analyzes the tone of each individual sentence of the content.
     *
     * You can submit no more than 128 KB of total input content and no more than 1000 individual sentences in JSON,
     * plain text, or HTML format. The service analyzes the first 1000 sentences for document-level analysis and only
     * the first 100 sentences for sentence-level analysis.
     *
     * Per the JSON specification, the default character encoding for JSON content is effectively always UTF-8; per the
     * HTTP specification, the default encoding for plain text and HTML is ISO-8859-1 (effectively, the ASCII character
     * set). When specifying a content type of plain text or HTML, include the `charset` parameter to indicate the
     * character encoding of the input text; for example: `Content-Type: text/plain;charset=utf-8`. For `text/html`, the
     * service removes HTML tags and analyzes only the textual content.
     *
     * @param string $text
     * @param bool   $sentences
     * @param array  $parameters
     *
     * @return DocumentAnalysis|array
     *
     * @throws \Http\Client\Exception
     */
    public function analyze(string $text, bool $sentences = true, array $parameters = [])
    {
        $parameters = $this->validateParameters($parameters);

        $queryParams = [
            self::PARAM_SENTENCES => $sentences,
        ];

        $uri = $this->uriFactory->createUri(static::API_URI_TONE.'?'.http_build_query($queryParams));

        $headers = $this->getHeaders($parameters);

        if (isset($parameters[static::PARAM_CONTENT_TYPE])) {
            $headers['Content-Type'] = $parameters[static::PARAM_CONTENT_TYPE];
        }

        return $this->hydrator->hydrate(
            $this->httpClient->post($uri, $headers, json_encode([static::PARAM_TEXT => $text])),
            ToneAnalysis::class
        );
    }

    /**
     * @return array
     */
    public function getAllowedParameters(): array
    {
        return [
            static::PARAM_CONTENT_TYPE,
            static::PARAM_CONTENT_LANGUAGE,
            static::PARAM_ACCEPT_LANGUAGE,
        ];
    }
}
