<?php

namespace IBM\Watson\Common\Hydrator;

use Psr\Http\Message\ResponseInterface;

trait ResponseParser
{
    /**
     * Is response json
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return bool
     */
    public function isResponseJson(ResponseInterface $response)
    {
        return \strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0;
    }
}
