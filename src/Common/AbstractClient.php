<?php

namespace IBM\Watson\Common;

use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\ArrayHydrator;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\Util\DiscoveryTrait;

/**
 * Base class for all Watson Service clients
 */
abstract class AbstractClient
{
    use DiscoveryTrait;

    /**
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * @var \IBM\Watson\Common\Hydrator\HydratorInterface
     */
    protected $hydrator;

    /**
     * @var \IBM\Watson\Common\RequestBuilder
     */
    protected $requestBuilder;

    /**
     * @param \Http\Client\HttpClient|null                       $httpClient
     * @param \IBM\Watson\Common\Hydrator\HydratorInterface|null $hydrator
     * @param \IBM\Watson\Common\RequestBuilder|null             $requestBuilder
     */
    public function __construct(
        HttpClient $httpClient = null,
        HydratorInterface $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->httpClient     = $httpClient ?: $this->discoverHttpClient();
        $this->hydrator       = $hydrator ?: new ModelHydrator();
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
    }
}
