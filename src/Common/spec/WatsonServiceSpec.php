<?php

namespace spec\IBM\Watson\Common;

use Http\Message\Authentication;
use IBM\Watson\Common\WatsonService;
use PhpSpec\ObjectBehavior;

class WatsonServiceSpec extends ObjectBehavior
{
    public function let(Authentication $authentication)
    {
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(WatsonService::class);
    }

    public function it_should_create_configured_service($authentication)
    {
        $this::create($authentication)->shouldReturnAnInstanceOf(WatsonService::class);
    }
}
