<?php

namespace IBM\Watson\Common\Hydrator\ArrayHydratorTest;

use IBM\Watson\Common\Hydrator\ArrayHydrator;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ArrayHydratorTest extends TestCase
{
    private $response;
    private $stream;

    public function setUp()
    {
        $this->response =  m::mock(ResponseInterface::class)->makePartial();
        $this->stream = m::mock(StreamInterface::class)->makePartial();
    }

    public function testHydrate()
    {
        $this->stream->shouldReceive('__toString')->andReturn('{"param": "value","param2": 99}');

        $this->response->shouldReceive('getHeaderLine')->once()->andReturn('application/json');
        $this->response->shouldReceive('getBody')->once()->andReturn($this->stream);

        $hydrator = new ArrayHydrator();
        $content = $hydrator->hydrate($this->response);

        $this->assertArrayHasKey('param', $content);
        $this->assertArrayHasKey('param2', $content);
        $this->assertEquals('value', $content['param']);
        $this->assertEquals(99, $content['param2']);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     * @expectedExceptionMessage The ArrayHydrator cannot hydrate a response with Content-Type: text/plain
     */
    public function testNoneJsonExceptionIsThrown()
    {
        $this->response->shouldReceive('getHeaderLine')->once()->andReturn('text/plain');

        $hydrator = new ArrayHydrator();
        $hydrator->hydrate($this->response);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     * @expectedExceptionMessage Error (4) when trying to json_decode response: Syntax error
     */
    public function testInvalidJsonExceptionIsThrown()
    {
        $this->stream->shouldReceive('__toString')->once()->andReturn('{param:value}');

        $this->response->shouldReceive('getHeaderLine')->once()->andReturn('application/json');
        $this->response->shouldReceive('getBody')->once()->andReturn($this->stream);

        $hydrator = new ArrayHydrator();
        $hydrator->hydrate($this->response);
    }
}
