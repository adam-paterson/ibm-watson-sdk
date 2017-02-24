<?php


namespace IBM\Watson\ToneAnalyzer\Message;

use Mockery as m;
use IBM\Watson\Common\Tests\TestCase;

class ToneResponseTest extends TestCase
{
    private $request;
    private $response;

    public function setUp()
    {
        $data = $this->getMockHttpResponse('ErrorResponse.txt', 503);
        $this->request = m::mock('\IBM\Watson\ToneAnalyzer\Message\ToneRequest')->makePartial();
        $this->response = new ToneResponse($this->request, $data);
    }

    public function testGetCode()
    {
        $this->assertSame(503, $this->response->getCode());
    }
}
