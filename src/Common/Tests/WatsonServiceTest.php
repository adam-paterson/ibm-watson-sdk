<?php

namespace IBM\Watson\Common\Tests;

use Http\Message\Authentication;
use IBM\Watson\Common\WatsonService;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class WatsonServiceTest extends TestCase
{
    private $authentication;

    public function setUp()
    {
        $this->authentication = m::mock(Authentication::class);
    }

    public function testCreate()
    {
        $service = WatsonService::create($this->authentication);

        $this->assertInstanceOf(WatsonService::class, $service);
    }
}
