<?php

namespace IBM\Watson\Common\tests;

use GuzzleHttp\Psr7\Response;
use IBM\Watson\Common\Hydrator\NoopHydrator;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class NoopHydratorTest extends TestCase
{
    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage The NoopHydrator should never be called
     */
    public function testUsingNoopHydratorThrowsException()
    {
        $response = m::mock(Response::class);

        $hydrator = new NoopHydrator();
        $hydrator->hydrate($response);
    }
}
