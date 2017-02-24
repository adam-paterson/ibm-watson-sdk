<?php


namespace IBM\Watson\Common\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

/**
 * Class TestCase
 * @package IBM\Watson\Common\Tests
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * @param string $path Mock response file
     * @param int $code Response code
     * @return Response
     */
    public function getMockHttpResponse($path, $code = 200)
    {
        if ($path instanceof Response) {
            return $path;
        }

        $ref = new \ReflectionObject($this);
        $dir = dirname($ref->getFileName());

        // if mock file doesn't exist, check parent directory
        if (!file_exists($dir . '/Mock/' . $path) && file_exists($dir . '/../Mock/' . $path)) {
            return new Response($code, [], file_get_contents($dir . '/../Mock/' . $path));
        }

        return new Response($code, [], file_get_contents($dir . '/Mock/' . $path));
    }

    /**
     * Get a mock HTTP client with history and mock responses
     *
     * @param mixed $container Responses container
     * @param $responses
     * @return Client
     */
    public function getMockHttpClientWithHistoryAndResponses(&$container, $responses)
    {
        $mock = new MockHandler($responses);

        $stack = HandlerStack::create($mock);
        $history = Middleware::history($container);
        $stack->push($history);

        return new Client(['handler' => $stack]);
    }

    /**
     * Get HTTP client
     *
     * @return Client
     */
    public function getHttpClient()
    {
        if (null === $this->httpClient) {
            $this->httpClient = new Client;
        }

        return $this->httpClient;
    }
}
