<?php

declare(strict_types=1);

namespace IBM\Watson\Common;

use Http\Message\RequestFactory;
use IBM\Watson\Common\Util\DiscoveryTrait;
use Psr\Http\Message\RequestInterface;

/**
 * RequestBuilder is a wrapper for a message factory to create PSR-7 requests.
 */
class RequestBuilder implements RequestBuilderInterface
{
    use DiscoveryTrait;

    /**
     * @var \Http\Message\RequestFactory
     */
    private $requestFactory;

    /**
     * @param \Http\Message\RequestFactory $requestFactory Request factory to create requests.
     */
    public function __construct(RequestFactory $requestFactory = null)
    {
        $this->requestFactory = $requestFactory ?: $this->discoverMessageFactory();
    }

    /**
     * Create a PSR-7 request.
     *
     * @param string                               $method  HTTP method type.
     * @param string|UriInterface                  $uri     Request path.
     * @param array                                $headers Request headers.
     * @param resource|string|StreamInterface|null $body    Request body.
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function create(string $method, $uri, array $headers = [], $body = null): RequestInterface
    {
        return $this->requestFactory->createRequest($method, $uri, $headers, $body);
    }
}
