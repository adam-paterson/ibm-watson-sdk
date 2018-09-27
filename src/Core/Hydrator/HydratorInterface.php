<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Hydrator;

use Psr\Http\Message\ResponseInterface;

interface HydratorInterface
{
    public function hydrate(ResponseInterface $response, string $class = null);
}
