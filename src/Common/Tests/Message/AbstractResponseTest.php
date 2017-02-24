<?php

namespace IBM\Watson\Common\Tests\Message;

use Mockery as m;

class AbstractResponseTest extends \PHPUnit_Framework_TestCase
{
    protected $response;

    public function setUp()
    {
        $this->response = m::mock('\IBM\Watson\Common\Message\AbstractResponse')->makePartial();
    }

    public function testConstruct()
    {
        $data = ['username' => 'adam', 'password' => 'adam'];
        $request = m::mock('\IBM\Watson\Common\Message\RequestInterface');
        $this->response = m::mock('\IBM\Watson\Common\Message\AbstractResponse', [$request, $data])->makePartial();

        $this->assertSame($request, $this->response->getRequest());
        $this->assertSame($data, $this->response->getData());
    }
}
