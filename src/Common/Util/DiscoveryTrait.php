<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Util;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;

/**
 * Utility trait for discovering required components.
 */
trait DiscoveryTrait
{
    /**
     * Discover configured HTTP client.
     *
     * @return \Http\Client\HttpClient
     */
    public function discoverHttpClient(): HttpClient
    {
        return HttpClientDiscovery::find();
    }

    /**
     * Discover configured message factory.
     *
     * @return \Http\Message\MessageFactory
     */
    public function discoverMessageFactory(): MessageFactory
    {
        return MessageFactoryDiscovery::find();
    }

    /**
     * Discover configured URI factory.
     *
     * @return \Http\Message\UriFactory
     */
    public function discoverUriFactory(): UriFactory
    {
        return UriFactoryDiscovery::find();
    }
}
