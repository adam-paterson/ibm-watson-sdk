<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Api;

use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\ToneAnalyzer\Model\DocumentAnalysis;

/**
 * Tone is used to interact with the "General tone" API endpoint.
 */
class Tone extends AbstractApi
{
    const API_ENDPOINT = '/tone';
    const PARAM_TEXT = 'text';

    /**
     * @param string $text   Text to analyze.
     * @param array  $params Query parameters.
     *
     * @return mixed
     * @throws \Http\Client\Exception
     */
    public function analyze(string $text, array $params = [])
    {
        $params[self::PARAM_TEXT] = $text;

        $response = $this->post(self::API_ENDPOINT, $params);

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, DocumentAnalysis::class);
    }
}
