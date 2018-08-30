<?php

namespace spec\IBM\Watson\Common\HttpClient;

use IBM\Watson\Common\HttpClient\Builder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Builder::class);
    }
}
