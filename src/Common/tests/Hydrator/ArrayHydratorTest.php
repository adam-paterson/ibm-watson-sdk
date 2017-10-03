<?php

namespace IBM\Watson\Common\tests;

use GuzzleHttp\Psr7\Response;
use IBM\Watson\Common\Hydrator\ArrayHydrator;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class ArrayHydratorTest extends TestCase
{
    private $response;
    private $hydrator;

    public function setUp()
    {
        $this->response = m::mock(Response::class);

        $this->hydrator = new ArrayHydrator();
    }

    public function testSuccessfulHydration()
    {
        $response = m::mock(Response::class, [
            200,
            ['Content-Type' => 'application/json'],
            '{"document_tone": {}}'
        ])->makePartial();


        $result = $this->hydrator->hydrate($response);

        $this->assertArrayHasKey('document_tone', $result);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     * @expectedExceptionMessage The ArrayHydrator cannot hydrate response with Content-Type: text/plain
     */
    public function testHydrateFailsForNoneJsonResponses()
    {
        $response = m::mock(Response::class, [200, ['Content-Type' => 'text/plain']])->makePartial();

        $this->hydrator->hydrate($response);
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\HydrationException
     */
    public function testHydrateFailsWhenJsonDecodeFails()
    {
        $response = m::mock(Response::class, [200, ['Content-Type' => 'application/json'], '{"brokenJson}'])
            ->makePartial();

        $this->hydrator->hydrate($response);
    }
}
