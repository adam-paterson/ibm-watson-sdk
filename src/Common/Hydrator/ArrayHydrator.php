<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Hydrator;

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
     * @throws \BadMethodCallException
     */
    public function hydrate(ResponseInterface $response, string $class = null): array
    {
        if (!$this->isJsonResponse($response)) {
            $message = 'The ArrayHydrator cannot hydrate a response with Content-Type: ';

            throw new \BadMethodCallException($message.$response->getHeaderLine(self::HEADER_CONTENT_TYPE));
        }

        $body = $this->getBodyContent($response);
        if (JSON_ERROR_NONE !== \json_last_error()) {
            throw new \BadMethodCallException(sprintf(
                'Error (%d) when trying to json_decode response: %s',
                \json_last_error(),
                \json_last_error_msg()
            ));
        }

        return $body;
    }
}
