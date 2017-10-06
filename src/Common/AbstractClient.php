<?php

namespace IBM\Watson\Common;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;

abstract class AbstractClient
{
    /**
     * @var \IBM\Watson\Common\Hydrator\ModelHydrator
     */
    protected $hydrator;

    /**
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * @var \IBM\Watson\Common\RequestBuilder
     */
    protected $requestBuilder;

    /**
     * Client constructor.
     *
     * @param \Http\Client\HttpClient|null                       $httpClient
     * @param \IBM\Watson\Common\Hydrator\HydratorInterface|null $hydrator
     * @param \IBM\Watson\Common\RequestBuilder|null             $requestBuilder
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
}
