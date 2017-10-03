<?php

namespace IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Exception\HydrationException;
use IBM\Watson\Common\Model\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface;

final class ModelHydrator implements HydratorInterface
{
    /**
     * Hydrate API response
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null                         $class
     *
     * @return mixed
     *
     * @throws \IBM\Watson\Common\Exception\HydrationException
     */
    public function hydrate(ResponseInterface $response, $class = null)
    {
        if (null === $class) {
            throw new HydrationException('The ModelHydrator requires a model class as the second parameter');
        }

        $body = $response->getBody()->__toString();
        if (\strpos($response->getHeaderLine('Content-Type'), 'application/json') !== 0) {
            $message = 'The ModelHydrator cannot hydrate response with Content-Type: ';
            throw new HydrationException($message . $response->getHeaderLine('Content-Type'));
        }

        $data = \json_decode($body, true);
        if (\JSON_ERROR_NONE !== \json_last_error()) {
            throw new HydrationException(\sprintf(
                'Error (%d) when trying to json_decode response',
                \json_last_error()
            ));
        }

        if (\is_subclass_of($class, ApiResponseInterface::class)) {
            $model = \call_user_func($class.'::create', $data);
        } else {
            $model = new $class($data);
        }

        return $model;
    }
}
