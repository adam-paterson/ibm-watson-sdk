<?php

namespace IBM\Watson\Common\Tests;

use IBM\Watson\Common\Hydrator\HydratorInterface;
use Mockery as m;
use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient;
use IBM\Watson\Common\RequestBuilder;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

abstract class AbstractTestCase extends TestCase
{
    const DIR_MOCK = '/mock/';

    /**
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * @var \IBM\Watson\Common\RequestBuilderInterface
     */
    protected $requestBuilder;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
        $this->hydrator = m::mock(HydratorInterface::class);
        $this->requestBuilder = m::mock(RequestBuilder::class);
    }

    /**
     * Get mock response from file.
     *
     * @param string $path Location of the response file.
     * @param int    $code HTTP status code.
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getMockResponse($path, $code = 200): Response
    {
        return new Response($code, [], $this->getRawMockResponse($path));
    }

    public function getRawMockResponse($path)
    {
        $reflection = new ReflectionObject($this);
        $directory = \dirname($reflection->getFileName());

        $absolutePath = $directory.self::DIR_MOCK.$path;
        $relativePath = $directory.'/../'.self::DIR_MOCK.$path;

        if (!file_exists($absolutePath) && file_exists($relativePath)) {
            $raw = file_get_contents($relativePath);
        } else {
            $raw = file_get_contents($absolutePath);
        }

        return $raw ?: false;
    }
}
