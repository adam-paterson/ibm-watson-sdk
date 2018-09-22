<?php

declare(strict_types=1);

namespace IBM\Watson\Common;

use Http\Client\HttpClient;
use Http\Message\Authentication;
use IBM\Watson\Common\HttpClient\Builder;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\Util\DiscoveryTrait;

/**
 * Base service client which all other service clients should extend from.
 */
class WatsonService implements WatsonServiceInterface
{
    use DiscoveryTrait;

    /**
     * @var \Http\Client\HttpClient|null
     */
    protected $httpClient;

    /**
     * @var \IBM\Watson\Common\Hydrator\ModelHydrator
     */
    protected $hydrator;

    /**
     * @var \IBM\Watson\Common\RequestBuilder
     */
    protected $requestBuilder;

    /**
     * @var string
     */
    protected $hostname;

    /**
     * @param \Http\Client\HttpClient|null                       $httpClient     HTTP client to send requests.
     * @param \IBM\Watson\Common\Hydrator\HydratorInterface|null $hydrator       Hydrator to hydrate responses.
     * @param \IBM\Watson\Common\RequestBuilderInterface|null    $requestBuilder Request builder to create requests.
     */
    public function __construct(
        HttpClient $httpClient = null,
        HydratorInterface $hydrator = null,
        RequestBuilderInterface $requestBuilder = null
    ) {
        $this->httpClient = $httpClient ?: $this->discoverHttpClient();
        $this->hydrator = $hydrator ?: new ModelHydrator();
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
    }

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
            ->withAuthentication($authentication)
            ->createConfiguredClient();

        return new self($httpClient);
    }
}
