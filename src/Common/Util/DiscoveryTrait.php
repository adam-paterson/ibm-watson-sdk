<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Util;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;

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
}
