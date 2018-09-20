<?php

namespace spec\IBM\Watson\Common;

use Mockery as m;
use Http\Message\RequestFactory;
use IBM\Watson\Common\RequestBuilder;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;

class RequestBuilderSpec extends ObjectBehavior
{
    public function let(
        RequestFactory $requestFactory
    ) {
        $this->beConstructedWith(
            $requestFactory
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RequestBuilder::class);
    }

    public function it_should_create_request($requestFactory)
    {
        $requestFactory
            ->createRequest('GET', '/api', [], null)
            ->shouldBeCalled()
            ->willReturn(m::mock(RequestInterface::class));

        $this->create('GET', '/api')->shouldReturnAnInstanceOf(RequestInterface::class);
    }
}
