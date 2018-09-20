<?php

declare(strict_types=1);

namespace IBM\Watson\Common;

use Http\Client\HttpClient;
use IBM\Watson\Common\Util\DiscoveryTrait;

/**
 * Abstract service client which all other service clients should extend from.
 */
abstract class AbstractClient
{
    use DiscoveryTrait;

    /**
     * @var \Http\Client\HttpClient|null
     */
    protected $httpClient;

    /**
     * @param \Http\Client\HttpClient|null $httpClient HTTP client to send requests.
     */
    public function __construct(
        HttpClient $httpClient = null
    ) {
        $this->httpClient = $httpClient ?: $this->discoverHttpClient();
    }
}
