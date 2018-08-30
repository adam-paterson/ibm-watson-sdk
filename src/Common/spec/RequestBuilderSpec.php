<?php

namespace spec\IBM\Watson\Common;

use IBM\Watson\Common\RequestBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestBuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RequestBuilder::class);
    }
}
