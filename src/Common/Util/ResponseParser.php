<?php

namespace IBM\Watson\Common\Util;

use Psr\Http\Message\ResponseInterface;

/**
 * Utility class to parse instances of ResponseInterface
 */
trait ResponseParser
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return boolean
     */
    public function isResponseJson(ResponseInterface $response)
    {
        return \strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return string
     */
    public function getBody(ResponseInterface $response)
    {
        return $response->getBody()->__toString();
    }
}
