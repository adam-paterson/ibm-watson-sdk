<?php


namespace IBM\Watson\Common\Hydrator\ArrayHydratorTest;

use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\stubs\CreateableFromArrayModel;
use IBM\Watson\Common\stubs\Model;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ModelHydratorTest extends TestCase
{
    private $response;
    private $stream;
    private $model;

    public function setUp()
    {
        $this->response = m::mock(ResponseInterface::class)->makePartial();
        $this->stream = m::mock(StreamInterface::class)->makePartial();
        $this->model = m::mock(CreateableFromArrayModel::class)->makePartial();
    }

    public function testHydrate()
    {
        $this->stream->shouldReceive('__toString')->andReturn('{"param":"value"}');

        $this->response->shouldReceive('getHeaderLine')->once()->andReturn('application/json');
        $this->response->shouldReceive('getBody')->once()->andReturn($this->stream);

        $hydrator = new ModelHydrator();

        $content = $hydrator->hydrate($this->response, get_class($this->model));
        $this->assertInstanceOf(CreateableFromArrayModel::class, $content);

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
        $hydrator->hydrate($this->response, get_class($this->model));
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     */
    public function testInvalidJsonExceptionIsThrown()
    {
        $this->stream->shouldReceive('__toString')->once()->andReturn('{param:value}');

        $this->response->shouldReceive('getHeaderLine')->once()->andReturn('application/json');
        $this->response->shouldReceive('getBody')->once()->andReturn($this->stream);

        $hydrator = new ModelHydrator();
        $hydrator->hydrate($this->response, get_class($this->model));
    }
}
