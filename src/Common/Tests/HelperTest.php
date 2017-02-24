<?php

namespace IBM\Watson\Common\Tests;

use Mockery as m;
use IBM\Watson\Common\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testCamelCase()
    {
        $result = Helper::camelCase('test_case');
        $this->assertEquals('testCase', $result);
    }

    public function testCamelCaseIgnoresWhenAlreadyCorrect()
    {
        $result = Helper::camelCase('testCase');
        $this->assertEquals('testCase', $result);
    }

    public function testCamelCaseWithUppercaseValue()
    {
        $result = Helper::camelCase('TEST_CASE');
        $this->assertEquals('testCase', $result);
    }

    public function testInitializeIgnoresNullValues()
    {
        $target = m::mock();
        Helper::initialize($target, null);
    }

    public function testInitializeIgnoresString()
    {
        $target = m::mock();
        Helper::initialize($target, 'invalid');
    }

    public function testInitializeCallsSetters()
    {
        $target = m::mock('\IBM\Watson\Common\AbstractService');
        $target->shouldReceive('setUsername')->once()->with('adam');
        $target->shouldReceive('setPassword')->once()->with('01234');

        Helper::initialize($target, ['username' => 'adam', 'password' => '01234']);
    }
}
