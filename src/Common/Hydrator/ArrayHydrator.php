<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Exception\HydrationException;
use Psr\Http\Message\ResponseInterface;

/**
 * The ArrayHydrator will hydrate a json response into an associative array.
 */
class ArrayHydrator extends AbstractHydrator
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response Response to hydrate.
     * @param string|null                         $class    Class to hydrate to.
     *
     * @return array
     *
     * @throws \IBM\Watson\Common\Exception\HydrationException
     * @throws \IBM\Watson\Common\Exception\JsonException
     */
    public function hydrate(ResponseInterface $response, string $class = null): array
    {
        if (!$this->isJsonResponse($response)) {
            $message = 'The ArrayHydrator cannot hydrate a response with Content-Type: ';

            throw new HydrationException($message.$response->getHeaderLine(self::HEADER_CONTENT_TYPE));
        }

        $body = $this->getBodyContent($response);

        return $body;
    }
}
