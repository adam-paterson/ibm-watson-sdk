<?php

namespace IBM\Watson\Common\Hydrator;

use Psr\Http\Message\ResponseInterface;

interface HydratorInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string                              $class
     *
     * @return mixed
     */
    public function hydrate(ResponseInterface $response, $class = null);
}
