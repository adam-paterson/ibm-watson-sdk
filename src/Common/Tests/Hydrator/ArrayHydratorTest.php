<?php

namespace IBM\Watson\Common\Tests\Hydrator;

use Mockery as m;
use IBM\Watson\Common\Hydrator\ArrayHydrator;
use IBM\Watson\Common\Tests\AbstractTestCase;
use PHPUnit\Framework\Constraint\IsType;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ArrayHydratorTest extends AbstractTestCase
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var StreamInterface
     */
    private $stream;

    public function setUp()
    {
        $this->response = m::mock(ResponseInterface::class);
        $this->stream = m::mock(StreamInterface::class);
    }

    public function testHydrate()
    {
        $response = $this->getRawMockResponse('SuccessResponse.json');
        $this->stream
            ->shouldReceive('__toString')
            ->once()
            ->andReturn($response);

        $this->response
            ->shouldReceive('getHeaderLine')
            ->once()
            ->andReturn('application/json');

        $this->response
            ->shouldReceive('getBody')
            ->once()
            ->andReturn($this->stream);

        $hydrator = new ArrayHydrator();
        $data = $hydrator->hydrate($this->response);

        $this->assertInternalType(IsType::TYPE_ARRAY, $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('dob', $data);
        $this->assertArrayHasKey('relationship_status', $data);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     * @expectedExceptionMessage The ArrayHydrator cannot hydrate a response with Content-Type: text/plain
     */
    public function testNoneJsonExceptionIsThrown()
    {
        $this->response
            ->shouldReceive('getHeaderLine')
            ->once()
            ->andReturn('text/plain');

        $hydrator = new ArrayHydrator();
        $hydrator->hydrate($this->response);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\JsonException
     * @expectedExceptionMessage Error (4) when trying to json_decode response: Syntax error
     */
    public function testInvalidJsonExceptionIsThrown()
    {
        $this->stream
            ->shouldReceive('__toString')
            ->once()
            ->andReturn('{param:value}');

        $this->response
            ->shouldReceive('getHeaderLine')
            ->once()
            ->andReturn('application/json');

        $this->response
            ->shouldReceive('getBody')
            ->once()
            ->andReturn($this->stream);

        $hydrator = new ArrayHydrator();
        $hydrator->hydrate($this->response);
    }
}
