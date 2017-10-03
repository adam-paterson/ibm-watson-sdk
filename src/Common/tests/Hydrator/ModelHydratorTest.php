<?php

namespace IBM\Watson\Common\tests;

use GuzzleHttp\Psr7\Response;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\Model\CreateableFromArray;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class ModelHydratorTest extends TestCase
{
    private $hydrator;
    private $model;

    public function setUp()
    {
        $this->hydrator = new ModelHydrator();
        $this->model = m::mock('alias:'.CreateableFromArray::class);
    }

    public function testSuccessfulHydration()
    {
        $response = m::mock(
            Response::class,
            [
                200,
                ['Content-Type' => 'application/json'],
                '{"document_tone": {}}'
            ]
        );

        $response->makePartial();

        $this->model->shouldReceive('createFromArray')->andReturn(['document_tone' => []]);

        $result = $this->hydrator->hydrate($response, $this->model);

        $this->assertInstanceOf(CreateableFromArray::class, $result);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     * @expectedExceptionMessage The ModelHydrator requires a model class as the second parameter
     */
    public function testHydrateFailsWithoutClass()
    {
        $response = m::mock(Response::class, [200]);

        $this->hydrator->hydrate($response);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     * @expectedExceptionMessage The ModelHydrator cannot hydrate response with Content-Type: text/plain
     */
    public function testHydrateFailsForNoneJsonResponses()
    {
        $response = m::mock(Response::class, [200, ['Content-Type' => 'text/plain']])->makePartial();

        $this->hydrator->hydrate($response, \stdClass::class);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     */
    public function testHydrateFailsWhenJsonDecodeFails()
    {
        $response = m::mock(Response::class, [200, ['Content-Type' => 'application/json'], '{"brokenJson}'])
            ->makePartial();

        $this->hydrator->hydrate($response, \stdClass::class);
    }
}
