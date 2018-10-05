<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Api;

use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\ToneAnalyzer\Model\ToneAnalysis;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;

/**
 * API class to consume the general tone API endpoint.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class Tone extends AbstractApi
{
    const API_URI_TONE           = 'v3/tone';
    const PARAM_CONTENT_TYPE     = 'content_type';
    const PARAM_CONTENT_LANGUAGE = 'content_language';
    const PARAM_ACCEPT_LANGUAGE  = 'accept_language';
    const PARAM_SENTENCES        = 'sentences';
    const PARAM_TEXT             = 'text';

    /**
     * @param string $text
     * @param bool   $sentences
     * @param array  $parameters
     *
     * @return DocumentAnalysis|array
     * @throws \Http\Client\Exception
     */
    public function analyze(string $text, bool $sentences = true, array $parameters = [])
    {
        $parameters = $this->validateParameters($parameters);

        $queryParams = [
            self::PARAM_SENTENCES   => $sentences,
        ];

        $uri = $this->uriFactory->createUri(static::API_URI_TONE .'?' . http_build_query($queryParams));

        $headers                             = [];
        if (isset($parameters[static::PARAM_CONTENT_TYPE])) {
            $headers['Content-Type'] = $parameters[static::PARAM_CONTENT_TYPE];
        }

        if (isset($parameters[static::PARAM_CONTENT_LANGUAGE])) {
            $headers['Content-Language'] = $parameters[static::PARAM_CONTENT_LANGUAGE];
        }

        if (isset($parameters[static::PARAM_ACCEPT_LANGUAGE])) {
            $headers['Accept-Language'] = $parameters[static::PARAM_ACCEPT_LANGUAGE];
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
