<?php

namespace IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Exception\HydrationException;
use Psr\Http\Message\ResponseInterface;

final class ArrayHydrator implements HydratorInterface
{
    use ResponseParser;

    /**
     * Hydrate API response to array
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return mixed
     * @throws \IBM\Watson\Common\Exception\HydrationException
     */
    public function hydrate(ResponseInterface $response, $class = null)
    {
        $body = $response->getBody()->__toString();
        if (!$this->isResponseJson($response)) {
            $message = 'The ArrayHydrator cannot hydrate response with Content-Type: ';
            throw new HydrationException($message . $response->getHeaderLine('Content-Type'));
        }

        $content = \json_decode($body, true);
        if (JSON_ERROR_NONE !== \json_last_error()) {
            throw new HydrationException(sprintf(
                'Error (%d) when trying to json_decode response',
                \json_last_error()
            ));
        }

        return $content;
    }
}
