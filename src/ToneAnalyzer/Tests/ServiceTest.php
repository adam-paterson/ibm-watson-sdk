<?php

namespace IBM\Watson\ToneAnalyzer\Tests;

use GuzzleHttp\Client;
use IBM\Watson\ToneAnalyzer\Message\ToneRequest;
use IBM\Watson\ToneAnalyzer\Service;
use Mockery as m;
use Symfony\Component\HttpFoundation\Request;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $service;

    public function setUp()
    {
        $this->service = m::mock('\IBM\Watson\ToneAnalyzer\Service')->makePartial();
        $this->service->initialize();
    }

    public function testConstruct()
    {
        $this->service = new ToneAnalyzerServiceTest_MockService;
        $this->assertInstanceOf('\IBM\Watson\Common\AbstractService', $this->service);
    }

    public function testVersion()
    {
        $this->assertSame($this->service, $this->service->setVersion('2016-03-02'));
        $this->assertSame('2016-03-02', $this->service->getVersion());
    }

    public function testName()
    {
        $this->assertSame('Tone Analyzer', $this->service->getName());
    }
}

class ToneAnalyzerServiceTest_MockService extends Service
{
}
