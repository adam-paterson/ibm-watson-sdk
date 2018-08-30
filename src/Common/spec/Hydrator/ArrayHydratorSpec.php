<?php

namespace spec\IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Hydrator\ArrayHydrator;
use PhpSpec\ObjectBehavior;
use Mockery as m;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ArrayHydratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArrayHydrator::class);
    }

    function it_should_hydrate_response()
    {
        $stream = m::mock(StreamInterface::class);
        $stream->shouldReceive('__toString')->once()->andReturn('{"param": "value","param2": 99}');

        $response = m::mock(ResponseInterface::class);
        $response->shouldReceive('getHeaderLine')->with('Content-Type')->andReturn('application/json');
        $response->shouldReceive('getBody')->andReturn($stream);

        $hydrated = $this->hydrate($response);
        $hydrated->shouldBeArray();
    }
}
