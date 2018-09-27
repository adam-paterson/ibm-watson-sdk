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
class ArrayHydrator implements HydratorInterface
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
                    $response->getHeaderLine('Content-Type')
                )
            );
        }

        $body = $response->getBody()->__toString();
        $data = json_decode($body, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new HydrationException(sprintf(
                'Error (%d) when trying to json_decode response: %s',
                \json_last_error(),
                \json_last_error_msg()
            ));
        }

        return $data;
    }

    /**
     * Is response json?
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return bool
     */
    private function isJson(ResponseInterface $response): bool
    {
        return 0 === \strpos($response->getHeaderLine('Content-Type'), 'application/json');
    }
}
