<?php

namespace IBM\Watson\Common;

use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

final class RequestBuilder
{
    /**
     * @var \Http\Message\MessageFactory
     */
    private $requestFactory;

    /**
     * RequestBuilder constructor.
     *
     * @param \Http\Message\RequestFactory|\Http\Message\MessageFactory|null $requestFactory
     *
     * @throws \Http\Discovery\Exception\NotFoundException
     */
    public function __construct(RequestFactory $requestFactory = null)
    {
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * Create a new PSR-7 request
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
