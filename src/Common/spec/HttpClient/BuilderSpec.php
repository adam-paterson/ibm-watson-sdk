<?php

namespace spec\IBM\Watson\Common\HttpClient;

use Http\Message\Authentication;
use Mockery as m;
use IBM\Watson\Common\HttpClient\Builder;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\UriInterface;

class BuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Builder::class);
    }

    public function it_should_accept_authentication()
    {
        $this->withAuthentication(m::mock(Authentication::class))->shouldReturn($this);
    }

    public function it_should_accept_hostname()
    {
        $this->withHostname(m::mock(UriInterface::class))->shouldReturn($this);
    }

    public function it_should_accept_default_path()
    {
        $this->withPath(m::mock(UriInterface::class))->shouldReturn($this);
    }
}
