<?php

namespace IBM\Watson\Common\Tests;

use Mockery as m;
use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient;
use IBM\Watson\Common\RequestBuilder;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * @var \IBM\Watson\Common\RequestBuilderInterface
     */
    protected $requestBuilder;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
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
    public function getMockResponse($path, $code = 200)
    {
        $ref = new ReflectionObject($this);
        $dir = \dirname($ref->getFileName());

        if (!file_exists($dir.'/mock/'.$path) && file_exists($dir.'/../mock/'.$path)) {
            return new Response(
                $code,
                [
                    'Content-Type' => 'application/json',
                ],
                file_get_contents($dir.'/../mock/'.$path)
            );
        }

        return new Response($code, [], file_get_contents($dir.'/mock/'.$path));
    }
}
