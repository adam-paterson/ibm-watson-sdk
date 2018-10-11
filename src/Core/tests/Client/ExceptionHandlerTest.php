<?php

namespace IBM\Watson\Core\tests\Client;

use IBM\Watson\Core\Client\ExceptionHandler;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ExceptionHandlerTest extends TestCase
{
    private $request;

    private $response;

    public function setUp()
    {
        $this->request  = m::mock(RequestInterface::class);
        $this->response = m::mock(ResponseInterface::class);
    }

    /**
     * @expectedException \Http\Client\Exception\HttpException
     */
    public function testHandle()
    {
        $this->request
            ->shouldReceive('getRequestTarget')
            ->andReturn('https://api.example.com');

        $this->request
            ->shouldReceive('getMethod')
            ->andReturn('GET');

        $this->response
            ->shouldReceive('getStatusCode')
            ->andReturn(500);

        $this->response
            ->shouldReceive('getReasonPhrase')
            ->andReturn('Internal Server Error');

        $handler = new ExceptionHandler();
        $handler->handle($this->request, $this->response);
    }
}
