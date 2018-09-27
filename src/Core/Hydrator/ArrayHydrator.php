<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Hydrator;

use Psr\Http\Message\ResponseInterface;
use IBM\Watson\Core\Exception\HydrationException;

/**
 * Class to hydrate ResponseInterface instance into associative array.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class ArrayHydrator extends AbstractHydrator
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null                         $class
     *
     * @return array
     */
    public function hydrate(ResponseInterface $response, string $class = null): array
    {
        if (!$this->isJson($response)) {
            throw new HydrationException(
                sprintf(
                    'ArrayHydrator cannot hydrate response with Content-Type: %s',
                    $this->getContentType($response)
                )
            );
        }

        $content = $this->getBodyContent($response);

        return $content;
    }
}
