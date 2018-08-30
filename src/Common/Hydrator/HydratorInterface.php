<?php

namespace IBM\Watson\Common\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HydratorInterface
 */
interface HydratorInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null                         $class
     *
     * @return mixed
     */
    public function hydrate(ResponseInterface $response, $class = null);
}
