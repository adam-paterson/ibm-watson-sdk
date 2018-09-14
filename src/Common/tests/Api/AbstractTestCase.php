<?php

namespace IBM\Watson\Common\tests\Api;

use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\RequestBuilder;
use PHPUnit\Framework\TestCase;
use Mockery as m;

abstract class AbstractTestCase extends TestCase
{
    protected $httpClient;
    protected $hydrator;
    protected $requestBuilder;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
        $this->hydrator = m::mock(HydratorInterface::class)->makePartial();
        $this->requestBuilder = new RequestBuilder();
    }

    public function setUpUnauthorizedResponse()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(401, [], '{"error":"Not Authorized"}');
        });
    }

    public function setUpNotFoundResponse()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(404, [], '{"error":"Not Found"}');
        });
    }

    public function setupWatsonServiceError()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(500, [], '{"error":"The service encountered an internal error"}');
        });
    }

    public function getMockResponse($path, $code = 200)
    {
        $ref = new \ReflectionObject($this);
        $dir = dirname($ref->getFileName());

        if (!file_exists($dir . '/mock/'. $path) && file_exists($dir . '/../mock/' . $path)) {
            return new Response(
                $code,
                [
                    'Content-Type' => 'application/json'
                ],
                file_get_contents($dir . '/../mock/' . $path)
            );
        }

        return new Response($code, [], file_get_contents($dir . '/mock/' . $path));
    }
}
