<?php

namespace IBM\Watson\Core\tests\Client;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\Constraint\IsType;
use IBM\Watson\Core\Hydrator\ArrayHydrator;

class ArrayHydratorTest extends TestCase
{
    private $response;
    private $body;

    public function setUp()
    {
        $this->response = m::mock(ResponseInterface::class);
        $this->body     = m::mock(StreamInterface::class);
    }

    public function testHydrate()
    {
        $this->response
            ->shouldReceive('getHeaderLine')
            ->with('Content-Type')
            ->andReturn('application/json');

        $this->response
            ->shouldReceive('getBody')
            ->andReturn($this->body);

        $this->body
            ->shouldReceive('__toString')
            ->andReturn('{"param":"value", "param2": 123}');

        $hydrator = new ArrayHydrator();

        $data = $hydrator->hydrate($this->response);

        $this->assertInternalType(IsType::TYPE_ARRAY, $data);
        $this->assertArrayHasKey('param', $data);
        $this->assertArrayHasKey('param2', $data);
    }

    /**
     * @expectedException \IBM\Watson\Core\Exception\HydrationException
     */
    public function testExceptionIsThrownTryingToHydrateNoneJsonResponse()
    {
        $this->response
            ->shouldReceive('getHeaderLine')
            ->with('Content-Type')
            ->andReturn('text/plain');

        $hydrator = new ArrayHydrator();
        $hydrator->hydrate($this->response);
    }

    /**
     * @expectedException \IBM\Watson\Core\Exception\HydrationException
     */
    public function testExceptionIsThrownTryingToHydrateInvalidJsonResponse()
    {
        $this->response
            ->shouldReceive('getHeaderLine')
            ->with('Content-Type')
            ->andReturn('application/json');

        $this->response
            ->shouldReceive('getBody')
            ->andReturn($this->body);

        $this->body
            ->shouldReceive('__toString')
            ->andReturn('{param: value, param2: value}');

        $hydrator = new ArrayHydrator();
        $hydrator->hydrate($this->response);
    }
}
