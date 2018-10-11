<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Api;

use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\ToneAnalyzer\Model\UtteranceAnalyses;

/**
 * API class to consume the tone chat API endpoint.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class ToneChat extends AbstractApi
{
    const API_URI_TONE_CHAT = 'v3/tone_chat';
    const PARAM_UTTERANCES  = 'utterances';

    /**
     * @return array
     */
    public function getAllowedParameters(): array
    {
        return [
            static::PARAM_ACCEPT_LANGUAGE,
            static::PARAM_CONTENT_LANGUAGE
        ];
    }

    /**
     * Analyze customer engagement tone.
     *
     * Use the customer engagement endpoint to analyze the tone of customer service and customer support conversations.
     * For each utterance of a conversation, the method reports the most prevalent subset of the following seven tones:
     * sad, frustrated, satisfied, excited, polite, impolite, and sympathetic.
     *
     * If you submit more than 50 utterances, the service returns a warning for the overall content and analyzes only
     * the first 50 utterances. If you submit a single utterance that contains more than 500 characters, the service
     * returns an error for that utterance and does not analyze the utterance. The request fails if all utterances
     * have more than 500 characters.
     *
     * Per the JSON specification, the default character encoding for JSON content is effectively always UTF-8.
 *

     * @param array $utterances
     * @param array $parameters
     *
     * @return mixed
     * @throws \Http\Client\Exception
     */
    public function analyze(array $utterances, array $parameters = [])
    {
        $response = $this->httpClient->post(
            static::API_URI_TONE_CHAT,
            $this->getHeaders($parameters),
            json_encode([static::PARAM_UTTERANCES => $utterances])
        );

        return $this->hydrator->hydrate($response, UtteranceAnalyses::class);
    }
}
