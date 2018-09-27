<?php

namespace spec\IBM\Watson\Core\Hydrator;

use IBM\Watson\Core\Exception\HydrationException;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\Core\Hydrator\ModelHydrator;
use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\Core\Model\ModelInterface;
use IBM\Watson\Core\Model\stubs\Model;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ModelHydratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ModelHydrator::class);
        $this->shouldImplement(HydratorInterface::class);
    }

    function it_hydrates_response_into_model(
        ResponseInterface $response,
        StreamInterface $body,
        ModelInterface $model
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
            ->willReturn('{"param": "value", "param2": 123}');


        $this->hydrate($response, \get_class($model->getWrappedObject()))->shouldReturnAnInstanceOf(ModelInterface::class);
    }

    function it_throws_hydration_exception_when_class_is_not_provided(
        ResponseInterface $response
    ) {
        $this->shouldThrow(HydrationException::class)->during('hydrate', [$response]);
    }

    function it_throws_hydration_exception_when_json_decode_fails(
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
            ->during('hydrate', [$response, 'Class']);
    }

    function it_throws_hydration_exception_when_response_is_not_json(
        ResponseInterface $response
    ) {
        $response
            ->getHeaderLine('Content-Type')
            ->shouldBeCalled()
            ->willReturn('text/plain');

        $this->shouldThrow(HydrationException::class)
            ->during('hydrate', [$response, 'Class']);
    }
}
