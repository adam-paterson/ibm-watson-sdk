<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * Hydrator interface.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
interface HydratorInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null                         $class
     *
     * @return mixed
     */
    public function hydrate(ResponseInterface $response, string $class = null);
}
