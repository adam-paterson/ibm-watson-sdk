<?php

namespace IBM\Watson\ToneAnalyzer\Message;

use GuzzleHttp\Client;
use IBM\Watson\Common\Message\ResponseInterface;
use Mockery as m;
use Symfony\Component\HttpFoundation\Request;

class AbstractRequestTest extends \PHPUnit_Framework_TestCase
{
    protected $request;

    public function setUp()
    {
        $this->request = m::mock('\IBM\Watson\ToneAnalyzer\Message\AbstractRequest')->makePartial();
        $this->request->initialize();
    }

    public function testVersion()
    {
        $this->assertSame('2016-05-19', $this->request->getVersion());
        $this->assertSame($this->request, $this->request->setVersion('2017-01-01'));
        $this->assertSame('2017-01-01', $this->request->getVersion());
    }

    public function testText()
    {
        $this->assertSame($this->request, $this->request->setText('Some test text'));
        $this->assertSame('Some test text', $this->request->getText());
    }
}

class AbstractRequestTest_MockAbstractRequest extends AbstractRequest
{
    public function getData()
    {
    }

    public function sendData($data)
    {
    }
}
