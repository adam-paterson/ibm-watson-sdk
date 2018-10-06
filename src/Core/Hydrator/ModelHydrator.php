<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Hydrator;

use ReflectionClass;
use Psr\Http\Message\ResponseInterface;
use IBM\Watson\Core\Exception\HydrationException;
use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * ModelHydrator will hydrate a response into a model.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
final class ModelHydrator extends AbstractHydrator
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null                         $class
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function hydrate(ResponseInterface $response, string $class = null)
    {
        if (null === $class) {
            throw new HydrationException('The ModelHydrator requires a model class as the second parameter.');
        }

        if (!$this->isJson($response)) {
            throw new HydrationException(
                sprintf(
                    'ModelHydrator cannot hydrate response with Content-Type: %s',
                    $this->getContentType($response)
                )
            );
        }

        $content = $this->getBodyContent($response);

        if ($this->isCreatableFromArray($class)) {
            $model = \call_user_func($class.'::'.CreatableFromArrayInterface::METHOD_CREATE, $content);
        } else {
            $model = new $class($content);
        }

        return $model;
    }

    /**
     * Can the model be created from array?
     *
     * @param string $class
     *
     * @return bool
     * @throws \ReflectionException
     */
    private function isCreatableFromArray(string $class): bool
    {
        $reflection   = new ReflectionClass($class);
        $hasInterface = $reflection->implementsInterface(CreatableFromArrayInterface::class);

        return $hasInterface;
    }
}
