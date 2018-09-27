<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Hydrator;

use Psr\Http\Message\ResponseInterface;
use IBM\Watson\Core\Exception\HydrationException;

/**
 * Base Hydrator class containing common methods used in other hydrators.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
abstract class AbstractHydrator implements HydratorInterface
{
    const HEADER_CONTENT_TYPE = 'Content-Type';

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return string
     */
    protected function getResponseBody(ResponseInterface $response): string
    {
        return (string) $response->getBody()->__toString();
    }

    /**
     * Is response json?
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return bool
     */
    protected function isJson(ResponseInterface $response): bool
    {
        return 0 === \strpos($this->getContentType($response), 'application/json');
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    protected function getBodyContent(ResponseInterface $response): array
    {
        $content = json_decode($this->getResponseBody($response), true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new HydrationException(sprintf(
                'Error (%d) when trying to json_decode response: %s',
                \json_last_error(),
                \json_last_error_msg()
            ));
        }

        return $content;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return string
     */
    protected function getContentType(ResponseInterface $response): string
    {
        return $response->getHeaderLine(static::HEADER_CONTENT_TYPE);
    }
}
