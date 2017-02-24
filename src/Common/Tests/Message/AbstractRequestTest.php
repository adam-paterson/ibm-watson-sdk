<?php


namespace IBM\Watson\Common\Tests\Message;

use GuzzleHttp\Client;
use IBM\Watson\Common\Message\AbstractRequest;
use IBM\Watson\Common\Tests\AbstractServiceTest_MockAbstractService;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class AbstractRequestTest extends TestCase
{
    protected $request;

    public function setUp()
    {
        $this->request = m::mock('\IBM\Watson\Common\Message\AbstractRequest')->makePartial();
        $this->request->initialize();
    }

    public function testConstruct()
    {
        $this->request = new AbstractRequestTest_MockAbstractRequest(new Client(), new Request());
        $this->assertSame([], $this->request->getParameters());
    }

    public function testInitializeWithParameters()
    {
        $this->assertSame($this->request, $this->request->initialize(['username' => 'adam', 'password' => '01234']));
        $this->assertSame('adam', $this->request->getUsername());
        $this->assertSame('01234', $this->request->getPassword());
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\RuntimeException
     * @expectedExceptionMessage Request cannot be modified after it has been sent!
     */
    public function testInitializeAfterRequestSent()
    {
        $this->request = new AbstractRequestTest_MockAbstractRequest(new Client(), new Request());
        $this->request->send();

        $this->request->initialize();
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\RuntimeException
     * @expectedExceptionMessage Request cannot be modified after it has been sent!
     */
    public function testSetParameterAfterRequestSent()
    {
        $this->request = new AbstractRequestTest_MockAbstractRequest(new Client(), new Request());
        $this->request->send();

        $this->request->setUsername('adam');
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\RuntimeException
     * @expectedExceptionMessage You must call send() before accessing the Response!
     */
    public function testGetResponseBeforeRequestSent()
    {
        $this->request = new AbstractRequestTest_MockAbstractRequest(new Client(), new Request());
        $this->request->getResponse();
    }

    public function testGetResponseAfterRequestSent()
    {
        $this->request = new AbstractRequestTest_MockAbstractRequest(new Client(), new Request());
        $this->request->send();

        $response = $this->request->getResponse();
        $this->assertInstanceOf('\IBM\Watson\Common\Message\ResponseInterface', $response);
    }
}

class AbstractRequestTest_MockAbstractRequest extends AbstractRequest
{
    public function getData()
    {
    }

    public function sendData($data)
    {
        $this->response = m::mock('\IBM\Watson\Common\Message\AbstractResponse');
    }
}
