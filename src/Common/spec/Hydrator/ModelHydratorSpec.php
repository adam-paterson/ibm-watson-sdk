<?php

namespace spec\IBM\Watson\Common\Hydrator;

use IBM\Watson\Common\Hydrator\ModelHydrator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModelHydratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ModelHydrator::class);
    }
}
