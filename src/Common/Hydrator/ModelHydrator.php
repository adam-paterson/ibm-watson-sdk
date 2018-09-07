<?php

namespace IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Exception\HydrationException;
use IBM\Watson\Common\Model\CreateableFromArray;
use IBM\Watson\Common\Util\ResponseParser;
use Psr\Http\Message\ResponseInterface;

class ModelHydrator implements HydratorInterface
{
    use ResponseParser;

    public function hydrate(ResponseInterface $response, $class = null)
    {
        if (null === $class) {
            throw new HydrationException('The ModelHydrator requires a model class as the second parameter');
        }

        $body = $this->getBody($response);
        if (!$this->isResponseJson($response)) {
            $message = 'The ModelHydrator cannot hydrate a response with Content-Type: ';
            throw new HydrationException($message . $response->getHeaderLine('Content-Type'));
        }

        $data = \json_decode($body, true);
        if (\JSON_ERROR_NONE !== \json_last_error()) {
            throw new HydrationException(sprintf(
                'Error (%d) when trying to json_decode response: ',
                json_last_error()
            ));
        }

        $ref = new \ReflectionClass($class);
        if ($ref->implementsInterface(CreateableFromArray::class)) {
            $model = \call_user_func($class.'::create', $data);
        } else {
            $model = new $class($data);
        }

        return $model;
    }

}
