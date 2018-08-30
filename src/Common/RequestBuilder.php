<?php

namespace IBM\Watson\Common;

use Http\Message\RequestFactory;
use IBM\Watson\Common\Util\DiscoveryTrait;

/**
 * Interface to build PSR-7 request
 */
class RequestBuilder
{
    use DiscoveryTrait;

    /**
     * @var \Http\Message\MessageFactory
     */
    private $requestFactory;

    /**
     * @param \Http\Message\RequestFactory $requestFactory
     */
    public function __construct(RequestFactory $requestFactory = null)
    {
        $this->requestFactory = $requestFactory ?: $this->discoverMessageFactory();
    }

    /**
     * Create a new PSR-7 request.
     *
     * @param string                               $method
     * @param string|UriInterface                  $uri
     * @param array                                $headers
     * @param resource|string|StreamInterface|null $body
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function create($method, $uri, array $headers = [], $body = null)
    {
        return $this->requestFactory->createRequest($method, $uri, $headers, $body);
    }
}
