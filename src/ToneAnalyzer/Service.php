<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer;

use Http\Message\Authentication;
use IBM\Watson\Common\HttpClient\Builder;
use IBM\Watson\Common\WatsonService;
use IBM\Watson\Common\WatsonServiceInterface;
use IBM\Watson\ToneAnalyzer\Api\Tone;

/**
 * ToneAnalyzer service interfaces the ToneAnalyzer API.
 */
class Service extends WatsonService
{
    const API_HOSTNAME = 'https://gateway.watsonplatform.net/tone-analyzer/api';
    const API_PATH = 'tone-analyzer/api/v3';

    /**
     * Create configured service.
     *
     * @param \Http\Message\Authentication $authentication Authentication method.
     *
     * @return \IBM\Watson\Common\WatsonServiceInterface
     */
    public static function create(Authentication $authentication): WatsonServiceInterface
    {
        $httpClient = (new Builder())
            ->withHostname(static::API_HOSTNAME)
            ->withPath(static::API_PATH)
            ->withAuthentication($authentication)
            ->createConfiguredClient();

        return new self($httpClient);
    }

    /**
     * Use Tone endpoint.
     *
     * @return \IBM\Watson\ToneAnalyzer\Api\Tone
     */
    public function tone(): Tone
    {
        return new Api\Tone($this->httpClient, $this->hydrator, $this->requestBuilder);
    }
}
