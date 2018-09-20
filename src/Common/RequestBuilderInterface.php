<?php

declare(strict_types=1);

namespace IBM\Watson\Common;

use Psr\Http\Message\RequestInterface;

/**
 * RequestBuilder is a wrapper for a message factory to create PSR-7 requests.
 */
interface RequestBuilderInterface
{
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
    public function create(string $method, $uri, array $headers = [], $body = null): RequestInterface;
}
