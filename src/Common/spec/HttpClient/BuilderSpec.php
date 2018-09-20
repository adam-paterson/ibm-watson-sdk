<?php

namespace spec\IBM\Watson\Common\HttpClient;

use IBM\Watson\Common\HttpClient\Builder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Builder::class);
    }

    public function it_should_accept_user_credentials()
    {
        $this->withCredentials('username', 'password')->shouldReturn($this);
        $this->withUsername('username')->shouldReturn($this);
        $this->withPassword('password')->shouldReturn($this);
    }
}
