<?php

namespace spec\IBM\Watson\Core\Exception;

use IBM\Watson\Core\Exception\InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InvalidArgumentExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidArgumentException::class);
    }
}
