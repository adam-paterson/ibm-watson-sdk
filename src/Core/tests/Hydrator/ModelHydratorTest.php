<?php

namespace IBM\Watson\Core\tests\Client;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use IBM\Watson\Core\Model\ModelInterface;
use IBM\Watson\Core\Hydrator\ModelHydrator;
use IBM\Watson\Core\Model\CreatableFromArrayInterface;

class ModelHydratorTest extends TestCase
{
    private $response;
    private $body;
    private $stream;
    private $constructorModel;
    private $creatableModel;

    public function setUp()
    {
        $this->response         = m::mock(ResponseInterface::class);
        $this->body             = m::mock(StreamInterface::class);
        $this->stream           = m::mock(StreamInterface::class);
        $this->constructorModel = m::mock(ModelInterface::class)->makePartial();
        $this->creatableModel   = m::mock(CreatableFromArrayInterface::class)->makePartial();
    }

    public function testHydrateWithConstructableModel()
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

        $hydrator = new ModelHydrator();
        $hydrated = $hydrator->hydrate($this->response, \get_class($this->constructorModel));

        $this->assertInstanceOf(ModelInterface::class, $hydrated);
    }

    public function testHydrateWithCreatableModel()
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
            ->andReturn('{"param": "value", "param2": 123}');

        $hydrator = new ModelHydrator();
        $hydrated = $hydrator->hydrate($this->response, \IBM\Watson\Core\stubs\CreatableFromArrayModel::class);

        $this->assertInstanceOf(CreatableFromArrayInterface::class, $hydrated);
    }

    /**
     * @expectedException \IBM\Watson\Core\Exception\HydrationException
     */
    public function testExceptionIsThrownWhenModelClassIsNotProvided()
    {
        $this->response
            ->shouldReceive('getHeaderLine')
            ->with('Content-Type')
            ->andReturn('application/json');

        $hydrator = new ModelHydrator();
        $hydrator->hydrate($this->response);
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

        $hydrator = new ModelHydrator();
        $hydrator->hydrate($this->response, ModelInterface::class);
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

        $hydrator = new ModelHydrator();
        $hydrator->hydrate($this->response);
    }
}
