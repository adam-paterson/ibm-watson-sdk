<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Exception\JsonException;
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
     * @return array
     *
     * @throws \IBM\Watson\Common\Exception\JsonException
     */
    protected function getBodyContent(ResponseInterface $response): array
    {
        $json = json_decode($this->getBody($response), true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new JsonException(sprintf(
                'Error (%d) when trying to json_decode response: %s',
                \json_last_error(),
                \json_last_error_msg()
            ));
        }

        return $json;
    }
}
