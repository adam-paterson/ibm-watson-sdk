<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Model\CreatableFromArray;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;

/**
 * ModelHydrator will hydrate a ResponseInterface into a model.
 */
class ModelHydrator extends AbstractHydrator
{
    const METHOD_CREATE = '::create';

    /**
     * @param \Psr\Http\Message\ResponseInterface $response Response to hydrate.
     * @param string|null                         $class    Class for hydration.
     *
     * @return \IBM\Watson\Common\Model\CreatableFromArray
     *
     * @throws \ReflectionException
     * @throws \BadMethodCallException
     */
    public function hydrate(ResponseInterface $response, string $class = null)
    {
        if (null === $class) {
            throw new \BadMethodCallException('The ModelHydrator requires a model class as the second parameter.');
        }

        if (!$this->isJsonResponse($response)) {
            $message = 'The ModelHydrator cannot hydrate a response with Content-Type: ';

            throw new \BadMethodCallException($message.$response->getHeaderLine('Content-Type'));
        }

        $body = $this->getBodyContent($response);
        if (JSON_ERROR_NONE !== \json_last_error()) {
            throw new \BadMethodCallException(sprintf(
                'Error (%d) when trying to json_decode response: %s',
                \json_last_error(),
                \json_last_error_msg()
            ));
        }

        $reflection = new ReflectionClass($class);
        if ($reflection->implementsInterface(CreatableFromArray::class)) {
            $model = \call_user_func($class.self::METHOD_CREATE, $body);
        } else {
            $model = new $class($body);
        }

        return $model;
    }
}
