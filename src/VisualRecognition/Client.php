<?php

namespace IBM\Watson\VisualRecognition;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use IBM\Watson\Common\HttpClient\Builder;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\RequestBuilder;

final class Client
{
    /**
     * @var string
     */
    const BASE_URI = 'https://gateway-a.watsonplatform.net/visual-recognition/api';

    /**
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * @var \IBM\Watson\Common\Hydrator\ModelHydrator
     */
    private $hydrator;

    /**
     * @var \IBM\Watson\Common\RequestBuilder
     */
    private $requestBuilder;

    /**
     * Client constructor.
     *
     * @param $httpClient
     * @param $hydrator
     * @param $requestBuilder
     *
     * @throws \Http\Discovery\Exception\NotFoundException
     */
    public function __construct(
        HttpClient $httpClient = null,
        HydratorInterface $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->hydrator = $hydrator ?: new ModelHydrator;
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder;
    }

    /**
     * Create VisualRecognition client
     *
     * @param string $apiKey
     *
     * @return \IBM\Watson\VisualRecognition\Client
     *
     * @throws \Http\Discovery\Exception\NotFoundException
     */
    public static function create($apiKey)
    {
        $httpClient = (new Builder())
            ->withEndpoint(static::BASE_URI)
            ->withApiKey($apiKey)
            ->withVersion(\date('Y-m-d'))
            ->createConfiguredClient();

        return new self($httpClient);
    }

    /**
     * Classify image
     *
     * @return \IBM\Watson\VisualRecognition\Api\Classify
     */
    public function classify()
    {
        return new Api\Classify($this->httpClient, $this->hydrator, $this->requestBuilder);
    }
}
