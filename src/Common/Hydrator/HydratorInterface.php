<?php

namespace IBM\Watson\Common\Hydrator;

use Psr\Http\Message\ResponseInterface;

interface HydratorInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response Response to hydrate.
     * @param string|null                         $class    Class for hydration.
     *
     * @return mixed
     */
    public function hydrate(ResponseInterface $response, string $class = null);
}
