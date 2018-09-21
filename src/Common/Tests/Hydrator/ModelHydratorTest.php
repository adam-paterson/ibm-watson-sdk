<?php

namespace IBM\Watson\Common\Tests\Hydrator;

use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\stubs\CreatableFromArrayModel;
use IBM\Watson\Common\stubs\Model;
use IBM\Watson\Common\Tests\AbstractTestCase;
use Mockery as m;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ModelHydratorTest extends AbstractTestCase
{
    private $response;

    private $stream;

    private $model;

    private $creatableFromArrayModel;

    public function setUp()
    {
        $this->response = m::mock(ResponseInterface::class);
        $this->stream = m::mock(StreamInterface::class);
        $this->creatableFromArrayModel = m::mock(CreatableFromArrayModel::class)->makePartial();
        $this->model = m::mock(Model::class)->makePartial();
    }

    public function testHydrate()
    {
        $this->stream->shouldReceive('__toString')->andReturn('{"param":"value"}');

        $this->response->shouldReceive('getHeaderLine')->once()->andReturn('application/json');
        $this->response->shouldReceive('getBody')->once()->andReturn($this->stream);

        $hydrator = new ModelHydrator();

        $content = $hydrator->hydrate($this->response, CreatableFromArrayModel::class);
        $this->assertInstanceOf(CreatableFromArrayModel::class, $content);

        $content = $hydrator->hydrate($this->response, Model::class);
        $this->assertInstanceOf(Model::class, $content);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     * @expectedExceptionMessage The ModelHydrator requires a model class as the second parameter
     */
    public function testNoModelSuppliedException()
    {
        $hydrator = new ModelHydrator();

        $hydrator->hydrate($this->response);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     * @expectedExceptionMessage The ModelHydrator cannot hydrate a response with Content-Type: text/plain
     */
    public function testNoneJsonExceptionIsThrown()
    {
        $this->stream->shouldReceive('__toString')->once()->andReturn('Plain text response');
        $this->response->shouldReceive('getHeaderLine')->andReturn('text/plain');
        $this->response->shouldReceive('getBody')->once()->andReturn($this->stream);

        $hydrator = new ModelHydrator();
        $hydrator->hydrate($this->response, get_class($this->creatableFromArrayModel));
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\JsonException
     */
    public function testInvalidJsonExceptionIsThrown()
    {
        $this->stream->shouldReceive('__toString')->once()->andReturn('{param:value}');

        $this->response->shouldReceive('getHeaderLine')->once()->andReturn('application/json');
        $this->response->shouldReceive('getBody')->once()->andReturn($this->stream);

        $hydrator = new ModelHydrator();
        $hydrator->hydrate($this->response, get_class($this->creatableFromArrayModel));
    }
}
