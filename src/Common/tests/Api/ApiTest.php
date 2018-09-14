<?php

namespace IBM\Watson\Common\tests\Api;

use GuzzleHttp\Psr7\Response;
use IBM\Watson\Common\stubs\Api;

class ApiTest extends AbstractTestCase
{
    public function setup200Response()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(200, []);
        });
    }

    public function testGet()
    {
        $this->setup200Response();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->getMethod();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPost()
    {
        $this->setup200Response();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->postMethod();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPostRaw()
    {
        $this->setup200Response();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->postRawMethod();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPut()
    {
        $this->setup200Response();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->putMethod();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPatch()
    {
        $this->setup200Response();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->patchMethod();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDelete()
    {
        $this->setup200Response();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $response = $api->deleteMethod();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @expectedExceptionMessage Not Authorized
     */
    public function testUnauthorizedExceptionIsThrown()
    {
        parent::setUpUnauthorizedResponse();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $api->getMethod();
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @expectedExceptionMessage Not Found
     */
    public function testNotFoundExceptionIsThrown()
    {
        parent::setUpNotFoundResponse();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $api->getMethod();
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     * @expectedExceptionMessage The service encountered an internal error
     */
    public function testWatsonUnknownErrorIsThrown()
    {
        parent::setupWatsonServiceError();

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $api->getMethod();
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     * @expectedExceptionMessage The service encountered an internal error
     */
    public function testDefaultUnknownErrorIsThrown()
    {
        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () {
            return new Response(999, [], '{"error":"The service encountered an internal error"}');
        });

        $api = new Api($this->httpClient, $this->hydrator, $this->requestBuilder);
        $api->getMethod();
    }
}
