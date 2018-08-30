<?php


namespace IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Exception\HydrationException;
use IBM\Watson\Common\Util\ResponseParser;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface to hydrate instance of ResponseInterface into an array
 */
class ArrayHydrator implements HydratorInterface
{
    use ResponseParser;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null                         $class
     *
     * @throws \IBM\Watson\Common\Exception\HydrationException
     *
     * @return mixed
     */
    public function hydrate(ResponseInterface $response, $class = null)
    {
        if (!$this->isResponseJson($response)) {
            $message = 'The ArrayHydrator cannot hydrate a response with Content-Type: ';
            throw new HydrationException($message . $response->getHeaderLine('Content-Type'));
        }

        $body = $this->getBody($response);
        $content = \json_decode($body, true);
        if (JSON_ERROR_NONE !== \json_last_error()) {
            throw new HydrationException(sprintf(
                'Error (%d) when trying to json_decode response: %s',
                \json_last_error(),
                \json_last_error_msg()
            ));
        }

        return $content;
    }
}
