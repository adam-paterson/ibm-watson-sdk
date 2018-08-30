<?php

namespace IBM\Watson\Common\Util;

use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

/**
 * Discovery utility
 */
trait DiscoveryTrait
{
    /**
     * Discover configured HTTP client.
     *
     * @return \Http\Client\HttpClient
     */
    public function discoverHttpClient()
    {
        return HttpClientDiscovery::find();
    }

    /**
     * Discover configured message factory.
     *
     * @return \Http\Message\MessageFactory
     */
    public function discoverMessageFactory()
    {
        return MessageFactoryDiscovery::find();
    }
}
