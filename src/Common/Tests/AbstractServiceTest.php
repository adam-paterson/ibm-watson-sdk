<?php

namespace IBM\Watson\Common\Tests;

use IBM\Watson\Common\AbstractService;
use IBM\Watson\Common\Message\AbstractRequest;
use Mockery as m;

class AbstractServiceTest extends \PHPUnit_Framework_TestCase
{
    private $service;

    public function setUp()
    {
        $this->service = m::mock('\IBM\Watson\Common\AbstractService')->makePartial();
        $this->service->initialize();
    }

    public function testConstruct()
    {
        $this->service = new AbstractServiceTest_MockAbstractService;
        $this->assertInstanceOf('\GuzzleHttp\Client', $this->service->getProtectedHttpClient());
        $this->assertInstanceOf('\Symfony\Component\HttpFoundation\Request', $this->service->getProtectedHttpRequest());
        $this->assertSame(['username' => '', 'password' => ''], $this->service->getDefaultParameters());
    }

    public function testInitializeDefault()
    {
        $defaults = [
            'username' => 'adam',
            'password' => ['01234', '56789']
        ];

        $this->service->shouldReceive('getDefaultParameters')->once()
            ->andReturn($defaults);

        $this->service->initialize();

        $expected = [
            'username' => 'adam',
            'password' => '01234'
        ];

        $this->assertSame($expected, $this->service->getParameters());
    }

    public function testUsername()
    {
        $this->assertSame($this->service, $this->service->setUsername('adam'));
        $this->assertSame('adam', $this->service->getUsername());
    }

    public function testPassword()
    {
        $this->assertSame($this->service, $this->service->setPassword('01234'));
        $this->assertSame('01234', $this->service->getPassword());
    }

    public function testCreateRequest()
    {
        $this->service = new AbstractServiceTest_MockAbstractService;
        $request = $this->service->callCreateRequest(
            '\IBM\Watson\Common\Tests\AbstractServiceTest_MockAbstractRequest',
            ['username' => 'adam', 'password' => '01234']
        );

        $this->assertSame(['username' => 'adam', 'password' => '01234'], $request->getParameters());
    }
}

class AbstractServiceTest_MockAbstractService extends AbstractService
{
    public function getName()
    {
        return 'Mock Service';
    }

    public function getProtectedHttpClient()
    {
        return $this->httpClient;
    }

    public function getProtectedHttpRequest()
    {
        return $this->httpRequest;
    }

    public function callCreateRequest($class, array $parameters)
    {
        return $this->createRequest($class, $parameters);
    }
}

class AbstractServiceTest_MockAbstractRequest extends AbstractRequest
{
    public function getData()
    {
    }
    public function sendData($data)
    {
    }
}
