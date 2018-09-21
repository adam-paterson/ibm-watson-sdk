<?php

namespace spec\IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Hydrator\AbstractHydrator;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\Model\CreatableFromArray;
use IBM\Watson\Common\stubs\CreatableFromArrayModel;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ModelHydratorSpec extends ObjectBehavior
{
    public function let(ResponseInterface $response, StreamInterface $stream)
    {
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ModelHydrator::class);
        $this->shouldHaveType(AbstractHydrator::class);
        $this->shouldHaveType(HydratorInterface::class);
    }

    public function it_should_thrown_exception_when_class_is_not_provided($response)
    {
        $this->shouldThrow(\BadMethodCallException::class)->during('hydrate', [$response]);
    }

    public function it_should_throw_exception_when_unable_to_parse_response($response)
    {
        $response->getHeaderLine()
            ->withArguments(['Content-Type'])
            ->willReturn('text/plain');

        $this->shouldThrow(\BadMethodCallException::class)->during('hydrate', [$response]);
    }

    public function it_should_hydrate_response(StreamInterface $stream, ResponseInterface $response)
    {
        $response->getHeaderLine()
            ->withArguments(['Content-Type'])
            ->willReturn('application/json');

        $stream->__toString()->willReturn('{"param": "value"}');

        $response->getBody()
            ->willReturn($stream);

        $this->hydrate($response, CreatableFromArrayModel::class)->shouldReturnAnInstanceOf(CreatableFromArray::class);
    }
}
