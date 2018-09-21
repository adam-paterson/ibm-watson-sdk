<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * AbstractHydrator provides common protected methods other hydrators might need to use.
 */
abstract class AbstractHydrator implements HydratorInterface
{
    const HEADER_CONTENT_TYPE = 'Content-Type';

    /**
     * @param \Psr\Http\Message\ResponseInterface $response Response to check.
     *
     * @return bool
     */
    protected function isJsonResponse(ResponseInterface $response): bool
    {
        return 0 === \strpos($response->getHeaderLine(self::HEADER_CONTENT_TYPE), 'application/json');
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response Response to parse.
     *
     * @return string
     */
    protected function getBody(ResponseInterface $response): string
    {
        return $response->getBody()->__toString();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response Response to parse.
     *
     * @return array|null
     */
    protected function getBodyContent(ResponseInterface $response): ?array
    {
        return json_decode($this->getBody($response), true);
    }
}
