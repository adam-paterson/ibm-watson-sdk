<?php

namespace IBM\Watson\Common\Hydrator;

use Psr\Http\Message\ResponseInterface;

final class NoopHydrator implements HydratorInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @throws \LogicException
     *
     * @return void
     */
    public function hydrate(ResponseInterface $response, $class = null)
    {
        throw new \LogicException('The NoopHydrator should never be called');
    }
}
