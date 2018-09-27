<?php

namespace spec\IBM\Watson\Core\Hydrator;

use IBM\Watson\Core\Exception\HydrationException;
use IBM\Watson\Core\Hydrator\ArrayHydrator;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ArrayHydratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArrayHydrator::class);
        $this->shouldImplement(HydratorInterface::class);
    }

    function it_should_hydrate_response(ResponseInterface $response, StreamInterface $body)
    {
        $response
            ->getHeaderLine('Content-Type')
            ->shouldBeCalled()
            ->willReturn('application/json');

        $response
            ->getBody()
            ->shouldBeCalled()
            ->willReturn($body);

        $body
            ->__toString()
            ->shouldBeCalled()
            ->willReturn('{"param":"value", "param2":"value2"}');

        $this->hydrate($response)->shouldBeArray();
    }

    function it_should_throw_hydration_exception_when_json_decode_fails(
        ResponseInterface $response,
        StreamInterface $body
    ) {
        $response
            ->getHeaderLine('Content-Type')
            ->shouldBeCalled()
            ->willReturn('application/json');

        $response
            ->getBody()
            ->shouldBeCalled()
            ->willReturn($body);

        $body
            ->__toString()
            ->shouldBeCalled()
            ->willReturn('{param: value, param2:value}');

        $this->shouldThrow(HydrationException::class)
            ->during('hydrate', [$response]);
    }

    function it_should_throw_hydration_exception_when_response_is_not_json(
        ResponseInterface $response
    ) {
        $response
            ->getHeaderLine('Content-Type')
            ->shouldBeCalled()
            ->willReturn('text/plain');

        $this->shouldThrow(HydrationException::class)
            ->during('hydrate', [$response]);
    }


}
