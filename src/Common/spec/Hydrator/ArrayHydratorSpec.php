<?php

namespace spec\IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Exception\HydrationException;
use IBM\Watson\Common\Hydrator\AbstractHydrator;
use IBM\Watson\Common\Hydrator\ArrayHydrator;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ArrayHydratorSpec extends ObjectBehavior
{
    public function let(
        ResponseInterface $response,
        StreamInterface $stream
    ) {
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ArrayHydrator::class);
        $this->shouldHaveType(AbstractHydrator::class);
        $this->shouldHaveType(HydratorInterface::class);
    }

    public function it_should_throw_exception_when_unable_to_parse_response($response)
    {
        $response->getHeaderLine()
            ->withArguments(['Content-Type'])
            ->willReturn('text/plain');

        $this->shouldThrow(HydrationException::class)->during('hydrate', [$response]);
    }

    public function it_should_hydrate_response(StreamInterface $stream, ResponseInterface $response)
    {
        $response->getHeaderLine()
            ->withArguments(['Content-Type'])
            ->willReturn('application/json');

        $stream->__toString()->willReturn('{"value": "param"}');

        $response->getBody()
            ->willReturn($stream);

        $this->hydrate($response)->shouldBeArray();
    }
}
